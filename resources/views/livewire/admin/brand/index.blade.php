<div>
    {{-- add modal --}}
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeBrand" class="text-capitalize">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="mb-1">select category</label>
                            <select wire:model.defer="categorie_id" id="" class="form-control">
                                <option value="">--select category--</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                            @error('categorie_id') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">brand name</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">brand slug</label>
                            <input type="text" class="form-control" wire:model.defer="slug">
                            @error('slug') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for=""class="mb-1" >status</label><br>
                            <input type="checkbox" wire:model.defer="status"> checked = hidden , un-checked = visible
                            @error('status') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white" data-bs-dismiss="modal">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- update modal --}}
    <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brand</h1>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading class="p-2 text-center fs-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> Loading...
                </div> 
                <div wire:loading.remove>
                    <form wire:submit.prevent="updateBrand" class="text-capitalize">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="mb-1">select category</label>
                                <select wire:model.defer="categorie_id" id="" class="form-control">
                                    <option value="">--select category--</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @endforeach
                                </select>
                                @error('categorie_id') <small class="text-danger">{{$message}}</small>@enderror
                            </div>    
                            <div class="mb-3">
                                <label for="" class="mb-1">brand name</label>
                                <input type="text" class="form-control" wire:model.defer="name">
                                @error('name') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-1">brand slug</label>
                                <input type="text" class="form-control" wire:model.defer="slug">
                                @error('slug') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="mb-3">
                                <label for=""class="mb-1" >status</label><br>
                                <input type="checkbox" wire:model.defer="status"> checked = hidden , un-checked = visible
                                @error('status') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success text-white" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- delete modal --}}
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <h6 class="text-capitalize">are you sure you want to delete this brand ?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes. Delete it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <div class="card-header text-capitalize">
                    <h4>
                        brands list
                        <a href="" class="btn btn-primary btn-sm float-end text-white text-capitalize" data-bs-toggle="modal" data-bs-target="#addBrandModal">add brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-capitalize">
                        <thead>
                            <th>id</th>
                            <th>name</th>
                            <th>slug</th>
                            <th>categorie</th>
                            <th>status</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->name}}</td>
                                    <td>{{$brand->slug}}</td>
                                    @if($brand->categorie)
                                        <td>{{$brand->categorie->name}}</td>
                                    @else
                                        <td>no categorie founded</td>
                                    @endif
                                    <td>{{$brand->status == '1' ? 'Hidden':'Visible'}}</td>
                                    <td>
                                        <a href="" wire:click="editBrand({{$brand->id}})" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#updateBrandModal">Edit</a>
                                        <a href="" wire:click="deleteBrand({{$brand->id}})" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteBrandModal">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">no brands</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-end mt-2">
                        {{$brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
