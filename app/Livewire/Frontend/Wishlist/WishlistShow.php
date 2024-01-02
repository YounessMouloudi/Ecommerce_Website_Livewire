<?php

namespace App\Livewire\Frontend\Wishlist;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function render()
    {
        $wishlists = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist.wishlist-show',compact('wishlists'));
    }
    public function deleteFromWishlist(int $id)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('id',$id)->delete();
        
        // $this->emit('wishlistUpdated');

        $this->dispatch('wishlistUpdated')->to(WishlistCount::class);
        
        $this->dispatch('message',[
            'text'=>'Wishlist Item Removed Successfully',
            'type'=>'success',
            'status'=> 200,
        ]);
        return view('livewire.frontend.wishlist.wishlist-show');
    }
}
