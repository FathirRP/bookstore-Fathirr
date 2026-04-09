<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Nampilin semua pesanan punya user yang lagi login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.book')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Liat detail pesanan tertentu punya user.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $this->authorizeOrderOwner($order);

        $order->load(['user', 'orderItems.book']);

        $invoiceHistory = $this->getInvoiceHistory($order);

        return view('orders.show', compact('order', 'invoiceHistory'));
    }

    /**
     * Menyiapkan invoice, menyimpannya ke arsip, lalu mengembalikan metadata file.
     */
    public function prepareInvoice(Order $order): JsonResponse
    {
        $this->authorizeOrderOwner($order);

        $storedInvoice = $this->archiveInvoicePdf($order);

        return response()->json([
            'message' => 'Invoice berhasil disiapkan dan tersimpan di arsip invoice.',
            'download_url' => $storedInvoice['download_url'],
            'file_name' => $storedInvoice['file_name'],
            'history' => $this->getInvoiceHistory($order)->values()->all(),
        ]);
    }

    /**
     * Ngedownload invoice pesanan sebagai PDF.
     *
     * @param  \App\Models\Order  $order
    * @return \Illuminate\Http\Response
     */
    public function invoice(Order $order)
    {
        $this->authorizeOrderOwner($order);

        $storedInvoice = $this->archiveInvoicePdf($order);

        return response()->download(
            $storedInvoice['absolute_path'],
            $storedInvoice['file_name']
        )->deleteFileAfterSend(false);
    }

    /**
     * Mengunduh file invoice yang sudah tersimpan di arsip.
     */
    public function downloadArchivedInvoice(Order $order, string $fileName)
    {
        $this->authorizeOrderOwner($order);

        $safeFileName = basename($fileName);
        $relativePath = $this->invoiceArchiveDirectory($order) . '/' . $safeFileName;

        abort_unless(Storage::disk('local')->exists($relativePath), 404);

        return response()->download(
            Storage::disk('local')->path($relativePath),
            $safeFileName
        )->deleteFileAfterSend(false);
    }

    private function authorizeOrderOwner(Order $order): void
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
    }

    private function archiveInvoicePdf(Order $order): array
    {
        $order->loadMissing(['user', 'orderItems.book']);

        $relativePath = $this->invoiceArchiveDirectory($order)
            . '/invoice-' . substr((string) $order->id, 0, 8)
            . '-' . now()->format('Ymd-His') . '.pdf';

        Storage::disk('local')->put(
            $relativePath,
            Pdf::loadView('orders.invoice', ['order' => $order])
                ->setPaper('a4')
                ->output()
        );

        $this->trimInvoiceHistory($order, 8);

        return $this->mapInvoiceFile($order, $relativePath);
    }

    private function getInvoiceHistory(Order $order)
    {
        $directory = $this->invoiceArchiveDirectory($order);
        $disk = Storage::disk('local');

        if (! $disk->exists($directory)) {
            return collect();
        }

        return collect($disk->files($directory))
            ->filter(fn (string $path) => str_ends_with(strtolower($path), '.pdf'))
            ->sortByDesc(fn (string $path) => $disk->lastModified($path))
            ->values()
            ->map(fn (string $path) => $this->mapInvoiceFile($order, $path));
    }

    private function trimInvoiceHistory(Order $order, int $keep): void
    {
        $disk = Storage::disk('local');
        $directory = $this->invoiceArchiveDirectory($order);

        if (! $disk->exists($directory)) {
            return;
        }

        collect($disk->files($directory))
            ->filter(fn (string $path) => str_ends_with(strtolower($path), '.pdf'))
            ->sortByDesc(fn (string $path) => $disk->lastModified($path))
            ->slice($keep)
            ->each(fn (string $path) => $disk->delete($path));
    }

    private function mapInvoiceFile(Order $order, string $relativePath): array
    {
        $disk = Storage::disk('local');
        $timestamp = Carbon::createFromTimestamp($disk->lastModified($relativePath));
        $sizeInKb = max(1, $disk->size($relativePath) / 1024);
        $fileName = basename($relativePath);

        return [
            'file_name' => $fileName,
            'absolute_path' => $disk->path($relativePath),
            'download_url' => route('orders.invoice.history', [
                'order' => $order,
                'fileName' => $fileName,
            ]),
            'generated_at_label' => $timestamp->translatedFormat('d M Y, H:i') . ' WIB',
            'size_label' => number_format($sizeInKb, 1, ',', '.') . ' KB',
        ];
    }

    private function invoiceArchiveDirectory(Order $order): string
    {
        return 'invoices/' . $order->user_id . '/' . $order->id;
    }

    /**
     * Nampilin halaman checkout, isinya ringkasan keranjang.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkout(Request $request)
    {
        $selectedIds = $request->input('items', []);

        $query = CartItem::with('book')
            ->where('user_id', Auth::id());

        if (!empty($selectedIds)) {
            $query->whereIn('id', $selectedIds);
        }

        $cartItems = $query->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        $total = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);
        $selectedItemIds = $cartItems->pluck('id')->toArray();

        return view('orders.checkout', compact('cartItems', 'total', 'selectedItemIds'));
    }

    /**
     * Ngeproses pesanan dari keranjang user.
     * Pake transaksi database biar datanya konsisten.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'items' => 'required|array|min:1',
            'items.*' => 'string',
        ], [
            'shipping_address.required' => 'Alamat pengiriman tidak boleh kosong.',
            'items.required' => 'Pilih minimal satu item untuk checkout.',
        ]);

        try {
            DB::beginTransaction();

            $cartItems = CartItem::with('book')
                ->where('user_id', Auth::id())
                ->whereIn('id', $request->input('items'))
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan di keranjang.');
            }

            // Cek stok dulu sebelum diproses
            foreach ($cartItems as $item) {
                if ($item->book->stock < $item->quantity) {
                    DB::rollBack();
                    return redirect()->route('cart.index')
                        ->with('error', "Stok buku \"{$item->book->title}\" tidak mencukupi. Tersisa {$item->book->stock}.");
                }
            }

            $totalAmount = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

            // Bikin pesanan (COD - bayar di tempat)
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'PROCESSING',
                'shipping_address' => $request->shipping_address,
            ]);

            // Bikin item pesanan terus kurangin stoknya
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price,
                ]);

                $item->book->decrement('stock', $item->quantity);
            }

            // Hapus item yang udah di-checkout dari keranjang
            CartItem::where('user_id', Auth::id())
                ->whereIn('id', $request->input('items'))
                ->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Pembayaran dilakukan saat barang diterima (COD).');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal membuat pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan.')->withInput();
        }
    }
}
