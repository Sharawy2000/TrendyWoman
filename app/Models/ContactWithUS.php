<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWithUS extends Model
{
    use HasFactory;

    //fillabe
    protected $fillable = [
        'email',
        'phone_number'
    ];

    public function settings(){
        return $this->hasMany(Setting::class);
    }
    
}
