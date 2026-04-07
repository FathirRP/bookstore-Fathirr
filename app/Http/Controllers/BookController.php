<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Nampilin landing page, ada buku terbaru, kategori, sama statistik toko.
     *
     * @return \Illuminate\View\View
     */
    public function landing()
    {
        $latestBooks = Book::with('category')->latest()->take(8)->get();
        $categories = Category::withCount('books')->orderBy('name')->get();
        $stats = [
            'totalBooks' => Book::count(),
            'totalCategories' => Category::count(),
            'totalUsers' => \App\Models\User::where('role', 'USER')->count(),
        ];

        return view('landing', compact('latestBooks', 'categories', 'stats'));
    }

    /**
     * Nampilin katalog buku, bisa dicari dan difilter per kategori.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Nyari berdasarkan judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter pake kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Nampilin detail satu buku.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        $book->load('category');
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }
}
