<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'note'
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault([]);
    }

}
