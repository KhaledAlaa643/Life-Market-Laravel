<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsRating;
use App\Models\ProuductsDiscount;
use App\Models\SubCategories;
use App\Models\product_photos;


class Products extends Model
{protected $table="products";
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
    protected $fillable = ['name',
    'description',
    'price_before_discount',
    'price',
    'brand',
    'quantity',
    'photo',
    'prd_rating',
    'selling_count',
    'sub_cat_id',
    'user_id'];


}
