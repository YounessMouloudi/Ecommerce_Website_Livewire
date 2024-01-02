<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',0)->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivProducts = Product::latest()->take(10)->get();
        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.index',compact('sliders','trendingProducts','newArrivProducts','featuredProducts'));
    }

    public function thanks()
    {
        return view('frontend.thanks');
    }

    public function categories()
    {
        $categories = Categorie::where('status',0)->get();
        return view('frontend.categories.index',compact('categories'));
    }

    public function products($slug)
    {
        $categorie = Categorie::where('slug',$slug)->first();
        // $brands = Brand::where('status','0')->get();

        if($categorie){

            // $products = $categorie->products()->get();
            return view('frontend.products.index',compact('categorie'));
        }
        else {
            return redirect()->back();
        }
    }

    public function productView($categorie_slug,$product_slug,$product_name)
    {
        
        $categorie = Categorie::where('slug',$categorie_slug)->first();
        
        if($categorie){

            $product = $categorie->products()->where('slug',$product_slug)->where('name',$product_name)->where('status','0')->first();
            
            $relatedProductsBrand = $categorie->products()->where('brand',$product->brand)->where('id','!=',$product->id)->get();
                        
            if($product){
                return view('frontend.products.view',compact('product','categorie','relatedProductsBrand'));

            }else{    
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }

    public function newArrivals()
    {
        $newArrivProducts = Product::latest()->take(3)->get();

        return view('frontend.pages.new-arrival',compact("newArrivProducts"));
    }

    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-products',compact("featuredProducts"));
    }

    public function searchProducts(Request $request)
    {
        if($request->search){
            
            $searchProducts = Product::where('name','like','%'.$request->search.'%')->latest()->paginate(1);
            return view('frontend.pages.search',compact("searchProducts"));
        }
        else {
            return redirect()->back()->with('message','Empty Search');
        }
    }

}
