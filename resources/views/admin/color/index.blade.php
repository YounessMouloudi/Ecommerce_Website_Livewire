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
                    colors list
                    <a href="{{route('add_color')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">add color</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>code</th>
                        <th>status</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                            <tr>
                                <td>{{$color->id}}</td>
                                <td>{{$color->name}}</td>
                                <td>{{$color->code}}</td>
                                <td>{{$color->status == '1' ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{route('edit_color',$color->id)}}" class="btn btn-success text-white">Edit</a>
                                    <a href="{{route('delete_color',$color->id)}}" onclick="return confirm('are you sure you want to delete this Color ?!')" class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">no colors</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end mt-2">
                    {{-- {{$colors->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
