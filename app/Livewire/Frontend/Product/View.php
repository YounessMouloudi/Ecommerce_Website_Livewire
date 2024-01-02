<?php

namespace App\Livewire\Frontend\Product;

use App\Livewire\Frontend\Cart\CartCount;
use App\Livewire\Frontend\Wishlist\WishlistCount;
use App\Models\Cart;
use App\Models\ProductColor;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $categorie,$product,$relatedProductsBrand,$prodColorSelectedQte,$quantityCount = 1, $productColorId; 

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;

        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->prodColorSelectedQte = $productColor->quantity;

        if($this->prodColorSelectedQte == 0){
            $this->prodColorSelectedQte = "OutOfStock";
        }
    }

    public function addToCart(int $productId)
    {
        if(Auth::check()) {

            if($this->product->where('id',$productId)->where('status',0)->exists()) {
                
                // check for product color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {
                    
                    if ($this->prodColorSelectedQte != null) {

                        if (Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)
                            ->where('product_color_id',$this->productColorId)->exists()) 
                        {
                            
                                $this->dispatch('message',[
                                'text'=>'Product Already Added To Cart',
                                'type'=>'warning',
                                'status'=> 409,
                            ]);
                        } 
                        else {
                            $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                            
                            if ($productColor->quantity > 0) {
    
                                if ($productColor->quantity > $this->quantityCount) {
                                    
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    
                                    $this->dispatch('cartUpdated')->to(CartCount::class);
    
                                    $this->dispatch('message',[
                                        'text'=>'Product Added To Cart Successfully',
                                        'type'=>'success',
                                        'status'=> 200,
                                    ]);
                                }
                                else {
                                    $this->dispatch('message',[
                                        'text'=>'Only '.$productColor->quantity.' Quantity Available',
                                        'type'=>'warning',
                                        'status'=> 404,
                                    ]);        
                                }    
                            } 
                            else {
                                $this->dispatch('message',[
                                    'text'=>'Out Of Stock',
                                    'type'=>'warning',
                                    'status'=> 404,
                                ]);        
                            }
                        }

                    } 
                    else {
                        $this->dispatch('message',[
                            'text'=>'Select your Color',
                            'type'=>'info',
                            'status'=> 404,
                        ]);        
                    }
                } 
                else {

                    if (Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()) {
                        $this->dispatch('message',[
                            'text'=>'Product Already Added To Cart',
                            'type'=>'warning',
                            'status'=> 409,
                        ]);
                    } 
                    else {

                        if ($this->product->quantity > 0) {

                            if ($this->product->quantity > $this->quantityCount) {
                                    
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                
                                $this->dispatch('cartUpdated')->to(CartCount::class);
    
                                $this->dispatch('message',[
                                    'text'=>'Product Added To Cart',
                                    'type'=>'success',
                                    'status'=> 200,
                                ]);
                            }
                            else {
                                $this->dispatch('message',[
                                    'text'=>'Only '.$this->product->quantity.' Quantity Available',
                                    'type'=>'warning',
                                    'status'=> 404,
                                ]);        
                            }    
                        }
                        else {
                            $this->dispatch('message',[
                                'text'=>'Out Of Stock',
                                'type'=>'warning',
                                'status'=> 404,
                            ]);    
                        }
                    }      
                }
            }
            else {
                $this->dispatch('message',[
                    'text'=>'Product Does Not Exists',
                    'type'=>'warning',
                    'status'=> 404,
                ]);
            }
        }
        else{

            $this->dispatch('message',[
                'text'=>'Please Login To Continue',
                'type'=>'info',
                'status'=> 401,
            ]);
            return false;
        }    
    }
    
    public function addToWishList(int $productId)
    {
        if(Auth::check()){

            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()) {
                // session()->flash('message','Already Added To Wishlist');
                $this->dispatch('message',[
                    'text'=>'Already Added To Wishlist',
                    'type'=>'warning',
                    'status'=> 409,
                ]);
                return false;
            }
            else {
                
                $whishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);

                $this->dispatch('wishlistUpdated')->to(WishlistCount::class);

                $this->dispatch('message',[
                    'text'=>'Product Added To Wishlist Successfully',
                    'type'=>'success',
                    'status'=> 200,
                ]);
            }
        }
        else{
            // session()->flash('message','Please Login To Continue');
            $this->dispatch('message',[
                'text'=>'Please Login To Continue',
                'type'=>'info',
                'status'=> 401,
            ]);
            return false;
        }    
    }
    
    public function decrementQte()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
    public function incrementQte()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function mount($categorie,$product,$relatedProductsBrand)
    {
       $this->categorie =$categorie;
       $this->product =$product;
       $this->relatedProductsBrand =$relatedProductsBrand;
    }

    public function render()
    {
        return view('livewire.frontend.product.view');
    }
}
