<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categorie_id','id');
    }
}
