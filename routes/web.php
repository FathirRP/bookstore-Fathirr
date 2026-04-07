<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// ==================== HALAMAN PUBLIK (BEBAS AKSES) ====================
Route::get('/', [BookController::class, 'landing'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/about', fn() => view('about'))->name('about');

// ==================== LOGIN & REGISTER ====================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==================== RUTE USER (YANG UDAH LOGIN) ====================
Route::middleware('auth')->group(function () {
    // Dashboard si user
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Keranjang belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Urusan pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

    // Chat sama CS
    Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    Route::post('/chat', [MessageController::class, 'store'])->name('chat.store');
    Route::post('/chat/new', [MessageController::class, 'startNew'])->name('chat.new');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ==================== AREA ADMIN (BOSS MODE) ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Ngatur kategori
    Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
    Route::get('/categories/create', [AdminController::class, 'categoriesCreate'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'categoriesStore'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminController::class, 'categoriesEdit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminController::class, 'categoriesUpdate'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'categoriesDestroy'])->name('categories.destroy');

    // Ngatur buku
    Route::get('/books', [AdminController::class, 'booksIndex'])->name('books.index');
    Route::get('/books/create', [AdminController::class, 'booksCreate'])->name('books.create');
    Route::post('/books', [AdminController::class, 'booksStore'])->name('books.store');
    Route::get('/books/{book}/edit', [AdminController::class, 'booksEdit'])->name('books.edit');
    Route::put('/books/{book}', [AdminController::class, 'booksUpdate'])->name('books.update');
    Route::delete('/books/{book}', [AdminController::class, 'booksDestroy'])->name('books.destroy');

    // Ngatur pesanan
    Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'ordersShow'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'ordersUpdateStatus'])->name('orders.updateStatus');

    // Ngatur user
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'usersUpdate'])->name('users.update');
    Route::patch('/users/{user}/ban', [AdminController::class, 'usersBan'])->name('users.ban');
    Route::patch('/users/{user}/unban', [AdminController::class, 'usersUnban'])->name('users.unban');
    Route::delete('/users/{user}', [AdminController::class, 'usersDestroy'])->name('users.destroy');

    // Chat CS / bales pesan
    Route::get('/messages', [AdminController::class, 'messagesIndex'])->name('messages.index');
    Route::get('/messages/{user}', [AdminController::class, 'messagesShow'])->name('messages.show');
    Route::post('/messages/{user}/reply', [AdminController::class, 'messagesReply'])->name('messages.reply');
    Route::patch('/messages/{user}/close', [AdminController::class, 'messagesClose'])->name('messages.close');
});
