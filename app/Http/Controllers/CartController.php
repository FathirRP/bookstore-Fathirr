<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Menampilkan isi keranjang belanja pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cartItems = CartItem::with('book.category')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Menambahkan buku ke keranjang belanja pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        try {
            $quantity = $request->input('quantity', 1);

            if ($book->stock < $quantity) {
                return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
            }

            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah ke keranjang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang.');
        }
    }

    /**
     * Memperbarui kuantitas item dalam keranjang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            if ($cartItem->book->stock < $request->quantity) {
                return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
            }

            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui keranjang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui keranjang.');
        }
    }

    /**
     * Menghapus item dari keranjang belanja.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus item keranjang: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus item.');
        }
    }
}
