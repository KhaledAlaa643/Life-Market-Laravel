<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsRating;
use App\Models\ProuductsDiscount;
use App\Models\SubCategories;
use App\Models\product_photos;


class Products extends Model
{
    use HasFactory;

    public function ProductsRating()
    {
      return $this->hasMany(ProductsRating::class);
    }
    public function ProuductsDiscount()
    {
        return $this->hasOne(ProuductsDiscount::class);
    }
    public function SubCategories (){

        return $this->belongsTo(SubCategories::class);
    }
    public function product_photos()
    {
      return $this->hasMany(product_photos::class);
    }
}
