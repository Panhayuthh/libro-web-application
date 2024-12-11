<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = ['order_id', 'menu_item_id', 'quantity'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function menuItem() {
        return $this->belongsTo(MenuItem::class);
    }
}
