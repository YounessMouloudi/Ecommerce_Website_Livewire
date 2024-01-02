@extends('layouts.admin')

@section('title','Orders')

@section('content')

<div class="row text-capitalize">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header py-3">
                <h3 class="text-capitalize"> 
                    <span>orders list</span>
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="">filter by date</label>
                            <input type="date" name="date" class="form-control mt-2" id="" value="{{ Request::get('date') ?? date('Y-m-d')}}">
                        </div>
                        <div class="col-md-3">
                            <label for="">filter by status</label>
                            <select name="status" id="" class="form-select mt-2">
                                <option value="">select status</option>
                                <option value="in progress" {{Request::get('status') == "in progress" ? "selected":""}}>in progress</option>
                                <option value="completed" {{Request::get('status') == "completed" ? "selected":""}}>completed</option>
                                <option value="pending" {{Request::get('status') == "pending" ? "selected":""}}>pending</option>
                                <option value="cancelled" {{Request::get('status') == "cancelled" ? "selected":""}}>cancelled</option>
                                <option value="out for delivery" {{Request::get('status') == "out for delivery" ? "selected":""}}>out for delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary text-capitalize text-white">filter</button>
                        </div>
                    </div>
                </form>

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
                                        <a href="{{route('show_order',$order->id)}}" class="btn btn-info fs-6 btn-sm">view</a>
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
@endsection