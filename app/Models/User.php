<?php

namespace App\Models;
use App\Models\Notification;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use App\Models\order;
use App\Models\Address;
class User extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'type',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function address()
    {
        return $this->hasMany(Address::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
//     public function notifications()
//     {
//         return $this->hasMany(Notification::class);
//     }
//     public function unreadNotifications()
// {
//     return $this->notifications()->whereNull('read_at');
// }
public function notifications()
{
    return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
}

public function unreadNotifications()
{
    return $this->notifications()->whereNull('read_at');
}

} 
