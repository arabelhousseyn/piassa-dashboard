<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class User extends Model
{
    use  HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'email',
        'otp',
        'password',
        'phone_verified_at',
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
        'phone_verified_at' => 'datetime'
    ];

    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function vehicle()
    {
        return $this->hasMany(UserVehicle::class);
    }

    public function logins()
    {
        return $this->morphMany(Login::class,'loginable');
    }

    public function carts()
    {
        return $this->hasMany(UserCart::class);
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function commercial_info()
    {
        return $this->hasOne(UserInfo::class)->withDefault();
    }


}