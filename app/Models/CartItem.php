<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = ['cart_id', 'menu_item_id', 'quantity'];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
