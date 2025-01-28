<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        // return $request->all();

        $validated = $request->validate([
            'fullname' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:50',
            'pincode' => 'required|digits:6',
            'state' => 'required|string|max:50',
            'mobile' => 'required|digits:10',
        ]);

        // Retrieve cart items from the cookie
        $cart = $request->cookie('cart');
        $cartItems = $cart ? json_decode($cart, true) : [];

        $grandTotal = array_sum(array_map(function ($item) {
            return $item['product_price'] * $item['quantity'];
        }, $cartItems));
        // $grandTotal = $cartItems->sum('total_price');
        // return $cartItems;

        // Create a new order
        $order = Order::create([
            'user_id' => $request->user()->id,
            'order_id' => Order::generateOrderId(),
            'full_name' => $validated['fullname'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'pincode' => $validated['pincode'],
            'state' => $validated['state'],
            'mobile' => $validated['mobile'],
            'payment_method' => $request['pay_method'],
            'total_amount' => $grandTotal,
        ]);

        if ($order) {
            // Save order details
            foreach ($cartItems as $item) {
                Orderdetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'size' => $item['size'],
                    'color' => $item['color'],
                    'product_price' => $item['product_price'],
                    'product_image' => $item['product_image'],
                    'quantity' => $item['quantity'],
                ]);
            }
            // Clear the cart
            Cookie::queue(Cookie::forget('cart'));
            return redirect()->route('account')->with('toast', 'Hooray!')->with('type', 'success')->with('text', 'Order placed successfully!');
        } else {
            return redirect()->route('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Failed to place order!');
        }
    }
}
