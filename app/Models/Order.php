<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'size_id',
        'body_shape_id',
        'user_name',
        'user_phone',
        'age',
        'gender',
        'occation',
        'occation_date',
        'balance',
        'value_added',
        'order_price',
        'rating',
        'status',
        'image',
        'cancel_reason',

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function body_shape(){
        return $this->belongsTo(BodyShape::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function order_images(){
        return $this->hasMany(OrderImage::class);
    }
    public function order_responses(){
        return $this->hasMany(OrderResponse::class);
    }
    public function order_package_options(){
        return $this->hasMany(OrderPackageOptions::class);
    }
}
