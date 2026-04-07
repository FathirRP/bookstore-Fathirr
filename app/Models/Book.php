<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'image_url',
        'category_id',
    ];

    /**
     * Relasi: Buku milik satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
