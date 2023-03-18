<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\order_items;

class order extends Model
{
    use HasFactory;
    protected $table="order";

    public function order_items (){
        return $this->hasMany(order::class);
    }
=======
use App\Models\User;
class order extends Model
{protected $table="order";
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class);

}
>>>>>>> aml
}
