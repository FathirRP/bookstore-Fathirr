<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik si user
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');
        $cartItemsCount = $user->cartItems()->sum('quantity');
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'PENDING')->count();

        // Buku terlaris (yang paling banyak dipesan)
        $popularBooks = Book::with('category')
            ->addSelect(['total_sold' => DB::table('order_items')
                ->selectRaw('COALESCE(SUM(quantity), 0)')
                ->whereColumn('order_items.book_id', 'books.id')
            ])
            ->orderByDesc('total_sold')
            ->take(8)
            ->get();

        // Kategori paling laku (berdasarkan buku yang kejual)
        $popularCategories = Category::withCount('books')
            ->select('categories.*')
            ->selectRaw('COALESCE((SELECT SUM(oi.quantity) FROM order_items oi INNER JOIN books b ON oi.book_id = b.id WHERE b.category_id = categories.id), 0) as total_sold')
            ->orderByDesc('total_sold')
            ->get();

        // Pesanan terbaru si user
        $recentOrders = Order::where('user_id', $user->id)
            ->with('orderItems.book')
            ->latest()
            ->take(5)
            ->get();

        // Buku yang baru ditambahin
        $latestBooks = Book::with('category')->latest()->take(4)->get();

        return view('user.dashboard', compact(
            'user',
            'totalOrders',
            'totalSpent',
            'cartItemsCount',
            'pendingOrders',
            'popularBooks',
            'popularCategories',
            'recentOrders',
            'latestBooks'
        ));
    }
}
