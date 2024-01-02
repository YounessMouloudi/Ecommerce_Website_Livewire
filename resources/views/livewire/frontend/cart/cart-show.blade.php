<div>
    <div class="py-3 py-md-5">
        <div class="container text-capitalize">
            <h4>my carts</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Color</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($carts as $cart)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-4 my-auto">
                                        <a href="{{route('view_product',[$cart->products->categorie->slug,$cart->products->slug,$cart->products->name])}}">
                                            <label class="product-name">
                                                @if ($cart->products->productImages)
                                                    <img src="{{asset($cart->products->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="{{$cart->products->name}}">        
                                                @else
                                                    <img src="" style="width: 50px; height: 50px" alt="{{$cart->products->name}}">
                                                @endif
                                                {{$cart->products->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        @if ($cart->productColors)
                                            <label class="price">{{$cart->productColors->color->name}}</label>
                                        @else
                                            <label class="price">no color</label>
                                        @endif
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">${{$cart->products->selling_price}} </label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" class="btn btn1" wire:loading.attr="disabled" wire:click="decrementQte({{$cart->id}})"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{$cart->quantity}}" class="input-quantity"  />
                                                <button type="button" class="btn btn1" wire:loading.attr="disabled" wire:click="incrementQte({{$cart->id}})"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">${{$cart->products->selling_price * $cart->quantity}} </label>
                                        @php  $totalPrice += $cart->products->selling_price * $cart->quantity ; @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:loading.attr="disabled" wire:click="deleteFromCart({{$cart->id}})" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target="deleteFromCart({{$cart->id}})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="deleteFromCart({{$cart->id}})">Removing...</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="cart-item">
                                <h4>no cart item available</h4>
                            </div>                                                           
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>
                        get the best deals & offers <a href="{{''}}">shop now</a>
                    </h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total : 
                            <span class="float-end">${{$totalPrice}}</span>
                        </h4>
                        <hr>
                        <a href="{{route('checkout')}}" class="btn btn-warning w-100 fw-semibold">checkOut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

