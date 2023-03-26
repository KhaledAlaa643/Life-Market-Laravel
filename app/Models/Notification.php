<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
    ];
  

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
        $this->save();
    }
 

}