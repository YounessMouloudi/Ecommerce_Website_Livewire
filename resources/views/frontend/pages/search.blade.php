@extends('layouts.app')

@section('title','Search Products')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row text-capitalize justify-content-center">
            <div class="col-md-10">
                <h4>search results</h4>
                <div class="underline mb-4"></div>
            </div>
            @forelse ($searchProducts as $product)
                <div class="col-md-10">
                    <div class="product-card">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="product-card-img p-2">
                                    <label class="stock bg-danger">new</label>
                                    @if ($product->productImages->count() > 0 )
                                        <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}">
                                            <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}" class="">
                                        </a>
                                    @endif
                                </div>    
                            </div>
                            <div class="col-md-9">
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
                                    <p style="overflow:hidden;height:45px">
                                        <b>description : </b>{{$product->description}}
                                    </p>
                                    <a href="{{ route('view_product',[$product->categorie->slug,$product->slug,$product->name])}}" 
                                        class="btn btn-outline-primary">
                                        view
                                    </a>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-10">
                    <div class="pt-2">
                        <h4 class="text-danger">no such products found with this keyword = "{{ request()->search }}"</h4>
                    </div>
                </div>                    
            @endforelse
            <div class="col-md-10">
                {{$searchProducts->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>

@endsection
