<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function view(){
        $orders = Order::latest()->get();
        return view('admin.orders.view',compact('orders'));
    }
    public function viewOrderDetails($id){
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('admin.orders.view-details',compact('order'));
    }
    public function updateOrderStatus($id,Request $req){
        $order = Order::findOrFail($id);
        if($order){
            $order->status = $req->order_status;
            $order->update();
            return redirect()->back()->with(['status'=> true,'type'   => 'success','msg'=> 'Order status updated sucessfully.'] );
        }else {
            return redirect()->back()->with(['status'=> false,'type'   => 'danger','msg'=> 'something went wrong'] );
        }
        
    }
}
