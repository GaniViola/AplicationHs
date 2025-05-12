<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Clockwork\Request\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Definisikan role
    const ROLE_CUSTOMER = 'customer';
    const ROLE_WORKER = 'worker';

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'phone',
        'role',  // Pastikan 'role' ada di sini
        'photo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function service() {
        return $this->belongsToMany(Service::class);
    }

    public function scopeFilter($query, $request) {
        if($request['searchuser']) {
           return $query->where('username', 'like', '%'. $request['searchuser']. '%')
                  ->orWhere('email', 'like', '%'. $request['searchuser']. '%')
                  ->orWhere('address', 'like', '%'. $request['searchuser']. '%')
                  ->orWhere('phone', 'like', '%'. $request['searchuser']. '%')
                  ->orWhere('role', 'like', '%'. $request['searchuser']. '%');
        }
    }
    // App\Models\User.php
public function services()
{
    return $this->belongsToMany(Service::class, 'service_user');
}

}
