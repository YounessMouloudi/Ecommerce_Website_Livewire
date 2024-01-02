@extends('layouts.app')

@section('title','Change Password')


@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center text-capitalize">
            <div class="col-md-6">

                @if (session('messagePass'))
                    <h5 class="alert alert-success mb-3">{{ session('messagePass') }}</h5>
                @endif
                @if (session('PassFausse'))
                    <h5 class="alert alert-danger mb-3">{{ session('PassFausse') }}</h5>
                @endif

                {{-- @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif --}}

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">change password
                            <a href="{{ route('profile')}}" class="btn btn-danger btn-sm float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update_password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1">Current Password</label>
                                <input type="password" name="current_password" value="{{old('current-password')}}" class="form-control bg-white" />
                                <small class="text-danger"> @error('current_password') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-4">
                                <label class="mb-1">New Password</label>
                                <input type="password" name="password" value="{{old('password')}}" class="form-control bg-white" />
                                <small class="text-danger"> @error('password') {{ $message }} @enderror </small>
                            </div>
                            {{-- <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
                                <small class="text-danger"> @error('password_confirmation') {{ $message }} @enderror </small>
                            </div> --}}
                            <div class="mb-2 text-end">
                                <button type="submit" class="btn btn-primary text-capitalize">update password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection