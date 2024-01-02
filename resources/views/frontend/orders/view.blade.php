@extends('layouts.app')

@section('title','My Order Détails')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-capitalize">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary fw-bold">
                            <i class="fa fa-shopping-cart"></i> my order détails
                            <a href="{{route('orders')}}" class="btn btn-danger btn-sm float-end ">back</a>
                        </h4>
                        <hr>
                        <div class="row" style="font-weight: bold !important;">
                            <div class="col-md-6">
                                <h5 class="fw-bold">order details</h5>
                                <hr>
                                <h6>order id: {{$order->id}}</h6>
                                <h6>tracking id/no: {{$order->tracking_no}}</h6>
                                <h6>order created date: {{$order->created_at->format('d-m-Y')}}</h6>
                                <h6>payment mode: {{$order->payment_mode}}</h6>
                                <h6 class="border p-2 text-success fw-bold">
                                    order status message : <span class="text-uppercase">{{$order->status_message}}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold">user details</h5>
                                <hr>
                                <h6>full name: {{$order->fullname}}</h6>
                                <h6>email: {{$order->email}}</h6>
                                <h6>phone: {{$order->phone}}</h6>
                                <h6>address: {{$order->address}}</h6>
                                <h6>pin code: {{$order->pincode}}</h6>
                            </div>
                        </div>
                        <br>
                        <h5>order items:</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>item id</th>
                                    <th>image</th>
                                    <th>product</th>
                                    <th>price</th>
                                    <th>quantity</th>
                                    <th>total</th>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @forelse ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{$orderItem->id}}</td>
                                            <td>
                                                @if ($orderItem->product->productImages)
                                                    <img src="{{asset($orderItem->product->productImages[0]->image)}}" width="50px" height="50px" alt="{{$orderItem->product->name}}">
                                                @else
                                                    <img src="" width="50px" height="50px" alt="{{$orderItem->product->name}}">
                                                @endif
                                            </td>
                                            <td>
                                                {{$orderItem->product->name}}
                                                @if($orderItem->productColors)
                                                    <span>- color : {{$orderItem->productColors->color->name}}</span>
                                                @else
                                                    <span>- color : normal</span>
                                                @endif
                                            </td>
                                            <td width="10%">{{$orderItem->price}}</td>
                                            <td width="10%">{{$orderItem->quantity}}</td>
                                            <td width="10%" class="fw-bold">${{$orderItem->price * $orderItem->quantity}}</td>
                                        </tr>
                                        @php
                                            $totalPrice += $orderItem->price * $orderItem->quantity;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="7">no item available</td>
                                        </tr>
                                    @endforelse
                                    <tr class="fw-bold">
                                        <td colspan="5" class="text-start">total amount : </td>
                                        <td>${{$totalPrice}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection