<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('uploads/sliders/',$filename);
            $validatedData['image'] = "uploads/sliders/$filename";
        }

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $request->status == true ? '1':'0'
        ]);

        return redirect()->route('sliders')->with('message','Slider Added Successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){

            // $path = $slider->image;
            // if(File::exists($path)){
            //     File::delete($path);
            // }

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('uploads/sliders/',$filename);
            $validatedData['image'] = "uploads/sliders/$filename";
        }

        Slider::where('id',$slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $request->status == true ? '1':'0'
        ]);

        return redirect()->route('sliders')->with('message','Slider Updated Successfully');

    }

    public function destroy(Slider $slider)
    {
        // dd($slider->count() > 0);
        $path = $slider->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $slider->delete();

        return redirect()->route('sliders')->with('message','Slider Deleted Successfully');

    }
}
