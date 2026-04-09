<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminBookManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_book_with_inline_category_and_metadata(): void
    {
        Storage::fake('public');

        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post(route('admin.books.store'), [
            'title' => 'Belajar Laravel dari Nol',
            'author' => 'Fathir Rahman',
            'publisher' => 'Pra USK Press',
            'published_year' => 2026,
            'isbn' => '9781234567890',
            'description' => 'Panduan praktis membangun aplikasi Laravel untuk pemula.',
            'price' => 150000,
            'stock' => 20,
            'new_category_name' => 'Pemrograman Web',
            'image' => $this->fakeCoverImage('laravel-book.png'),
        ]);

        $response->assertRedirect(route('admin.books.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Pemrograman Web',
        ]);

        $book = Book::with('category')->firstOrFail();

        $this->assertSame('Fathir Rahman', $book->author);
        $this->assertSame('Pra USK Press', $book->publisher);
        $this->assertSame(2026, $book->published_year);
        $this->assertSame('9781234567890', $book->isbn);
        $this->assertSame('Pemrograman Web', $book->category->name);

        $this->assertTrue(Storage::disk('public')->exists(str_replace('/storage/', '', $book->image_url)));
    }

    public function test_admin_reuses_existing_category_when_inline_category_matches_existing_name(): void
    {
        Storage::fake('public');

        $admin = $this->createAdminUser();
        $category = Category::create(['name' => 'Teknologi']);

        $response = $this->actingAs($admin)->post(route('admin.books.store'), [
            'title' => 'Arsitektur Sistem Modern',
            'author' => 'Nadia Putri',
            'publisher' => 'Tech Nusantara',
            'published_year' => 2025,
            'isbn' => '9781234567891',
            'description' => 'Pembahasan fondasi sistem modern untuk aplikasi skala besar.',
            'price' => 175000,
            'stock' => 12,
            'new_category_name' => '  teknologi  ',
            'image' => $this->fakeCoverImage('system-design.png'),
        ]);

        $response->assertRedirect(route('admin.books.index'));

        $this->assertSame(1, Category::count());
        $this->assertDatabaseHas('books', [
            'title' => 'Arsitektur Sistem Modern',
            'category_id' => $category->id,
            'isbn' => '9781234567891',
        ]);
    }

    private function createAdminUser(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'admin-test@example.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'status' => 'ACTIVE',
        ]);
    }

    private function fakeCoverImage(string $fileName): UploadedFile
    {
        $pngPixel = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/w8AAgMBgB9sVhQAAAAASUVORK5CYII=');

        return UploadedFile::fake()->createWithContent($fileName, $pngPixel);
    }
}