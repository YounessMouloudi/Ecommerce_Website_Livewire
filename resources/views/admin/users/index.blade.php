@extends('layouts.admin')

@section('title','Users List')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="text-capitalize"> 
                    users list
                    <a href="{{ route('add_user')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">add user</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>role</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->role_as == "0")
                                        <label for="" class="badge btn-primary">user</label>
                                    @elseif($user->role_as == "1")
                                        <label for="" class="badge btn-success">admin</label>
                                    @else
                                        <label for="" class="badge btn-danger">none</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('edit_user',$user->id)}}" class="btn btn-success text-white">Edit</a>
                                    <a href="{{route('delete_user',$user->id)}}" onclick="return confirm('are you sure you want to delete this User ?!')" class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">no user available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end mt-2">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection