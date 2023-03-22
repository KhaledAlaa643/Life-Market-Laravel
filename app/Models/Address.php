<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
class Address extends Model
{
    protected $table="address";
    use HasFactory, Notifiable;
    public function user (){

        return $this->belongsTo(User::class);
}
protected $fillable = ['street','city','governorate','zip_code','user_id'];
}
