<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Products;


class SubCategories extends Model
{
    use HasFactory;
    protected $table="sub_categories";

    public function Categories (){

        return $this->belongsTo(SubCategories::class);
    }

    public function Products()
    {
      return $this->hasMany(Products::class);
    }
    protected $fillable = ['name','description','cat_id'];

}
