@extends('layouts.admin')

@section('title','Admin Setting')
    
@section('content')
<div class="row">   
    <div class="col-md-12 grid-margin text-capitalize">
        @if (session('message'))
            <div class="alert alert-success mb-3">{{session('message')}}</div>
        @endif

        <form action="" method="post">
            @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="mb-0">website</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">website name</label>
                            <input type="text" name="website_name" class="form-control" value="{{ old('website_name',$setting->website_name ?? '')}}">
                            <small class="text-danger"> @error('website_name') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">website url</label>
                            <input type="url" name="website_url" class="form-control" value="{{ old('website_url',$setting->website_url ?? '') }}">
                            <small class="text-danger"> @error('website_url') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="mb-2">page title</label>
                            <input type="text" name="page_title" class="form-control" value="{{ old('page_title',$setting->page_title ?? '') }}">
                            <small class="text-danger"> @error('page_title') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">meta keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{ old('meta_keyword',$setting->meta_keyword ?? '') }}</textarea>
                            <small class="text-danger"> @error('meta_keyword') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">meta description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description',$setting->meta_description ?? '') }}</textarea>
                            <small class="text-danger"> @error('meta_description') {{ $message }} @enderror </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="mb-0">website - information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="mb-2">address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address',$setting->address ?? '')}}</textarea>
                            <small class="text-danger"> @error('address') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">phone 1</label>
                            <input type="tel" name="phone1" class="form-control" value="{{ old('phone1',$setting->phone1 ?? '') }}">
                            <small class="text-danger"> @error('phone1') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">phone 2</label>
                            <input type="tel" name="phone2" class="form-control" value="{{ old('phone2',$setting->phone2 ?? '') }}">
                            <small class="text-danger"> @error('phone2') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">email 1</label>
                            <input type="email" name="email1" class="form-control" value="{{ old('email1',$setting->email1 ?? '' ) }}">
                            <small class="text-danger"> @error('email1') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">email 2</label>
                            <input type="email" name="email2" class="form-control" value="{{ old('email2',$setting->email2 ?? '') }}">
                            <small class="text-danger"> @error('email2') {{ $message }} @enderror </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="mb-0">website - social media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">facebook (optional)</label>
                            <input type="text" name="facebook" class="form-control" value="{{ old('facebook',$setting->facebook ?? '') }}">
                            <small class="text-danger"> @error('facebook') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">instagram (optional)</label>
                            <input type="text" name="instagram" class="form-control" value="{{ old('instagram',$setting->instagram ?? '') }}">
                            <small class="text-danger"> @error('instagram') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">twitter (optional)</label>
                            <input type="text" name="twitter" class="form-control" value="{{ old('twitter',$setting->twitter ?? '') }}">
                            <small class="text-danger"> @error('twitter') {{ $message }} @enderror </small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-2">youtube (optional)</label>
                            <input type="text" name="youtube" class="form-control" value="{{ old('youtube',$setting->youtube ?? '') }}">
                            <small class="text-danger"> @error('youtube') {{ $message }} @enderror </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn bg-primary text-white text-capitalize">save setting</button>
            </div>
        </form>
    </div>
</div>
@endsection