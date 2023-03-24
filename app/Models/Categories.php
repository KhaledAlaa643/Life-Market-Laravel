<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategories;

class Categories extends Model
{
    use HasFactory;
    protected $table="categories";

    public  function SubCategories (){

        return $this->hasMany(SubCategories::class);
    }
    protected $fillable = ['name','description','photo'];

}
