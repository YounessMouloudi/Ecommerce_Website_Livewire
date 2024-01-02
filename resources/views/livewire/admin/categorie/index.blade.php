<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Categorie Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCategorie()">
                    <div class="modal-body">
                        <h6 class="text-capitalize">are you sure you want to delete this categorie ?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes. Delete it</button>
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
                <div class="card-header">
                    <h3 class="text-capitalize"> 
                        categorie
                        <a href="{{ route('add_categorie')}}" class="btn btn-primary btn-sm float-end text-white text-capitalize">add categorie</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-capitalize">
                        <thead>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categorie)
                                <tr>
                                    <td>{{$categorie->id}}</td>
                                    <td>{{$categorie->name}}</td>
                                    <td>{{$categorie->status == '1' ? 'Hidden':'Visible'}}</td>
                                    <td>
                                        <a href="{{route('edit_categorie',$categorie->id)}}" class="btn btn-success text-white">Edit</a>
                                        <a href="#" wire:click="deleteCategorie({{$categorie->id}})" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end mt-2">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @push('script')
    <script>
        window.addEventListener('close-modal',event => {
            $('deleteModal').modal('hide');
        })
    </script>
@endpush --}}
