@extends('layouts.app')

@section('title','Featured Products')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row text-capitalize">
            <div class="col-md-12">
                <h4>featured products</h4>
                <div class="underline mb-4"></div>
            </div>
            @forelse ($featuredProducts as $product)
                <div class="col-md-3">
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
            @empty
                <div class="col-md-12">
                    <div class="pt-2">
                        <h4 class="text-danger">* no featured products available now</h4>
                    </div>
                </div>                    
            @endforelse
            @if ($featuredProducts->isNotEmpty())
                <div class="text-center pt-5 pb-3">
                    <a href="{{ route('categories') }}" class="btn btn-warning">shop more</a>
                </div>                
            @endif
        </div>
    </div>
</div>

@endsection