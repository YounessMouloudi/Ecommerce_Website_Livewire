<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'categorie_id','id');
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class,'categorie_id','id')->latest();
    }

    public function brands()
    {
        return $this->hasMany(Brand::class,'categorie_id','id')->where('status','0');
    }
}
