<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieFormRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        return view('admin.categorie.index');
    }

    public function create()
    {
        return view('admin.categorie.create');
    }

    public function store(CategorieFormRequest $request)
    {
        $validatedData = $request->validated();

        $categorie = new Categorie();

        $categorie->name = $validatedData['name'];
        $categorie->slug = Str::slug($validatedData['slug']);
        $categorie->description = $validatedData['description'];
        
        $path = "uploads/categorie/";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move($path,$filename);

            $categorie->image = $path.$filename;
        }

        $categorie->meta_title = $validatedData['meta_title'];
        $categorie->meta_keyword = $validatedData['meta_keyword'];
        $categorie->meta_description = $validatedData['meta_description'];

        $categorie->status = $request->status == true ? '1':'0';

        $categorie->save();

        return redirect()->route('cat')->with('message','Categorie Added Successfully');
    }

    public function show(string $id)
    {
        
    }

    public function edit(Categorie $categorie)
    {
        return view('admin.categorie.edit',compact('categorie'));
    }

    public function update(CategorieFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $categorie = Categorie::findorFail($id);

        $categorie->name = $validatedData['name'];
        $categorie->slug = Str::slug($validatedData['slug']);
        $categorie->description = $validatedData['description'];
        
        if($request->hasFile('image')){

            $path = 'uploads/categorie/'.$categorie->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/categorie/',$filename);

            $categorie->image = $filename;
        }

        $categorie->meta_title = $validatedData['meta_title'];
        $categorie->meta_keyword = $validatedData['meta_keyword'];
        $categorie->meta_description = $validatedData['meta_description'];

        $categorie->status = $request->status == true ? '1':'0';

        $categorie->save();

        return redirect()->route('cat')->with('message','Categorie Updated Successfully');
    }

    public function destroy(string $id)
    {
        // $categorie = Categorie::findOrFail($id);
        
        // Categorie::where('id',$id)->delete();

        // return redirect()->route('cat')->with('message','Categorie Deleted Successfully');
    }
}
