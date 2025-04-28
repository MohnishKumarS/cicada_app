<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Brands;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function adminIndex(){
        $totalUsers = User::where('role','!=','admin')->count();
        $totalContacts = Contact::count();
        // $totalOrders = Order::count();
        $totalOrders = 0;
        $totalProducts = Product::count();
        $totalBrands = Brands::count();
        $totalCategories = Category::count();
        return view('admin.dashboard',compact('totalUsers','totalContacts','totalOrders','totalProducts','totalBrands','totalCategories'));
    }

    public function contactView(){
        $contacts = Contact::latest()->get();
        return view('admin.contact.view',compact('contacts'));
    }

    public function userView(){
        $users = User::where('role','!=','admin')->latest()->get();
        return view('admin.contact.user',compact('users'));
    }

   
}
