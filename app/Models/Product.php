<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    // Dodaj polja koja želiš da dozvoliš za masovno dodeljivanje
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'discount_price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function pendingOrders()
{
    return $this->hasMany(Order::class)->where('status', 'pending');
}
}
