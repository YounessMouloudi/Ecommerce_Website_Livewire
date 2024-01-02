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
                    add slider
                    <a href="{{route('sliders')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('save_slider')}}" method="POST" class="text-capitalize" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="mb-1">slider title</label>
                        <input type="text" class="form-control" name="title">
                        @error('title') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="mb-1">slider description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
                        @error('description') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for=""class="mb-1" >image</label><br>
                        <input type="file" name="image" id="" class="form-control">
                        @error('image') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="status"class="mb-1" >status</label><br>
                        <input type="checkbox" name="status" id="status"> checked = hidden , un-checked = visible
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
