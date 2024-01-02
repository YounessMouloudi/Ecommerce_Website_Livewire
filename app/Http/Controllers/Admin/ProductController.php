<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $brands = Brand::all();
        $colors = Color::where('status',0)->get();
        return view('admin.product.create',compact('categories','brands','colors'));
    }

    public function store(ProductFormRequest $request)
    {
        $validateData = $request->validated();

        $categorie = Categorie::findOrFail($validateData['categorie_id']);

        $product = $categorie->products()->create([
            'name' => $validateData['name'],
            'slug' => $validateData['slug'],
            'brand' => $validateData['brand'],
            'categorie_id' => $validateData['categorie_id'],
            'small_description' => $validateData['small_description'],
            'description' => $validateData['description'],
            'original_price' => $validateData['original_price'],
            'selling_price' => $validateData['selling_price'],
            'quantity' => $validateData['quantity'],
            'trending' => $request->trending == true ? '1':'0',
            'featured' => $request->featured == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'meta_title' => $validateData['meta_title'],
            'meta_keyword' => $validateData['meta_keyword'],
            'meta_description' => $validateData['meta_description'],
        ]);

        if($request->hasFile('image')){
            
            $uploadPath = 'uploads/products/';

            foreach ($request->file('image') as $imageFile) {

                // $ext = $imageFile->getClientOriginalExtension();
                $filename = $imageFile->getClientOriginalName();
                $imageFile->move($uploadPath,$filename);
                $ImagePath = $uploadPath.$filename;

                $i = $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $ImagePath
                ]);

            }
        }

        if($request->colors){
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorQte[$key] ?? 0
                ]);
            }
        }

        return redirect()->route('products')->with('message','Product Added Successfully'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $categories = Categorie::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$product_color)->get();
        return view('admin.product.edit',compact('product','categories','brands','colors'));
    }

    public function update(ProductFormRequest $request, int $prdt_id)
    {

        $validateData = $request->validated();

        $product = Categorie::findOrFail($validateData['categorie_id'])
        ->products()->where('id',$prdt_id)->first();

        if($product){

            $product->update([
                'name' => $validateData['name'],
                'slug' => $validateData['slug'],
                'brand' => $validateData['brand'],
                'categorie_id' => $validateData['categorie_id'],
                'small_description' => $validateData['small_description'],
                'description' => $validateData['description'],
                'original_price' => $validateData['original_price'],
                'selling_price' => $validateData['selling_price'],
                'quantity' => $validateData['quantity'],
                'trending' => $request->trending == true ? '1':'0',
                'featured' => $request->featured == true ? '1':'0',
                'status' => $request->status == true ? '1':'0',
                'meta_title' => $validateData['meta_title'],
                'meta_keyword' => $validateData['meta_keyword'],
                'meta_description' => $validateData['meta_description'],
                
            ]);

            if($request->hasFile('image')){
            
                $uploadPath = 'uploads/products/';
    
                foreach ($request->file('image') as $imageFile) {
    
                    $filename = $imageFile->getClientOriginalName();
                    $imageFile->move($uploadPath,$filename);
                    $ImagePath = $uploadPath.$filename;
    
                    $i = $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $ImagePath
                    ]);
    
                }
            }

            if($request->colors){
                foreach ($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorQte[$color] ?? 0
                    ]);
                }
            }

            return redirect()->route('products')->with('message','Product Updated Successfully'); 

        }
        else {
            return redirect()->route('products')->with('message','No Such Product Id Found'); 
        }


    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        if($product->productImages){
            foreach ($product->productImages as $image ) {
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }

        $product->delete();

        return redirect()->route('products')->with('message','Product Deleted Successfully'); 
    }

    public function destroyImage(int $id_image)
    {
        $productImage = ProductImage::findOrFail($id_image);
        
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }

        $productImage->delete();

        return redirect()->back()->with('message','Product Image Deleted');
    }

    public function updateProductColor(Request $request, $id)
    {
        $prodColorData = Product::findOrFail($request->product_id)->productColors()->where('id',$id)->first();
        
        $prodColorData->update([
            'quantity' => $request->Qte,
        ]);
        
        return response()->json(['message' => 'Product Color Qte Updated Successfully']);
    }

    public function deleteProductColor($id)
    {
        $prodColor = ProductColor::findOrFail($id);
        
        $prodColor->delete();
        
        return response()->json(['message' => 'Product Color Deleted Successfully']);
    }
}
