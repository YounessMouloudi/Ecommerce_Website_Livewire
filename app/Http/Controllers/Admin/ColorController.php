<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.index',compact('colors'));
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();

        Color::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1':'0',
        ]);

        return redirect()->route('colors')->with('message','Color Added Successfully');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(int $id)
    {
        $color = Color::findOrFail($id);

        return view('admin.color.edit',compact('color'));
    }

    public function update(ColorFormRequest $request, int $id)
    {
        $validatedData = $request->validated();

        Color::findOrFail($id)->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1':'0',
        ]);

        return redirect()->route('colors')->with('message','Color Updated Successfully');

    }

    public function destroy(string $id)
    {
        Color::findOrFail($id)->delete();

        return redirect()->route('colors')->with('message','Color deleted Successfully');
    }
}
