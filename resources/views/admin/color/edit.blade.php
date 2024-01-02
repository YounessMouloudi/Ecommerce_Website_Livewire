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
                    edit color
                    <a href="{{route('colors')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('update_color',$color->id) }}" method="POST" class="text-capitalize">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="" class="mb-1">color name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name',$color->name)}}">
                        @error('name') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="mb-1">color code</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code',$color->code)}}">
                        @error('code') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for=""class="mb-1" >status</label><br>
                        <input type="checkbox" name="status" {{ $color->status == '1' ? 'checked':'' }}> checked = hidden , un-checked = visible
                        @error('status') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
