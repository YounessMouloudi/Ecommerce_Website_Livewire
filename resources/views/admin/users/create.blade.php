@extends('layouts.admin')

@section('title','Add User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card text-capitalize">
            <div class="card-header py-3">
                <h3 class=""> 
                    <span>add user</span>
                    <a href="{{ route('users')}}" class="btn btn-primary btn-sm float-end text-light text-capitalize">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('save_user')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">name</label>
                            <input type="text" name="name" class="form-control">
                            <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">email</label>
                            <input type="email" name="email" class="form-control">
                            <small class="text-danger"> @error('email') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">password</label>
                            <input type="text" name="password" class="form-control">
                            <small class="text-danger"> @error('password') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">select role</label>
                            <select name="role" id="" class="form-select">
                                <option value="">select role</option>
                                <option value="0">user</option>
                                <option value="1">admin</option>
                            </select>
                            <small class="text-danger"> @error('role') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary text-white text-capitalize">
                                submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection