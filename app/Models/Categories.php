<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategories;

class Categories extends Model
{
    use HasFactory;

    public  function SubCategories (){

        return $this->hasMany(SubCategories::class);
    }
}
