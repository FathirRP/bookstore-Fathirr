<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'chat_closed_at',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'chat_closed_at' => 'datetime',
        ];
    }

    public function isChatClosed(): bool
    {
        return $this->chat_closed_at !== null;
    }

    /**
     * Memeriksa apakah pengguna memiliki peran Admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    public function isBanned(): bool
    {
        return $this->status === 'BANNED';
    }

    /**
     * Relasi: User memiliki banyak item keranjang.
     */
    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItem::class);
    }

    /**
     * Relasi: User memiliki banyak pesanan.
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * Relasi: User memiliki banyak pesan.
     */
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }
}
