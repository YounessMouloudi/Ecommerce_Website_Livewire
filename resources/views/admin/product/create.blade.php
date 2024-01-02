@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h3 class="text-capitalize"> 
                    <span>add product</span>
                    <a href="{{ route('products')}}" class="btn btn-primary btn-sm float-end text-light text-capitalize">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('save_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-capitalize" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                Home
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize" id="seotags-tab" data-bs-toggle="tab" data-bs-target="#seotags-tab-pane" type="button" role="tab" aria-controls="seotags-tab-pane" aria-selected="false">
                                seo tags
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                                details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                product image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-capitalize" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">
                                product color
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content text-capitalize" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active mt-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="" class="mb-1">categorie</label>
                                <select name="categorie_id" id="" class="form-control">
                                    @foreach ($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger"> @error('categorie_id') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">product name</label>
                                <input type="text" class="form-control" name="name">
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">product slug</label>
                                <input type="text" class="form-control" name="slug">
                                <small class="text-danger"> @error('slug') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">select brand</label>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->name}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger"> @error('brand') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">small description (500 words)</label>
                                <textarea type="text" class="form-control" name="small_description" rows="3"></textarea>
                                <small class="text-danger"> @error('small_description') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">description</label>
                                <textarea type="text" class="form-control" name="description" rows="3"></textarea>
                                <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="seotags-tab-pane" role="tabpanel" aria-labelledby="seotags-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="" class="mb-1">meta title</label>
                                <input type="text" class="form-control" name="meta_title">
                                <small class="text-danger"> @error('meta_title') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">meta keyword</label>
                                <textarea type="text" class="form-control" name="meta_keyword" rows="3"></textarea>
                                <small class="text-danger"> @error('meta_keyword') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">meta description</label>
                                <textarea type="text" class="form-control" name="meta_description" rows="3"></textarea>
                                <small class="text-danger"> @error('meta_description') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">original price</label>
                                        <input type="text" class="form-control" name="original_price">
                                        <small class="text-danger"> @error('original_price') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">selling price</label>
                                        <input type="text" class="form-control" name="selling_price">
                                        <small class="text-danger"> @error('selling_price') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">quantity</label>
                                        <input type="number" class="form-control" name="quantity">
                                        <small class="text-danger"> @error('quantity') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">trending</label>
                                        <input type="checkbox" name="trending" style="width: 20px; height:20px;">
                                        <small class="text-danger"> @error('trending') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">featured</label>
                                        <input type="checkbox" name="featured" style="width: 20px; height:20px;">
                                        <small class="text-danger"> @error('featured') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">status</label>
                                        <input type="checkbox" name="status" style="width: 20px; height:20px;">
                                        <small class="text-danger"> @error('status') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="" class="mb-1">product image</label>
                                <input type="file" name="image[]" class="form-control" multiple id="">
                                <small class="text-danger"> @error('image') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="" class="mb-3">select color</label>
                                <div class="row">
                                    @forelse ($colors as $color)
                                        <div class="col-md-3">
                                            <div class="p-2 border mb-2">
                                                color : <input type="checkbox" name="colors[]" value="{{$color->id}}">  {{$color->name}} 
                                                <small class="text-danger"> @error('colors') {{ $message }} @enderror </small>
                                                <br>
                                                quantity : <input type="number" name="colorQte[{{$color->id}}]" style="border: 1px solid; width:50px"> 
                                                <small class="text-danger"> @error('colorQte') {{ $message }} @enderror </small>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <h1>no color found</h1>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary text-white text-capitalize">
                            submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection