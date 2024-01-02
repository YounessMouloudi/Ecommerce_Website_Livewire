<div>
    <div class="row">
        <div class="col-md-3 text-capitalize">
            @if ($categorie->brands)
                <div class="card">
                    <div class="card-header">
                        <h4 class="">
                            brands 
                            {{-- <span class=""><input type="reset" class="btn btn-primary btn-sm" value="Reset Filter"
                                wire:model="brandInputs" wire:click="resetfilter">
                            </span> --}}
                        </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($categorie->brands as $brand)
                            <label for="{{$brand->id}}" class="d-block fs-5" >
                                <input type="checkbox" id="{{$brand->id}}" wire:model="brandInputs" wire:click="filterbyBrand"
                                 value="{{$brand->name}}"> {{$brand->name}}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4>price</h4>
                </div>
                <div class="card-body">
                        <label for="high-to-low" class="d-block fs-5">
                            <input type="radio" name="priceSort" id="high-to-low" wire:model="priceInput" wire:click="filterbyPrice"
                            value="high-to-low"> high to low
                        </label>
                        <label for="low-to-high" class="d-block fs-5">
                            <input type="radio" name="priceSort" id="low-to-high" wire:model="priceInput" wire:click="filterbyPrice"
                            wire:click="filterbyPrice"
                            value="low-to-high"> low to high
                        </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img p-2">
                                @if ($product->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">out of Stock</label>
                                @endif
                                @if ($product->productImages->count() > 0 )
                                    <a href="{{ route('view_product',[$categorie->slug,$product->slug,$product->name])}}">
                                        <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}" class="">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body p-3">
                                <p class="product-brand">{{$product->brand}}</p>
                                <h5 class="product-name">
                                <a href="{{ route('view_product',[$categorie->slug,$product->slug,$product->name])}}">
                                    {{$product->name}} 
                                </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{$product->selling_price}}</span>
                                    <span class="original-price">${{$product->original_price}}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="btn btn1">Add To Cart</a>
                                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                    <a href="{{$product->id}}" class="btn btn1"> View </a>
                                </div>
                            </div>
                        </div>
                    </div>                
                @empty
                    <div class="col-md-12 text-capitalize">
                        <div class="p-2">
                            <h4>no products available for {{ $categorie->name }}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
