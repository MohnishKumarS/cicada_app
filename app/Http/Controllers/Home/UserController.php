<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function checkout(){
        return view('payment.checkout');
    }

    public function account()
    {
        // return 'sad';
        return view('profile.account');
    }

    public function viewOrder()
    {
        return view('profile.orderview');
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
