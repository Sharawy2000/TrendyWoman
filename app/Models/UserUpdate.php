<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'new_phone',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
