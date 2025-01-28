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
        // Cookie::queue(Cookie::forget('cart'));
        // return;

        $featuredProducts = Product::where('trending', 1)->take(6)->get();

        $cart = $request->cookie('cart');

        $cartItems = $cart ? json_decode($cart, true) : [];
        $productIds = array_column($cartItems, 'product_id');
        $products = Product::whereIn('id', $productIds)->get();
        // Filter out invalid cart items
        $validCartItems = [];
        foreach ($cartItems as $item) {
            $product = $products->firstWhere('id', $item['product_id']);
            if ($product) {
                $validCartItems[] = $item;
            }
        }

        // Update the cart cookie with valid items
        Cookie::queue('cart', json_encode($validCartItems), 60 * 24 * 30); // 30 days

        // new changes
        $cartItems = $cart ? json_decode($cart, true) : [];
        // Group cart items by product_id, size, and color
        $groupedCartItems = collect($cartItems)->groupBy(function ($item) {
            $groupKey = $item['product_id'];

            if (isset($item['size'])) {
                $groupKey .= '_' . $item['size'];
            }

            if (isset($item['color'])) {
                $groupKey .= '_' . $item['color'];
            }

            return $groupKey;
        });

        // Process grouped items to calculate totals and simplify structure
        $finalCart = $groupedCartItems->map(function ($group) {
            return [
                'product_id' => $group->first()['product_id'],
                'size' => $group->first()['size'] ?? null,
                'color' => $group->first()['color'] ?? null,
                'quantity' => $group->sum('quantity'),
                'product_name' => $group->first()['product_name'],
                'product_price' => $group->first()['product_price'],
                'product_image' => $group->first()['product_image'],
                'total_price' => $group->sum(function ($item) {
                    return (int) $item['quantity'] * (float) $item['product_price'];
                }), // Calculate total price for the group
            ];
        })->values(); // Re-index the result

        // Update the cart in cookies
        Cookie::queue('cart', json_encode($finalCart), 60 * 24 * 30); // 30 days

        // Extract all unique product IDs from the grouped cart
        //   $productIds = $finalCart->pluck('product_id');

        //   // Fetch product details from the database for the grouped items
        //   $products = Product::whereIn('id', $productIds)->get();

        //   // Map additional product details if needed
        //   $cartWithProductDetails = $finalCart->map(function ($cartItem) use ($products) {
        //       $product = $products->firstWhere('id', $cartItem['product_id']);

        //       return array_merge($cartItem, [
        //           'additional_info' => $product ? $product->toArray() : null, // Include additional product info
        //       ]);
        //   });

        //  return $finalCart;

        // Pass the cart items and products to the view
        return view('home-parts.cart', compact('cartItems', 'finalCart', 'validCartItems', 'products', 'featuredProducts'));
    }

    public function removeItemFromCart(Request $request)
    {
   
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $updatedCart = collect($cart)->reject(function ($item) use ($request) {
            $matches = true;

            // Match product_id
            if ($item['product_id'] != $request->product_id) {
                $matches = false;
            }

            // Match size if it exists in both the cart item and request
            if (isset($item['size']) && isset($request->size) && $item['size'] != $request->size) {
                $matches = false;
            }

            // Match color if it exists in both the cart item and request
            if (isset($item['color']) && isset($request->color) && $item['color'] != $request->color) {
                $matches = false;
            }

            return $matches;
        })->values()->toArray();

        // Update the cart in the cookie
        Cookie::queue('cart', json_encode($updatedCart), 60 * 24 * 30); // 30 days

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed successfully',
            'cart' => $updatedCart
        ]);
    }


    public function updateCartQuantity(Request $request)
    {

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Update the quantity in the cart
        foreach ($cart as &$item) {
            if (
                $item['product_id'] == $request->product_id &&
                ($item['size'] ?? null) == ($request->size ?? null) &&
                ($item['color'] ?? null) == ($request->color ?? null)
            ) {
                $item['quantity'] = (int) $request->quantity;
                $item['total_price'] = $item['product_price'] * $item['quantity']; // Update item's total price
                break;
            }
        }

      

        // Update the cart in cookies
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days


        return response()->json([
            'status' => 'success',
            'message' => 'Cart quantity updated',
            'item_total_price' => $item['total_price'], // Return updated total price for the item
            'cart' => $cart,              // Return updated grand total
        ]);



        // $productId = $request->input('product_id');
        // $size = $request->input('size');
        // $quantityChange = (int) $request->input('quantity_change');

        // $cart = json_decode(Cookie::get('cart', '[]'), true);

        // $totalQuantity = 0;
        // $indexToUpdate = null;

        // // Calculate the total quantity for items with the same product ID and size
        // foreach ($cart as $index => $item) {
        //     if ($item['product_id'] == $productId && $item['size'] == $size) {
        //         $totalQuantity += $item['quantity'];
        //         if ($indexToUpdate === null) {
        //             $indexToUpdate = $index;  // Track the first occurrence to update
        //         }
        //     }
        // }

        // // Calculate the new quantity after applying the change
        // $newQuantity =  $quantityChange;

        // if ($newQuantity >= 1) {  // Ensure quantity is valid
        //     // Update the first occurrence in the cart
        //     if ($indexToUpdate !== null) {
        //         $cart[$indexToUpdate]['quantity'] = $newQuantity;
        //     }

        //     // Remove any duplicate items with the same product ID and size
        //     $cart = array_filter($cart, function ($item, $index) use ($productId, $size, $indexToUpdate) {
        //         return !($item['product_id'] == $productId && $item['size'] == $size && $index != $indexToUpdate);
        //     }, ARRAY_FILTER_USE_BOTH);
        // } else {
        //     // If new quantity is below 1, remove all instances with the same product ID and size
        //     $cart = array_filter($cart, function ($item) use ($productId, $size) {
        //         return !($item['product_id'] == $productId && $item['size'] == $size);
        //     });
        // }

        // // Re-index the cart array
        // $cart = array_values($cart);

        // // Queue the updated cart in the cookie
        // Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        // return response()->json([
        //     'status' => 'success',
        //     'cart' => $cart
        // ]);
    }
}
