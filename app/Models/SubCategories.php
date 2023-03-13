<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;


class SubCategories extends Model
{
    use HasFactory;

    public function Categories (){

        return $this->belongsTo(SubCategories::class);
    }
}
