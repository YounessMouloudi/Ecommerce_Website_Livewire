<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(7);
        return view('frontend.orders.index',compact('orders'));
    }
    public function show(int $id)
    {
        $order = Order::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if ($order) {
            return view('frontend.orders.view',compact('order'));
        } else {
            return redirect()->route('orders')->with('message','Order Id Not Found');            
        }
    }
}
