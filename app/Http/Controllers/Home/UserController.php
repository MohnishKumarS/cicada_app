<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function checkout(Request $request){
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
        return view('payment.checkout',compact('finalCart'));
    }

    public function account()
    {
        $userID = Auth::id();
        $orders = Order::where('user_id',$userID)->with('orderDetails')->latest()->get();
        // return $orders;
        return view('profile.account',compact('orders'));
    }

    public function viewOrder($id)
    {
        $userID = Auth::id();
        $order = Order::where('user_id',$userID)->findOrFail($id);
        // return $order;
        if($order){
            return view('profile.orderview',compact('order'));
        }
        return redirect()->back()->with('error','Order not found.');
        
    }

    // update profile
    public function updateProfile(Request $request)
    {

        $userID = auth()->user()->id; // Get the logged-in user
        $user = User::findOrFail($userID);
        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
            'data' => $user,
        ]);
    }

    // update password
    public function updatePassword(Request $request)
    {
        $userID = auth()->user()->id; // Get the logged-in user
        $user = User::findOrFail($userID);

        if (!Hash::check($request->oldPass, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'Old password is incorrect.']);
        }

        if ($request->newPass != $request->confirmPass) {
            return response()->json(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
        }

        $user->password = Hash::make($request->newPass);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully!',
        ]);
    }
}
