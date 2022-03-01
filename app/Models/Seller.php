<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Seller extends Model
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

    protected $appends = ['has_location'];

    public function profile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    public function jobs()
    {
        return $this->hasMany(SellerJob::class);
    }

    public function requests()
    {
        return $this->hasMany(SellerRequest::class);
    }

    public function phones()
    {
        return $this->hasMany(SellerPhone::class);
    }

    public function getHasLocationAttribute()
    {
        if($this->profile->location === null)
        {
            return false;
        }else{
            return true;
        }
    }

}
