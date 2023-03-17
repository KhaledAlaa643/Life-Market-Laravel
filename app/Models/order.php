<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class order extends Model
{protected $table="order";
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class);

}
}
