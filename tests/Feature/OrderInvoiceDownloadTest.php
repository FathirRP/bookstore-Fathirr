<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OrderInvoiceDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_detail_page_shows_the_invoice_download_call_to_action(): void
    {
        Storage::fake('local');

        $user = $this->createUser('detail-user@example.com');
        $order = $this->createOrderFor($user);

        $response = $this->actingAs($user)->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertSeeText('Invoice Pembayaran');
        $response->assertSeeText('Unduh Invoice PDF');
        $response->assertSeeText('Arsip Invoice');
    }

    public function test_user_can_prepare_invoice_and_get_invoice_history_payload(): void
    {
        Storage::fake('local');

        $user = $this->createUser('prepare-user@example.com');
        $order = $this->createOrderFor($user);

        $response = $this->actingAs($user)->post(route('orders.invoice.prepare', $order));

        $response->assertOk();
        $response->assertJsonPath('message', 'Invoice berhasil disiapkan dan tersimpan di arsip invoice.');
        $response->assertJsonCount(1, 'history');
        $this->assertNotEmpty($response->json('download_url'));
    }

    public function test_user_can_download_invoice_as_pdf_directly_and_archive_it(): void
    {
        Storage::fake('local');

        $user = $this->createUser('invoice-user@example.com');
        $order = $this->createOrderFor($user);

        $response = $this->actingAs($user)->get(route('orders.invoice', $order));

        $response->assertOk();
        $this->assertStringContainsString('application/pdf', (string) $response->headers->get('content-type'));
        $this->assertStringContainsString(
            'attachment; filename=invoice-' . substr((string) $order->id, 0, 8) . '-',
            (string) $response->headers->get('content-disposition')
        );

        $files = Storage::disk('local')->files('invoices/' . $user->id . '/' . $order->id);

        $this->assertCount(1, $files);
    }

    public function test_user_cannot_download_another_users_invoice(): void
    {
        Storage::fake('local');

        $owner = $this->createUser('invoice-owner@example.com');
        $otherUser = $this->createUser('other-user@example.com');
        $order = $this->createOrderFor($owner);

        $response = $this->actingAs($otherUser)->get(route('orders.invoice', $order));

        $response->assertForbidden();
    }

    private function createUser(string $email): User
    {
        return User::create([
            'name' => 'Invoice User',
            'email' => $email,
            'password' => Hash::make('password'),
            'role' => 'USER',
            'status' => 'ACTIVE',
        ]);
    }

    private function createOrderFor(User $user): Order
    {
        $category = Category::create([
            'name' => 'Novel',
        ]);

        $book = Book::create([
            'title' => 'Invoice UI Book',
            'author' => 'Fathir Rahman',
            'publisher' => 'PUJI Press',
            'published_year' => 2026,
            'isbn' => '9780000000311',
            'description' => 'Buku untuk pengujian invoice.',
            'price' => 125000,
            'stock' => 15,
            'image_url' => '/storage/books/invoice-ui-book.png',
            'category_id' => $category->id,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 250000,
            'status' => 'PROCESSING',
            'shipping_address' => "Jl. Melati No. 10\nBanda Aceh",
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => 2,
            'price' => 125000,
        ]);

        return $order;
    }
}