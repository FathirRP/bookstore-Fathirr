<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.book');
        return view('orders.show', compact('order'));
    }

    /**
     * Nampilin halaman invoice/struk pesanan.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function invoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['user', 'orderItems.book']);
        return view('orders.invoice', compact('order'));
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
