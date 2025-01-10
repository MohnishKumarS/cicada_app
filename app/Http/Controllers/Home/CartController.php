<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Get product details from the request
        $productDetails = [
            'product_id' => $request->product_id,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_image' => $request->product_image,
        ];

        // Retrieve cart data from cookies, or initialize it as an empty array
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Add the new product to the cart
        $cart[] = $productDetails;

        // Store the updated cart in cookies (expires in 30 days)
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

        // Return response (you can use this to show the success message)
        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart
        ]);
    }

    // Retrieve the cart from cookies
    public function getCart()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        return response()->json($cart);
    }

    public function showCart(Request $request)
    {

        $cart = $request->cookie('cart');

        $cartItems = $cart ? json_decode($cart, true) : [];
        $productIds = array_column($cartItems, 'product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $featuredProducts = Product::where('trending', 1)->take(6)->get();

        // Pass the cart items and products to the view
        return view('home-parts.cart', compact('cartItems', 'products','featuredProducts'));
    }

    public function removeItemFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size');

        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $cart = array_filter($cart, function ($item) use ($productId, $size) {
            return !(isset($item['product_id']) && $item['product_id'] == $productId && $item['size'] == $size);
        });

        $cart = array_values($cart);

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return response()->json([
            'status' => 'success',
            'cart' => $cart
        ]);
    }


    public function updateCartQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size');
        $quantityChange = (int) $request->input('quantity_change');
    
        $cart = json_decode(Cookie::get('cart', '[]'), true);
    
        $totalQuantity = 0;
        $indexToUpdate = null;
    
        // Calculate the total quantity for items with the same product ID and size
        foreach ($cart as $index => $item) {
            if ($item['product_id'] == $productId && $item['size'] == $size) {
                $totalQuantity += $item['quantity'];
                if ($indexToUpdate === null) {
                    $indexToUpdate = $index;  // Track the first occurrence to update
                }
            }
        }
    
        // Calculate the new quantity after applying the change
        $newQuantity =  $quantityChange;
    
        if ($newQuantity >= 1) {  // Ensure quantity is valid
            // Update the first occurrence in the cart
            if ($indexToUpdate !== null) {
                $cart[$indexToUpdate]['quantity'] = $newQuantity;
            }
    
            // Remove any duplicate items with the same product ID and size
            $cart = array_filter($cart, function ($item, $index) use ($productId, $size, $indexToUpdate) {
                return !($item['product_id'] == $productId && $item['size'] == $size && $index != $indexToUpdate);
            }, ARRAY_FILTER_USE_BOTH);
        } else {
            // If new quantity is below 1, remove all instances with the same product ID and size
            $cart = array_filter($cart, function ($item) use ($productId, $size) {
                return !($item['product_id'] == $productId && $item['size'] == $size);
            });
        }
    
        // Re-index the cart array
        $cart = array_values($cart);
    
        // Queue the updated cart in the cookie
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
    
        return response()->json([
            'status' => 'success',
            'cart' => $cart
        ]);
    }
    

}
