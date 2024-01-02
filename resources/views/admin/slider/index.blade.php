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
                    slider list
                    <a href="{{route('add_slider')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">add slider</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <th>id</th>
                        <th>title</th>
                        <th>description</th>
                        <th>image</th>
                        <th>status</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td>
                                    <img src="{{asset($slider->image)}}" alt="slider" style="width: 50px; height:50px">
                                </td>
                                <td>{{$slider->status == '1' ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{route('edit_slider',$slider->id)}}" class="btn btn-success text-white mb-2">Edit</a>
                                    <a href="{{route('delete_slider',$slider->id)}}" onclick="return confirm('are you sure you want to delete this slider ?')" class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">no sliders</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end mt-2">
                    {{-- {{$sliders->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection