<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_the_new_information_cards(): void
    {
        $admin = $this->createAdminUser();
        $category = Category::create(['name' => 'Teknologi']);

        Book::create([
            'title' => 'Laravel Untuk Admin',
            'author' => 'Fathir Rahman',
            'publisher' => 'Pra USK Press',
            'published_year' => 2025,
            'isbn' => '9780000000201',
            'description' => 'Panduan dashboard admin Laravel.',
            'price' => 130000,
            'stock' => 10,
            'image_url' => '/storage/books/admin-dashboard.png',
            'category_id' => $category->id,
        ]);

        Book::create([
            'title' => 'UI Laporan Penjualan',
            'author' => 'Nadia Putri',
            'publisher' => 'Pra USK Press',
            'published_year' => 2026,
            'isbn' => '9780000000202',
            'description' => 'Referensi UI untuk laporan bisnis.',
            'price' => 98000,
            'stock' => 7,
            'image_url' => '/storage/books/sales-report-ui.png',
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSeeText('Total Buku');
        $response->assertSeeText('Total Pengguna');
        $response->assertSeeText('Kategori');
        $response->assertSeeText('Pesan Masuk');
        $response->assertSeeText('Snapshot Keuangan');
    }

    public function test_admin_can_view_sales_and_finance_report_summary(): void
    {
        $admin = $this->createAdminUser();
        $customer = $this->createUser('customer@example.com');
        $category = Category::create(['name' => 'Bisnis']);

        $bookA = Book::create([
            'title' => 'Strategi Penjualan Modern',
            'author' => 'Dina Puspita',
            'publisher' => 'Pra USK Press',
            'published_year' => 2024,
            'isbn' => '9780000000101',
            'description' => 'Buku strategi penjualan.',
            'price' => 120000,
            'stock' => 15,
            'image_url' => '/storage/books/book-a.png',
            'category_id' => $category->id,
        ]);

        $bookB = Book::create([
            'title' => 'Keuangan UMKM',
            'author' => 'Rani Maharani',
            'publisher' => 'Pra USK Press',
            'published_year' => 2023,
            'isbn' => '9780000000102',
            'description' => 'Buku keuangan untuk UMKM.',
            'price' => 90000,
            'stock' => 20,
            'image_url' => '/storage/books/book-b.png',
            'category_id' => $category->id,
        ]);

        $completedOrder = Order::create([
            'user_id' => $customer->id,
            'total_amount' => 240000,
            'status' => 'COMPLETED',
            'shipping_address' => 'Jl. Mawar 10',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

        OrderItem::create([
            'order_id' => $completedOrder->id,
            'book_id' => $bookA->id,
            'quantity' => 2,
            'price' => 120000,
        ]);

        $processingOrder = Order::create([
            'user_id' => $customer->id,
            'total_amount' => 90000,
            'status' => 'PROCESSING',
            'shipping_address' => 'Jl. Mawar 10',
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        OrderItem::create([
            'order_id' => $processingOrder->id,
            'book_id' => $bookB->id,
            'quantity' => 1,
            'price' => 90000,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.reports.index', [
            'from_date' => now()->subDays(7)->toDateString(),
            'to_date' => now()->toDateString(),
        ]));

        $response->assertOk();
        $response->assertSeeText('Laporan Penjualan & Keuangan');
        $response->assertSeeText('Rp 330.000');
        $response->assertSeeText('Rp 240.000');
        $response->assertSeeText('Rp 90.000');
        $response->assertSeeText('Strategi Penjualan Modern');
        $response->assertSeeText('Keuangan UMKM');
    }

    private function createAdminUser(): User
    {
        return User::create([
            'name' => 'Admin Report',
            'email' => 'admin-report@example.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'status' => 'ACTIVE',
        ]);
    }

    private function createUser(string $email): User
    {
        return User::create([
            'name' => 'User Demo',
            'email' => $email,
            'password' => Hash::make('password'),
            'role' => 'USER',
            'status' => 'ACTIVE',
        ]);
    }
}