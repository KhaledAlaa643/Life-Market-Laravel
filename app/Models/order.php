<?php
namespace App\Models;
<<<<<<< HEAD

use App\Models\User;


=======
use App\Models\User;
>>>>>>> aml
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\order_items;

class order extends Model
{
    use HasFactory;
    protected $table="order";

    public function order_items (){
        return $this->hasMany(order::class);
    }

<<<<<<< HEAD
=======


    
>>>>>>> aml
    public function user (){

        return $this->belongsTo(User::class);
    }

}
<<<<<<< HEAD

=======
}
>>>>>>> aml
