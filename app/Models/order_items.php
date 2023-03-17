<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\order;

class order_items extends Model
{
    use HasFactory;

    protected $table="order_items";

    public function order (){
        return $this->belongsTo(order_items::class);
    }
}
