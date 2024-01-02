@extends('layouts.app')

@section('title','Thank You For Shopping')

@section('content')

    <div class="py-3 py-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center text-capitalize">
                    @if (session()->has('messageOrder'))
                        <h5 class="alert alert-success">{{session('messageOrder')}}</h5>
                    @endif
                    @if (session()->has('messageError'))
                        <h5 class="alert alert-danger">{{session('messageError')}}</h5>
                    @endif
                    <div class="p-4 card shadow bg-white">
                        <h4>logo fit shop</h4>
                        <h4 class="mt-1">thank you for shopping with <span class="fw-bold">fit shop</span></h4>
                        <a href="{{route('categories')}}" class="btn btn-primary fs-5 mt-2">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection