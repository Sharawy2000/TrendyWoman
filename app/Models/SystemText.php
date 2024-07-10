<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemText extends Model
{
    use HasFactory;

    protected $fillable=[
        'page_name',
        'image',
    ];

    public function settings(){
        return $this->hasMany(Setting::class);
    }
    
}
