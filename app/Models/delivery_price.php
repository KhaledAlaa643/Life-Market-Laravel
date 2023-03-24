<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_price extends Model
{
    use HasFactory;
    protected $table="delivery_price";
    protected $fillable=['governorate','price','time'];

  


}
