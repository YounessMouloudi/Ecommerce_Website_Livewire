@extends('layouts.admin')

@section('title','Orders Détails')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        @if (session('messageError'))
            <div class="alert alert-danger">{{session('messageError')}}</div>
        @endif
        <div class="card text-capitalize">
            <div class="card-header py-3">
                <h3 class=""> 
                    <span>order détails</span>
                    <a href="{{route('all_orders')}}" class="btn btn-primary btn-sm float-end text-light mx-1">
                        <span class="mdi mdi-eye"></span> back 
                    </a>
                    <a href="{{route('download_pdf',$order->id)}}" class="btn btn-info btn-sm float-end mx-1">download invoice</a>
                    <a href="{{route('view_invoice',$order->id)}}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">view invoice</a>
                    <a href="{{route('send_invoice',$order->id)}}" class="btn btn-success btn-sm text-light float-end mx-1">send invoice via mail</a>
                </h3>
            </div>
            <div class="card-body">
                <h4 class="text-primary fw-bold">
                    <i class="fa fa-shopping-cart"></i> my order détails
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
        <div class="card border mt-3">
            <div class="card-body">
                <h4>order process (order status updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{route('update_status_order',$order->id)}}" method="post">
                            @csrf
                            @method('put')
                            
                            <label for="">update your order status</label>
                            <div class="input-group mt-2">
                                <select name="status" id="" class="form-select">
                                    <option value="">select status</option>
                                    <option value="in progress" {{Request::get('status') == "in progress" ? "selected":""}}>in progress</option>
                                    <option value="completed" {{Request::get('status') == "completed" ? "selected":""}}>completed</option>
                                    <option value="pending" {{Request::get('status') == "pending" ? "selected":""}}>pending</option>
                                    <option value="cancelled" {{Request::get('status') == "cancelled" ? "selected":""}}>cancelled</option>
                                    <option value="out for delivery" {{Request::get('status') == "out for delivery" ? "selected":""}}>out for delivery</option>
                                </select>
                                <button type="submit" class="btn btn-primary text-white">update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3">current order status: <span class="text-uppercase">{{$order->status_message}}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection