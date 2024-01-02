<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    
    public $products, $categorie,$priceInput;
    public $brandInputs = [];

    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function mount($categorie)
    {
        $this->categorie = $categorie;
        // $this->products = $products;
    }

    public function filterbyBrand()
    {
        $this->products = Product::where('categorie_id', $this->categorie->id)
            ->when($this->brandInputs, function ($query) {
                $query->whereIn('brand', $this->brandInputs);
        })->where('status','0')->get();
    }

    public function filterbyPrice()
    {
        $this->products = Product::where('categorie_id', $this->categorie->id)
            ->when($this->priceInput, function($query) {
                            
                $query->when($this->priceInput == 'high-to-low', function($query2){
                    
                    $query2->orderBy('selling_price','desc');
                
                })->when($this->priceInput == 'low-to-high', function($query2){
                    
                    $query2->orderBy('selling_price','asc');
                
                });                   
        })->where('status','0')->get(); 
    }

    public function render()
    {
        // dd($request->query->has('brand'));

        $this->products = Product::where('categorie_id',$this->categorie->id)
                        ->when($this->brandInputs, function($query) {

                            $query->whereIn('brand',$this->brandInputs);
                        
                        })->when($this->priceInput, function($query) {
                            
                            $query->when($this->priceInput == 'high-to-low', function($query2){
                                
                                $query2->orderBy('selling_price','desc');
                            
                            })->when($this->priceInput == 'low-to-high', function($query2){
                                
                                $query2->orderBy('selling_price','asc');
                            
                            });                   
                        })->where('status','0')->get();                        

        return view('livewire.frontend.product.index',[
            'products' => $this->products,
            'categorie' => $this->categorie,
        ]);
    }
}
