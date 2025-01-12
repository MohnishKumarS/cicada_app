<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactStore(Request $req){
        $data = Contact::create($req->all());

        if($data){
            return response()->json(['status'=> 'success','message' => 'Thank you for contacting us. We will get back to you soon.']);
        }else{
            return response()->json(['status'=> 'error','message' => 'Failed to submit your enquiry. Please try again.']);
        }
    }   
}
