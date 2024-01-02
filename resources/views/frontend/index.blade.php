@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
        @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                @if ($slider->image)
                    <img src="{{asset("$slider->image")}}" class="d-block w-100" alt="...">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h1>
                            {!! $slider->title !!}
                        </h1>
                        <p>
                            {{$slider->description}}
                        </p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>            
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4 class="text-capitalize">welcome to fit shop</h4>
                <div class="underline mx-auto"></div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus cumque placeat deserunt dignissimos 
                    nemo fugit exercitationem pariatur quam! Autem obcaecati vitae velit quas quisquam molestias natus 
                    similique possimus veritatis! Iste? Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Accusamus cumque placeat deserunt dignissimos nemo fugit exercitationem pariatur quam! Autem obcaecati 
                    vitae velit quas quisquam molestias natus similique possimus veritatis! Iste?
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row text-capitalize">
            <div class="col-md-12">
                <h4>trending products</h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($trendingProducts->isNotEmpty())                
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($trendingProducts as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img p-2">
                                            <label class="stock bg-danger">new</label>
                                        @if ($product->productImages->count() > 0 )
                                            <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                                <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}" class="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body p-3">
                                        <p class="product-brand">{{$product->brand}}</p>
                                        <h5 class="product-name">
                                        <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                            {{$product->name}} 
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{$product->selling_price}}</span>
                                            <span class="original-price">${{$product->original_price}}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="" class="btn btn1">Add To Cart</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="{{$product->id}}" class="btn btn1"> View </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach            
                    </div>                
                </div>
            @else                
                <div class="col-md-12">
                    <div class="pt-2">
                        <h4 class="text-danger">* no trending products available now</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5 bg-white">
    <div class="container">
        <div class="row text-capitalize">
            <div class="col-md-12">
                <h4>new arrivals
                    <a href="{{route('new_arrivals')}}" class="btn btn-warning float-end">view more</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($newArrivProducts->isNotEmpty())                
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($newArrivProducts as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img p-2">
                                            <label class="stock bg-danger">new</label>
                                        @if ($product->productImages->count() > 0 )
                                            <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                                <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}" class="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body p-3">
                                        <p class="product-brand">{{$product->brand}}</p>
                                        <h5 class="product-name">
                                        <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                            {{$product->name}} 
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{$product->selling_price}}</span>
                                            <span class="original-price">${{$product->original_price}}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="" class="btn btn1">Add To Cart</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="{{$product->id}}" class="btn btn1"> View </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach            
                    </div>                
                </div>
            @else                
                <div class="col-md-12">
                    <div class="pt-2">
                        <h4 class="text-danger">* no new arrivals available now</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row text-capitalize">
            <div class="col-md-12">
                <h4>featured products
                    <a href="{{route('featured')}}" class="btn btn-warning float-end">view more</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($featuredProducts->isNotEmpty())                
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($featuredProducts as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img p-2">
                                            <label class="stock bg-danger">new</label>
                                        @if ($product->productImages->count() > 0 )
                                            <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                                <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}" class="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body p-3">
                                        <p class="product-brand">{{$product->brand}}</p>
                                        <h5 class="product-name">
                                        <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                            {{$product->name}} 
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{$product->selling_price}}</span>
                                            <span class="original-price">${{$product->original_price}}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="" class="btn btn1">Add To Cart</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="{{$product->id}}" class="btn btn1"> View </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach            
                    </div>                
                </div>
            @else                
                <div class="col-md-12">
                    <div class="pt-2">
                        <h4 class="text-danger">* no featured products available now</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
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
        })
    </script>
@endsection