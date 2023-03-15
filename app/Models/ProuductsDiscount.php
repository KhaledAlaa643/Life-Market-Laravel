<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class ProuductsDiscount extends Model
{
    use HasFactory;
    protected $table="products_discount";
    protected $fillable = ['discount'];

    public function Products (){

        return $this->belongsTo(Products::class);
    }


}
