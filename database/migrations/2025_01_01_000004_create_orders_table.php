<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel orders untuk menyimpan data pesanan.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_amount');
            $table->enum('status', ['PROCESSING', 'SHIPPED', 'COMPLETED'])->default('PROCESSING');
            $table->text('shipping_address');
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel orders.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
