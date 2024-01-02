@extends('layouts.app')

@section('title','All Categories')

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Categories</h4>
            </div>
            @forelse ($categories as $categorie)
                <div class="col-6 col-md-3">
                    <div class="category-card p-2">
                        <a href="{{ url("collections/$categorie->slug")}}">
                            <div class="category-card-img text-center">
                                <img src="{{asset("uploads/categorie/".$categorie->image)}}" class="text-center" width="75%" alt="{{$categorie->name}}">
                            </div>
                            <div class="category-card-body">
                                <h5>{{ $categorie->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>                
            @empty
                <div class="col-md-12 text-capitalize">
                    <h4>no categories available</h4>
                </div> 
            @endforelse
        </div>
    </div>
</div>

@endsection