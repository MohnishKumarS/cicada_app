<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function adminIndex(){
        return view('admin.dashboard');
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
