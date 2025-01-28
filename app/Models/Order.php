<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateOrderId()
{
    // Get the latest order
    $lastOrder = Order::latest('id')->first();

    // Extract numeric part from the last order_id
    $lastOrderId = $lastOrder ? intval(str_replace('cicada_', '', $lastOrder->order_id)) : 1000;

    // Increment and format the new order_id
    return 'cicada_' . ($lastOrderId + 1);
}

}
