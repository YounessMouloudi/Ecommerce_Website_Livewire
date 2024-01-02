@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h3 class="text-capitalize"> 
                    <span>edit categorie</span>
                    <a href="{{ route('cat')}}" class="btn btn-primary btn-sm float-end text-light text-capitalize">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('update_categorie',$categorie->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row text-capitalize">
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-1">name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name',$categorie->name) }}">
                            <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-1">slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug',$categorie->slug) }}">
                            <small class="text-danger"> @error('slug') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="mb-1">description</label>
                            <textarea name="description" id="" class="form-control" cols="0" rows="3">
                                {{old('description',$categorie->description)}}
                            </textarea>
                            <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-1">image</label>
                            <div class="d-flex">
                                <input type="file" class="form-control me-3" name="image" value="{{ old('image')}}">
                                <img src="{{asset('uploads/categorie/'.$categorie->image)}}" alt="" width="60px" height="60px">
                            </div>
                            <small class="text-danger"> @error('image') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="mb-1">status</label><br>
                            <input type="checkbox" class="" name="status" {{$categorie->status == '1'? 'checked':''}} id="status">
                        </div>
                        <div class="col-md-12 mb-3 mt-1">
                            <h4>seo tags</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-1">meta title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title',$categorie->meta_title) }}">
                            <small class="text-danger"> @error('meta_title') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="mb-1">meta keyword</label>
                            <textarea name="meta_keyword" id="" class="form-control" cols="0" rows="3">
                                {{ old('meta_keyword',$categorie->meta_keyword)}}
                            </textarea>
                            <small class="text-danger"> @error('meta_keyword') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="mb-1">meta description</label>
                            <textarea name="meta_description" id="" class="form-control text-start" cols="0" rows="3">
                                {{ old('meta_description',$categorie->meta_description)}}
                            </textarea>
                            <small class="text-danger"> @error('meta_description') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary text-white float-end text-capitalize">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection