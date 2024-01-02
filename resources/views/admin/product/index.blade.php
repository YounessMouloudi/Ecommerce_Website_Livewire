@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header">
                <h3 class="text-capitalize"> 
                    product list
                    <a href="{{ route('add_product')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">add product</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <th>id</th>
                        <th>categorie</th>
                        <th>product</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>status</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    @if($product->categorie)
                                        {{$product->categorie->name}}</td>
                                    @else
                                        no product
                                    @endif
                                <td>{{$product->name}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status == '1' ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{route('edit_product',$product->id)}}" class="btn btn-success text-white">Edit</a>
                                    <a href="{{route('delete_product',$product->id)}}" onclick="return confirm('are you sure you want to delete this Product ?!')" class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">no product</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end mt-2">
                    {{-- {{$products->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection