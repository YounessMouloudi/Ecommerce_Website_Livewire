<div>
    <div class="py-3 py-md-5">
        <div class="container text-capitalize">
            <h4>my wishlists</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-8 ps-md-5">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlists as $wish)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-8 my-auto ps-md-5">
                                        <a href="{{route('view_product',[$wish->products->categorie->slug,$wish->products->slug,$wish->products->name])}}">
                                            <label class="product-name">
                                                <img src="{{asset($wish->products->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="{{$wish->products->name}}">
                                                {{$wish->products->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">${{$wish->products->selling_price}} </label>
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:click="deleteFromWishlist({{$wish->id}})" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target="deleteFromWishlist({{$wish->id}})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="deleteFromWishlist({{$wish->id}})">Removing...</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="cart-item">
                                <h4>No Wishlist Added</h4>
                            </div>                                                           
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

