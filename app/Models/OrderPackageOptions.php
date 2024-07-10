<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackageOptions extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'package_option_id',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function package_option(){
        return $this->belongsTo(PackageOptions::class);
    }
}
