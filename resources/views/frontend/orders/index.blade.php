@extends('layouts.app')

@section('title','My Orders')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">            
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12 text-capitalize">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">my orders</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>order id</th>
                                    <th>tracking no</th>
                                    <th>username</th>
                                    <th>payment mode</th>
                                    <th>orderd date</th>
                                    <th>status message</th>
                                    <th>action</th>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->tracking_no}}</td>
                                            <td>{{$order->fullname}}</td>
                                            <td>{{$order->payment_mode}}</td>
                                            <td>{{$order->created_at->format('d-m-Y')}}</td>
                                            <td>{{$order->status_message}}</td>
                                            <td>
                                                <a href="{{route('view_order',$order->id)}}" class="btn btn-info fs-6 btn-sm">view</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">no orders available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="float-end">
                                {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection