<?php

namespace App\Livewire\Admin\Categorie;

use App\Models\Categorie;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $categorie_id;

    public function deleteCategorie($categorie_id)
    {
       $this->categorie_id = $categorie_id;
    }
    public function destroyCategorie()
    {
        $categorie = Categorie::find($this->categorie_id);

        $path = 'uploads/categorie/'.$categorie->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $categorie->delete();
        session()->flash('message','Categorie Deleted Successfully');
    }

    public function render()
    {
        $categories = Categorie::orderBy('id','Desc')->paginate(10);
        return view('livewire.admin.categorie.index',compact('categories'));
    }
}
