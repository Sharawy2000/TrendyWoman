<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'image',
        'is_blocked',
        'is_active',
        'activation_code',
        'email_verified_at',
        'password',
        'remember_token',
        'code',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function complaints_suggestions(){
        return $this->hasMany(ComplaintSuggestion::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function order_responses(){
        return $this->hasMany(OrderResponse::class);
    }
    public function reset_passwords(){
        return $this->hasMany(ResetPassword::class);
    }
    public function subacriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function user_updates(){
        return $this->hasMany(UserUpdate::class);
    }
}
