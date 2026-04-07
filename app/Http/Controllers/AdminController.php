<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Nampilin dashboard admin, ada ringkasan statistiknya.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $stats = [
            'totalBooks' => Book::count(),
            'totalCategories' => Category::count(),
            'totalUsers' => User::where('role', 'USER')->count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'PROCESSING')->count(),
            'totalMessages' => Message::where('is_admin', false)->where('is_read', false)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    // ==================== NGATUR KATEGORI ====================

    /**
     * Nampilin semua kategori buku.
     *
     * @return \Illuminate\View\View
     */
    public function categoriesIndex()
    {
        $categories = Category::withCount('books')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Nampilin form buat bikin kategori baru.
     *
     * @return \Illuminate\View\View
     */
    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    /**
     * Nyimpen kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        try {
            Category::create(['name' => trim($request->name)]);
            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah kategori: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan kategori.');
        }
    }

    /**
     * Nampilin form buat ngedit kategori.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function categoriesEdit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update data kategori di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoriesUpdate(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        try {
            $category->update(['name' => trim($request->name)]);
            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui kategori: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kategori.');
        }
    }

    /**
     * Ngapus kategori dari database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoriesDestroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kategori: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }

    // ==================== NGATUR BUKU ====================

    /**
     * Nampilin semua buku buat admin kelola.
     *
     * @return \Illuminate\View\View
     */
    public function booksIndex()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Nampilin form buat nambahin buku baru.
     *
     * @return \Illuminate\View\View
     */
    public function booksCreate()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Nyimpen buku baru ke database, sekalian upload gambar sampulnya.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function booksStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $imagePath = $request->file('image')->store('books', 'public');

            Book::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'image_url' => '/storage/' . $imagePath,
            ]);

            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah buku: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan buku.')->withInput();
        }
    }

    /**
     * Nampilin form edit buku.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function booksEdit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update data buku di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function booksUpdate(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $data = $request->only(['title', 'description', 'price', 'stock', 'category_id']);

            if ($request->hasFile('image')) {
                // Hapus gambar lama kalo ada
                $oldPath = str_replace('/storage/', '', $book->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $imagePath = $request->file('image')->store('books', 'public');
                $data['image_url'] = '/storage/' . $imagePath;
            }

            $book->update($data);
            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui buku: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui buku.')->withInput();
        }
    }

    /**
     * Ngapus buku dari database, sekalian hapus gambarnya.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function booksDestroy(Book $book)
    {
        try {
            $oldPath = str_replace('/storage/', '', $book->image_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $book->delete();
            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus buku: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus buku.');
        }
    }

    // ==================== NGATUR PESANAN ====================

    /**
     * Nampilin semua pesanan buat admin kelola.
     *
     * @return \Illuminate\View\View
     */
    public function ordersIndex()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Liat detail satu pesanan.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function ordersShow(Order $order)
    {
        $order->load(['user', 'orderItems.book']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan (misal dari PENDING_PAYMENT ke PROCESSING, gitu).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ordersUpdateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:PROCESSING,SHIPPED,COMPLETED',
        ]);

        try {
            $order->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui status pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    // ==================== NGATUR USER ====================

    /**
     * Nampilin semua user yang terdaftar (role USER).
     *
     * @return \Illuminate\View\View
     */
    public function usersIndex()
    {
        $users = User::where('role', 'USER')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Nampilin form edit data user.
     */
    public function usersEdit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function usersUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
            }

            $user->update($data);
            return redirect()->route('admin.users.index')->with('success', "Data pengguna {$user->name} berhasil diperbarui.");
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui data pengguna: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data pengguna.')->withInput();
        }
    }

    /**
     * Ban/suspend user.
     */
    public function usersBan(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Tidak dapat melakukan ban pada akun admin.');
        }

        try {
            $user->update(['status' => 'BANNED']);
            return redirect()->route('admin.users.index')->with('success', "Pengguna {$user->name} berhasil di-ban.");
        } catch (\Exception $e) {
            Log::error('Gagal ban pengguna: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan ban pengguna.');
        }
    }

    /**
     * Unban user, aktifin lagi.
     */
    public function usersUnban(User $user)
    {
        try {
            $user->update(['status' => 'ACTIVE']);
            return redirect()->route('admin.users.index')->with('success', "Pengguna {$user->name} berhasil diaktifkan kembali.");
        } catch (\Exception $e) {
            Log::error('Gagal unban pengguna: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengaktifkan pengguna.');
        }
    }

    /**
     * Ngapus user dari database.
     */
    public function usersDestroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        try {
            $userName = $user->name;
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', "Pengguna {$userName} berhasil dihapus.");
        } catch (\Exception $e) {
            Log::error('Gagal menghapus pengguna: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pengguna.');
        }
    }

    // ==================== CHAT CS ====================

    /**
     * Nampilin semua percakapan dari user.
     */
    public function messagesIndex()
    {
        $conversations = User::where('role', 'USER')
            ->whereHas('messages')
            ->withCount(['messages as unread_count' => function ($q) {
                $q->where('is_admin', false)->where('is_read', false);
            }])
            ->with(['messages' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->get()
            ->sortByDesc(function ($user) {
                return $user->messages->first()?->created_at;
            });

        return view('admin.messages.index', compact('conversations'));
    }

    /**
     * Liat chat sama satu user tertentu.
     */
    public function messagesShow(User $user)
    {
        $messages = Message::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandain pesan user jadi udah dibaca
        Message::where('user_id', $user->id)
            ->where('is_admin', false)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.messages.show', compact('messages', 'user'));
    }

    /**
     * Admin bales pesan user.
     */
    public function messagesReply(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'user_id' => $user->id,
            'content' => $request->content,
            'is_admin' => true,
        ]);

        return redirect()->route('admin.messages.show', $user)->with('success', 'Balasan terkirim.');
    }

    /**
     * Admin menutup/mengakhiri room chat user.
     */
    public function messagesClose(User $user)
    {
        try {
            $user->update(['chat_closed_at' => now()]);
            return redirect()->route('admin.messages.show', $user)->with('success', 'Percakapan berhasil ditutup.');
        } catch (\Exception $e) {
            Log::error('Gagal menutup percakapan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menutup percakapan.');
        }
    }
}
