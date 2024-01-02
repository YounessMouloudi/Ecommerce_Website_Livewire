@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin text-capitalize">
    <div class="me-md-3 me-xl-5">
        <h2>dashboard,</h2>
        <p class="mb-md-0">your analytics dashboard template.</p>
        <hr>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="card card-body bg-primary mb-3">
          <label for="">total orders</label>
          <h1>{{$totalOrders}}</h1>
          <a href="{{route('all_orders')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-success mb-3">
          <label for="">to day order</label>
          <h1>{{$toDayOrder}}</h1>
          <a href="{{route('all_orders')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-warning mb-3">
          <label for="">this month orders</label>
          <h1>{{$thisMonthOrder}}</h1>
          <a href="{{route('all_orders')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-danger mb-3">
          <label for="">this year orders</label>
          <h1>{{$thisYearOrder}}</h1>
          <a href="{{route('all_orders')}}" class="text-white">view</a>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="card card-body bg-primary mb-3">
          <label for="">total products</label>
          <h1>{{$totalProducts}}</h1>
          <a href="{{route('products')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-success mb-3">
          <label for="">total categories</label>
          <h1>{{$totalCategories}}</h1>
          <a href="{{route('cat')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-warning mb-3">
          <label for="">total brands</label>
          <h1>{{$totalBrands}}</h1>
          <a href="{{route('brand')}}" class="text-white">view</a>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="card card-body bg-primary mb-3">
          <label for="">total all users</label>
          <h1>{{$totalAllUsers}}</h1>
          <a href="{{route('users')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-success mb-3">
          <label for="">total users</label>
          <h1>{{$totalUser}}</h1>
          <a href="{{route('users')}}" class="text-white">view</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-body bg-warning mb-3">
          <label for="">total admin</label>
          <h1>{{$totalAdmin}}</h1>
          <a href="{{route('users')}}" class="text-white">view</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection