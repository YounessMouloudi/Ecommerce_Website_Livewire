<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Categorie;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $name,$slug,$status,$id,$categorie_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'categorie_id' => 'required|integer',
            'status' => 'nullable',
        ];
    }

    public function resetInput()
    {
        $this->name = null;
        $this->slug = null;
        $this->status = null;
        $this->categorie_id = null;
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
            'categorie_id' => $this->categorie_id
        ]);
        session()->flash('message','Brand Added Successfully');
        $this->resetInput();
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function editBrand(int $id)
    {
        $this->id = $id;
        $brand = Brand::findOrFail($id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->categorie_id = $brand->categorie_id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
            'categorie_id' => $this->categorie_id
        ]);
        session()->flash('message','Brand Updated Successfully');
        $this->resetInput();
    }

    public function deleteBrand(int $id)
    {
       $this->id = $id;
    }

    public function destroyBrand()
    {
        $brand = Brand::find($this->id);

        $brand->delete();
        session()->flash('message','Brand Deleted Successfully');
    }

    public function render()
    {
        $categories = Categorie::where('status',0)->get();
        $brands = Brand::orderBy('id','Desc')->paginate(10);
        return view('livewire.admin.brand.index',compact('brands','categories'));
    }
}
