<div>
    <div class="py-3 py-md-5 text-capitalize">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                            {{-- <img src="{{asset($product->productImages[0]->image)}}" class="w-100" alt="{{$product->name}}"> --}}
                            <div class="exzoom" id="exzoom">
                                <div class="exzoom_img_box">
                                  <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $item)
                                        <li><img src="{{ asset("$item->image")}}"/></li>
                                    @endforeach
                                  </ul>
                                </div>

                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            <h4>No image founded</h4>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                            {{-- @if ($product->quantity > 0)
                                <label class="label-stock bg-success">In Stock</label>
                            @else
                                <label class="label-stock bg-danger">out of Stock</label>    
                            @endif --}}
                        </h4>
                        <hr>
                        <p class="product-path">
                            {{-- <a href="{{route('home_page')}}">Home</a> / <a href="{{route('categories')}}">{{$product->categorie->name}}</a> / {{$product->name}} --}}
                            Home / {{$product->categorie->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">${{$product->selling_price}}</span>
                            <span class="original-price">${{$product->original_price}}</span>
                        </div>
                        <div>
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="color" id="" value="{{$colorItem->id}}"> {{$colorItem->color->name}} --}}
                                        <label for="" class="colorSelection text-white" wire:click="colorSelected({{$colorItem->id}})"
                                            style="background-color: {{$colorItem->color->name}}">
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                @endif
                                
                                <div>
                                    @if ($this->prodColorSelectedQte == "OutOfStock")
                                        <label class="label-stock float-start fs-6 my-2 bg-danger">out of stock</label>    
                                    @elseif ($this->prodColorSelectedQte > 0)
                                        <label class="label-stock float-start fs-6 my-2 bg-success">in stock</label>
                                    @endif
                                </div>
                            @else
                                @if ($product->quantity > 0)
                                    <label class="label-stock float-start fs-6 my-2 bg-success">in stock</label>
                                @else
                                    <label class="label-stock float-start fs-6 my-2 bg-danger">out of stock</label>    
                                @endif

                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQte"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" class="input-quantity fs-6 fw-semibold" readonly />
                                <span class="btn btn1" wire:click="incrementQte"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1"> 
                                <span wire:loading.remove wire:target="addToCart({{$product->id}})">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </span>
                                <span wire:loading wire:target="addToCart({{$product->id}})">Adding...</span>  
                            </button>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1"> 
                                <span wire:loading.remove wire:target="addToWishList({{$product->id}})">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList({{$product->id}})">Adding...</span>  
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{$product->small_description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 mt-5 ">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$product->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3 py-md-5 bg-white text-capitalize">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3>related @if ($categorie) {{$categorie->name}} @endif products</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($categorie->relatedProducts->isNotEmpty())
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($categorie->relatedProducts as $relatedProduct)
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img p-2">
                                            @if ($relatedProduct->productImages->count() > 0 )
                                                <a href="{{ route('view_product',[$relatedProduct->categorie->slug,$relatedProduct->slug,$relatedProduct->name])}}">
                                                    <img src="{{ asset($relatedProduct->productImages[0]->image) }}" alt="{{$relatedProduct->name}}" class="">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body p-3">
                                            <p class="product-brand">{{$relatedProduct->brand}}</p>
                                            <h5 class="product-name">
                                                <a href="{{ route('view_product',[$relatedProduct->categorie->slug,$relatedProduct->slug,$relatedProduct->name])}}">
                                                    {{$relatedProduct->name}} 
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{$relatedProduct->selling_price}}</span>
                                                <span class="original-price">${{$relatedProduct->original_price}}</span>
                                            </div>
                                            <div class="mt-2">
                                                <a href="" class="btn btn1">Add To Cart</a>
                                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                                <a href="{{$relatedProduct->id}}" class="btn btn1"> View </a>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                            @endforeach
                        </div>                        
                    @else
                        <div class="col-md-12">
                            <div class="pt-2">
                                <h4 class="text-danger">* no related products available now</h4>
                            </div>
                        </div>                    
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 text-capitalize">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3>related @if ($product) {{$product->brand}} @endif products</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($relatedProductsBrand->isNotEmpty())
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($relatedProductsBrand as $relatedProductBrand)
                            <div class="item mb-3">
                                <div class="product-card">
                                    <div class="product-card-img p-2">
                                        @if ($relatedProductBrand->productImages->count() > 0 )
                                            <a href="{{ route('view_product',[$relatedProductBrand->categorie->slug,$relatedProductBrand->slug,$relatedProductBrand->name])}}">
                                                <img src="{{ asset($relatedProductBrand->productImages[0]->image) }}" alt="{{$relatedProductBrand->name}}" class="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body p-3">
                                        <p class="product-brand">{{$relatedProductBrand->brand}}</p>
                                        <h5 class="product-name">
                                            <a href="{{ route('view_product',[$relatedProductBrand->categorie->slug,$relatedProductBrand->slug,$relatedProductBrand->name])}}">
                                                {{$relatedProductBrand->name}} 
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{$relatedProductBrand->selling_price}}</span>
                                            <span class="original-price">${{$relatedProductBrand->original_price}}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="" class="btn btn1">Add To Cart</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="{{$relatedProductBrand->id}}" class="btn btn1"> View </a>
                                        </div>
                                    </div>
                                </div>                    
                            </div> 
                            @endforeach
                        </div>                        
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4 class="text-danger">* no related products of <span class="fw-bold text-black">"{{$product->brand}}"</span> available now</h4>
                            </div>
                        </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    
@push('scripts')
    <script>
        $( function(){
            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000            
            });
        });
        $('.four-carousel').owlCarousel({
            loop:false,
            margin:10,
            dots:true,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });
    </script>    
@endpush
