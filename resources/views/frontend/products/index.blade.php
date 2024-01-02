@extends('layouts.app')

@section('title')
{{ $categorie->meta_title}}
@endsection

@section('meta_keyword')
{{ $categorie->meta_keyword}}
@endsection

@section('meta_description')
{{ $categorie->meta_description}}
@endsection

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>

            <livewire:frontend.product.index :categorie="$categorie"/>

        </div>
    </div>
</div>

@endsection