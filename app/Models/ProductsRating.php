<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class ProductsRating extends Model
{
    use HasFactory;
    protected $table="products_rating";
    protected $fillable = ['review','star'];

    
    public function Products (){

        return $this->belongsTo(Products::class);
    }
}

