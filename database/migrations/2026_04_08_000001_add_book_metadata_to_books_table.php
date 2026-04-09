<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan metadata buku tambahan untuk kebutuhan katalog.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->unsignedSmallInteger('published_year')->nullable();
            $table->string('isbn', 32)->nullable()->unique();
        });
    }

    /**
     * Menghapus metadata tambahan buku.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropUnique('books_isbn_unique');
            $table->dropColumn(['author', 'publisher', 'published_year', 'isbn']);
        });
    }
};