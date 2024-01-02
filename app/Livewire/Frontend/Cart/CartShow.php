<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $carts,$totalPrice = 0;

    public function render()
    {
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',['carts' => $this->carts]);
    }

    public function decrementQte(int $id)
    {
        $cart = Cart::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($cart){

            if($cart->productColors()->where('id',$cart->product_color_id)->exists()){
                
                $productColor = $cart->productColors()->where('id',$cart->product_color_id)->first();
                
                if ($productColor->quantity >= $cart->quantity) {
                    if ($cart->quantity > 1) {
                        $cart->decrement('quantity');
                    } 
                    else {
                        $this->dispatch('message',[
                            'text'=>'Only '.$productColor->quantity.' Quantity Available',
                            'type'=>'error',
                            'status'=> 404,
                        ]);
                    } 
                }
                else {                  
                    $this->dispatch('message',[
                        'text'=>'Something Is Wrong',
                        'type'=>'warning',
                        'status'=> 404,
                    ]);
                }             
            }
            else{
                if($cart->products->quantity >= $cart->quantity){
                    if ($cart->quantity > 1) {
                        $cart->decrement('quantity');
                    } 
                    else {
                        $this->dispatch('message',[
                            'text'=>'Only '.$cart->products->quantity.' Quantity Available',
                            'type'=>'error',
                            'status'=> 404,
                        ]);
                    }    
                }
                else {
                    $this->dispatch('message',[
                        'text'=>'Something Is Wrong',
                        'type'=>'warning',
                        'status'=> 404,
                    ]);
                }    
            }
        }
    }

    public function incrementQte(int $id)
    {
        $cart = Cart::where('id',$id)->where('user_id',auth()->user()->id)->first();
        
        if($cart){

            if($cart->productColors()->where('id',$cart->product_color_id)->exists()){
                
                $productColor = $cart->productColors()->where('id',$cart->product_color_id)->first();
                
                if ($productColor->quantity > $cart->quantity) {
                    $cart->increment('quantity');
                }
                else{                  
                    $this->dispatch('message',[
                        'text'=>'Only '.$productColor->quantity.' Quantity Available',
                        'type'=>'warning',
                        'status'=> 404,
                    ]);
                }             
            }
            else{
                if($cart->products->quantity > $cart->quantity){
                    $cart->increment('quantity');
                }
                else{
                    $this->dispatch('message',[
                        'text'=>'Only '.$cart->products->quantity.' Quantity Available',
                        'type'=>'warning',
                        'status'=> 404,
                    ]);
                }
            }
        }
    }

    public function deleteFromCart(int $id)
    {
        Cart::where('user_id',auth()->user()->id)->where('id',$id)->delete();
        
        $this->dispatch('cartUpdated')->to(CartCount::class);
        
        $this->dispatch('message',[
            'text'=>'Cart Item Removed Successfully',
            'type'=>'success',
            'status'=> 200,
        ]);
        return view('livewire.frontend.cart.cart-show');
    }
}
