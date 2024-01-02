<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->date && $request->status == null) {
        //     // dd($request->date);
        //     $orders = Order::whereDate('created_at',$request->date)->paginate(7);
        //     return view('admin.orders.index',compact('orders'));    
        // } 
        // else if($request->status && $request->date == null) {
        //     $orders = Order::where('status_message',$request->status)->paginate(7);
        //     return view('admin.orders.index',compact('orders'));    
        // }
        // else if($request->date && $request->status) {
        //     $orders = Order::whereDate('created_at',$request->date)
        //                 ->where('status_message',$request->status)->paginate(7);
        //     return view('admin.orders.index',compact('orders'));    
        // }
        // else {
        //     $toDay= '2023-09-21';//Carbon::now();
        //     $orders = Order::whereDate('created_at',$toDay)->paginate(7);
        //     return view('admin.orders.index',compact('orders'));    
        // }

        $toDay= '2023-09-21';//Carbon::now();
        $orders = Order::when($request->date != null, function($q) use ($request){

            return $q->whereDate('created_at',$request->date);

        }, function($q) use ($toDay){
            
            return $q->whereDate('created_at',$toDay);
        
        })->when($request->status != null, function($q) use ($request){
            
            return $q->where('status_message',$request->status);
        
        })->paginate(7);

        return view('admin.orders.index',compact('orders'));    
        
    }
    public function show(int $id)
    {
        $order = Order::where('id',$id)->first();
        if ($order) {
            return view('admin.orders.view',compact('order'));
        } else {
            return redirect()->route('all_orders')->with('message','Order Id Not Found');            
        }
    }

    public function updateStatusOrder(Request $req,int $id){
        $order = Order::where('id',$id)->first();
        if ($order) {
            $order->update([
                'status_message' =>$req->status,
            ]);
            // return redirect()->back()->with('message','Order Status Updated');            
            return redirect()->route('show_order',$order->id)->with('message','Order Status Updated');            
        } else {
            return redirect()->route('all_orders')->with('message','Order Id Not Found');            
        }
    }

    public function downloadInvoice(int $id)
    {
        $order = Order::findOrFail($id);
        $data = ['order' => $order];
        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('admin.invoice.view', $data);
        return $pdf->download('invoice - '.$order->id.'.pdf');
    }

    public function viewInvoice(int $id)
    {
        $order = Order::findOrFail($id);
        
        return view('admin.invoice.view',compact('order'));
    }

    public function sendInvoice(int $id)
    {
        try {

            $order = Order::findOrFail($id);
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect()->route('show_order',$order->id)->with('message','Invoice Mail Has Been Sent To '.$order->email);

        } catch (\Exception $e) {
            return redirect()->route('show_order',$order->id)->with('messageError','Something Is Wrong. !! '.$e);
        }

        // return redirect()->back()->with('message','Invoice Mail Has Been Sent To '.$order->email);
    }
}
