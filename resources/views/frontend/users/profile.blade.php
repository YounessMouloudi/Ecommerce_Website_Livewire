@extends('layouts.app')

@section('title','User Profile')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row text-capitalize justify-content-center">
            <div class="col-md-10">
                <h4>user profile
                    <a href="{{route('change-password')}}" class="btn btn-warning float-end">change password ?</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            <div class="col-md-10">
                @if (session('messageUser'))
                    <div class="alert alert-success">{{session('messageUser')}}</div>
                @endif
    
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">user details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update_profile')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mb-2">username</label>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control bg-white">
                                        <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mb-2">email address</label>
                                        <input type="text" name="email" readonly value="{{ Auth::user()->email }}" class="form-control">
                                        <small class="text-danger"> @error('email') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mb-2">phone number</label>
                                        <input type="tel" name="phone" value="{{old('phone',Auth::user()->userDetail->phone ?? '')}}" class="form-control bg-white">
                                        <small class="text-danger"> @error('phone') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mb-2">zip/pin code</label>
                                        <input type="text" name="pin_code" value="{{old('pin_code',Auth::user()->userDetail->pin_code ?? '')}}" class="form-control bg-white">
                                        <small class="text-danger"> @error('pin_code') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mb-2">address</label>
                                        <textarea name="address" class="form-control bg-white" id="" cols="30" rows="2">{{old('address',Auth::user()->userDetail->address ?? '')}}</textarea>
                                        <small class="text-danger"> @error('address') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
