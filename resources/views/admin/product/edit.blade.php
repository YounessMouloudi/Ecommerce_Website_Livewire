@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card-header py-3">
                <h3 class="text-capitalize"> 
                    <span>edit product</span>
                    <a href="{{ route('products')}}" class="btn btn-primary btn-sm float-end text-light text-capitalize">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('update_product',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                        <option value="{{$cat->id}}" {{$cat->id == $product->categorie_id ? 'selected':''}}>
                                            {{$cat->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger"> @error('categorie_id') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">product name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name',$product->name)}}">
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">product slug</label>
                                <input type="text" class="form-control" name="slug" value="{{old('slug',$product->slug)}}">
                                <small class="text-danger"> @error('slug') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">select brand</label>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->name}}" {{$brand->name == $product->brand ? 'selected':''}}>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger"> @error('brand') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">small description (500 words)</label>
                                <textarea type="text" class="form-control" name="small_description" rows="3">{{old('small_description',$product->small_description)}}</textarea>
                                <small class="text-danger"> @error('small_description') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">description</label>
                                <textarea type="text" class="form-control" name="description" rows="3">{{old('description',$product->description)}}</textarea>
                                <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="seotags-tab-pane" role="tabpanel" aria-labelledby="seotags-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="" class="mb-1">meta title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title',$product->meta_title)}}">
                                <small class="text-danger"> @error('meta_title') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">meta keyword</label>
                                <textarea type="text" class="form-control" name="meta_keyword" rows="3">{{old('meta_keyword',$product->meta_keyword)}}</textarea>
                                <small class="text-danger"> @error('meta_keyword') {{ $message }} @enderror </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">meta description</label>
                                <textarea type="text" class="form-control" name="meta_description" rows="3">{{old('meta_description',$product->meta_description)}}</textarea>
                                <small class="text-danger"> @error('meta_description') {{ $message }} @enderror </small>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">original price</label>
                                        <input type="text" class="form-control" name="original_price" value="{{old('original_price',$product->original_price)}}">
                                        <small class="text-danger"> @error('original_price') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">selling price</label>
                                        <input type="text" class="form-control" name="selling_price" value="{{old('selling_price',$product->selling_price)}}">
                                        <small class="text-danger"> @error('selling_price') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="mb-1">quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="{{old('quantity',$product->quantity)}}">
                                        <small class="text-danger"> @error('quantity') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">trending</label>
                                        <input type="checkbox" name="trending" style="width: 20px; height:20px;" @if($product->trending == '1') ? checked : null @endif>
                                        <small class="text-danger"> @error('trending') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">featured</label>
                                        <input type="checkbox" name="featured" style="width: 20px; height:20px;" {{ $product->featured == '1' ? 'checked' : '' }}>
                                        <small class="text-danger"> @error('featured') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="me-1">status</label>
                                        <input type="checkbox" name="status" style="width: 20px; height:20px;" @if($product->status == '1') ? checked : null @endif>
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
                            <div>
                                @if($product->productImages)
                                    <div class="row">
                                        @foreach ($product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{asset($image->image)}}" class="me-4 border" alt="" style="width: 80px; height:80px;">
                                                <a href="{{route('delete_image',$image->id)}}" class="d-block">Remove</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h5>no image added</h5>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 mt-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                            <div class="mb-3">
                                <h4>add product color</h4>
                                <label class="mb-3">select color</label>
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
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>color name</th>
                                                <th>color quantity</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->productColors as $prdColor)                                                
                                                <tr class="productColor_tr">
                                                    <td>{{$prdColor->color->name}}</td>
                                                    <td>
                                                        <div class="input-group mb-3" style="width: 150px">
                                                            <input type="number" class="productColorQte form-control form-control-sm mt-3" min="0" value="{{$prdColor->quantity}}">
                                                            <button type="button" class="updateProductColor btn btn-primary btn-sm text-white mt-3" value="{{$prdColor->id}}">Update</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="deleteProductColor btn btn-danger btn-sm text-white" value="{{$prdColor->id}}">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary text-white text-capitalize">
                            update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).on('click','.updateProductColor',function(){
            
            var product_id = "{{ $product->id }}";
            var prodColor_id = $(this).val();
            var Qte = $(this).closest('.productColor_tr').find('.productColorQte').val(); 

            var data = {
                'product_id' : product_id,
                // 'prodColor_id' : prodColor_id,
                'Qte' : Qte,
            };

            $.ajax({
                type : 'POST',
                url : "/admin/product-color/"+prodColor_id,
                data : data,
                success: function (response) {
                    alert(response.message);
                }
            })

        });

        $(document).on('click','.deleteProductColor',function(){
            
            var prodColor_id = $(this).val();
            var thisClick = $(this); 

            $.ajax({
                type : 'GET',
                url : "/admin/product-color/"+prodColor_id+"/delete",
                success: function (response) {
                    thisClick.closest('.productColor_tr').remove();
                    alert(response.message);
                }
            })

        })
    })
</script>

@endsection