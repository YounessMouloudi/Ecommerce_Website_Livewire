<?php

namespace App\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use PhpParser\Node\Stmt\Return_;

class CheckoutShow extends Component
{
    public $carts,$totalProduct;
    
    public $fullname, $email, $phone, $address, $pincode, $payment_mode = null, $payment_id = null;

    protected $listeners = ['validationForAll','transactionEmit' => 'paidOnlineOrder'];
    
    public function validationForAll(){

        $this->validate();
    }
    
    public function paidOnlindeOrder($value){
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';

        $codeOrder = $this->placeOrder();

        if ($codeOrder) {

            Cart::where('user_id',auth()->user()->id)->delete();

            try {
                $order = Order::findOrFail($codeOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
            } catch (\Throwable $th) {
                
                session()->flash('messageError','Something Is Wrong. !! '.$th);
            }

            session()->flash('messageOrder','Order Placed Successfully');
            
            $this->dispatch('message',[
                'text'=>'Order Placed Successfully',
                'type'=>'success',
                'status'=> 200,
            ]); 
            
            return redirect()->to('thanks');     
        } 
        else {
            $this->dispatch('message',[
                'text'=>'Something Went Wrong ',
                'type'=>'error',
                'status'=> 500,
            ]);        
        }

    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:10|min:10',
            'pincode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder(){

        $validatedData = $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'fit-'.Str::random(10),
            'fullname' => $this->fullname,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'pincode'  => $this->pincode,
            'address'  => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);

        foreach ($this->carts as $cartItem) {
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->products->selling_price    
            ]);

            if ($cartItem->product_color_id != null) {
                $cartItem->productColors()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            } 
            else {
                $cartItem->products()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
            
        }

        return $order;
    }

    public function codeOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codeOrder = $this->placeOrder();
        
        if ($codeOrder) {

            try {
                $order = Order::findOrFail($codeOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));

                $this->dispatch('message',[
                    'text'=>'Email Sent Successfully',
                    'type'=>'success',
                    'status'=> 200,
                ]); 

            } catch (\Throwable $th) {
                $orderItem = OrderItem::where('order_id',$order->id)->first();
                $orderItem->delete();
                $order->delete();
                return redirect()->route('checkout')->with('messageError','Something Is Wrong (Email not sent). !! ');
            }

            Cart::where('user_id',auth()->user()->id)->delete();

            session()->flash('messageOrder','Order Placed Successfully');

            $this->dispatch('message',[
                'text'=>'Order Placed Successfully',
                'type'=>'success',
                'status'=> 200,
            ]); 
            
            return redirect()->to('thanks');     
        } 
        else {
            $this->dispatch('message',[
                'text'=>'Something Went Wrong ',
                'type'=>'error',
                'status'=> 500,
            ]);        
        }
        
    }
    
    public function totalPrice()
    {
        $this->totalProduct = 0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($this->carts as $cart) {
            $this->totalProduct += $cart->products->selling_price * $cart->quantity; 
        }
        return $this->totalProduct;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->phone = auth()->user()->userDetail->phone;
        $this->address = auth()->user()->userDetail->address;
        $this->pincode = auth()->user()->userDetail->pin_code;

        $this->totalProduct = $this->totalPrice();

        return view('livewire.frontend.checkout.checkout-show',['totalPrice' => $this->totalProduct]);
    }
}
