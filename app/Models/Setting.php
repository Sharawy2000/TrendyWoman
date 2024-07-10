<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'text_id',
        'terms_conditions',
        'who_are_we',

    ];

    public function contact(){
        return $this->belongsTo(ContactWithUS::class);
    }

    public function text(){
        return $this->belongsTo(SystemText::class);
    }
}
