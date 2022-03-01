<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCommission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_order_id',
        'amount'
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public function userOrder()
    {
        return $this->belongsTo(UserOrder::class,'user_order_id')->withDefault();
    }
}
