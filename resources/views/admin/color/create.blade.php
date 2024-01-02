@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header text-capitalize">
                <h4>
                    add color
                    <a href="{{route('colors')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('save_color')}}" method="POST" class="text-capitalize">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="mb-1">color name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="mb-1">color code</label>
                        <input type="text" class="form-control" name="code">
                        @error('code') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for=""class="mb-1" >status</label><br>
                        <input type="checkbox" name="status"> checked = hidden , un-checked = visible
                        @error('status') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
