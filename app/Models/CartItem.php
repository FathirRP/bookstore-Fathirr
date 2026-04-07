<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];

    /**
     * Relasi: Item keranjang milik satu pengguna.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Item keranjang merujuk pada satu buku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
