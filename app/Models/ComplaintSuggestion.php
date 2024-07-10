<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintSuggestion extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'user_id',
        'user_name',
        'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
