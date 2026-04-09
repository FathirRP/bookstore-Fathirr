<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Ngisi database pake data awal buat development.
     * Bikin akun admin, user contoh, kategori, sama buku.
     */
    public function run(): void
    {
        // Bikin akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
        ]);

        // Bikin akun User contoh
        User::create([
            'name' => 'Fahry User',
            'email' => 'user@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        User::create([
            'name' => 'Anisa Rahma',
            'email' => 'anisa@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        User::create([
            'name' => 'Citra Dewi',
            'email' => 'citra@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        User::create([
            'name' => 'Dimas Pratama',
            'email' => 'dimas@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        // Bikin kategori buku
        $categories = [
            'Fiksi',
            'Non-Fiksi',
            'Teknologi',
            'Sains',
            'Sejarah',
            'Bisnis',
            'Pengembangan Diri',
            'Sastra',
        ];

        $categoryModels = [];
        foreach ($categories as $name) {
            $categoryModels[$name] = Category::create(['name' => $name]);
        }

        // Bikin buku contoh pake gambar dari Unsplash (bebas hak cipta)
        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'published_year' => 2005, 'isbn' => '9780000000001', 'description' => 'Novel inspiratif tentang perjuangan anak-anak Belitung dalam menggapai pendidikan. Kisah yang mengharukan dan penuh motivasi.', 'price' => 89000, 'stock' => 25, 'category' => 'Fiksi', 'image_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop'],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Lentera Dipantara', 'published_year' => 1980, 'isbn' => '9780000000002', 'description' => 'Karya masterpiece Pramoedya Ananta Toer tentang perjuangan bangsa Indonesia di masa kolonial. Sebuah tetralogi yang menginspirasi.', 'price' => 95000, 'stock' => 18, 'category' => 'Sastra', 'image_url' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=600&fit=crop'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'publisher' => 'Prentice Hall', 'published_year' => 2008, 'isbn' => '9780000000003', 'description' => 'Panduan lengkap menulis kode yang bersih, mudah dibaca, dan mudah dipelihara. Wajib baca untuk setiap programmer.', 'price' => 150000, 'stock' => 12, 'category' => 'Teknologi', 'image_url' => 'https://images.unsplash.com/photo-1515879218367-8466d910auj9?w=400&h=600&fit=crop'],
            ['title' => 'Sapiens: Sejarah Singkat Umat Manusia', 'author' => 'Yuval Noah Harari', 'publisher' => 'Harvill Secker', 'published_year' => 2011, 'isbn' => '9780000000004', 'description' => 'Buku populer karya Yuval Noah Harari yang menceritakan perjalanan spesies Homo sapiens dari zaman prasejarah hingga era modern.', 'price' => 125000, 'stock' => 20, 'category' => 'Sejarah', 'image_url' => 'https://images.unsplash.com/photo-1589998059171-988d887df646?w=400&h=600&fit=crop'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'publisher' => 'Avery', 'published_year' => 2018, 'isbn' => '9780000000005', 'description' => 'Cara mudah dan terbukti untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk oleh James Clear.', 'price' => 99000, 'stock' => 30, 'category' => 'Pengembangan Diri', 'image_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop'],
            ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'publisher' => 'Kompas', 'published_year' => 2018, 'isbn' => '9780000000006', 'description' => 'Buku yang membahas filsafat Stoa secara praktis dan relevan untuk kehidupan modern Indonesia.', 'price' => 85000, 'stock' => 22, 'category' => 'Pengembangan Diri', 'image_url' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400&h=600&fit=crop'],
            ['title' => 'The Lean Startup', 'author' => 'Eric Ries', 'publisher' => 'Crown Business', 'published_year' => 2011, 'isbn' => '9780000000007', 'description' => 'Metode inovatif membangun bisnis startup yang efisien dan berkelanjutan oleh Eric Ries.', 'price' => 110000, 'stock' => 15, 'category' => 'Bisnis', 'image_url' => 'https://images.unsplash.com/photo-1524578271613-d550eacf6090?w=400&h=600&fit=crop'],
            ['title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'publisher' => 'Bantam Books', 'published_year' => 1988, 'isbn' => '9780000000008', 'description' => 'Penjelasan kosmologi dan alam semesta yang mudah dipahami oleh Stephen Hawking.', 'price' => 135000, 'stock' => 10, 'category' => 'Sains', 'image_url' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop'],
            ['title' => 'Dilan 1990', 'author' => 'Pidi Baiq', 'publisher' => 'Pastel Books', 'published_year' => 2014, 'isbn' => '9780000000009', 'description' => 'Kisah cinta remaja penuh nostalgia yang mengambil latar kota Bandung tahun 1990.', 'price' => 78000, 'stock' => 35, 'category' => 'Fiksi', 'image_url' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop'],
            ['title' => 'Educated', 'author' => 'Tara Westover', 'publisher' => 'Random House', 'published_year' => 2018, 'isbn' => '9780000000010', 'description' => 'Memoir inspiratif tentang kekuatan pendidikan oleh Tara Westover yang tumbuh tanpa akses ke sekolah formal.', 'price' => 105000, 'stock' => 14, 'category' => 'Non-Fiksi', 'image_url' => 'https://images.unsplash.com/photo-1550399105-c4db5fb85c18?w=400&h=600&fit=crop'],
            ['title' => 'Design Patterns', 'author' => 'Erich Gamma dkk.', 'publisher' => 'Addison-Wesley', 'published_year' => 1994, 'isbn' => '9780000000011', 'description' => 'Referensi klasik pola desain perangkat lunak yang digunakan oleh para pengembang profesional di seluruh dunia.', 'price' => 175000, 'stock' => 8, 'category' => 'Teknologi', 'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop'],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert T. Kiyosaki', 'publisher' => 'Plata Publishing', 'published_year' => 1997, 'isbn' => '9780000000012', 'description' => 'Buku literasi keuangan terkenal oleh Robert Kiyosaki tentang perbedaan pola pikir orang kaya dan miskin.', 'price' => 92000, 'stock' => 28, 'category' => 'Bisnis', 'image_url' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=400&h=600&fit=crop'],
        ];

        foreach ($books as $bookData) {
            Book::create([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'publisher' => $bookData['publisher'],
                'published_year' => $bookData['published_year'],
                'isbn' => $bookData['isbn'],
                'description' => $bookData['description'],
                'price' => $bookData['price'],
                'stock' => $bookData['stock'],
                'image_url' => $bookData['image_url'],
                'category_id' => $categoryModels[$bookData['category']]->id,
            ]);
        }
    }
}
