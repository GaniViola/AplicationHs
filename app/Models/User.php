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

    // Scope untuk pencarian
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('username', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('phone', 'like', "%{$keyword}%")
                ->orWhere('photo', 'like', "%{$keyword}%")
                ->orWhere('address', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    // Scope untuk role
    public function scopeRole($query, $role)
    {
        if ($role) {
            $query->where('role', $role);
        }
        return $query;
    }
    // App\Models\User.php
public function services()
{
    return $this->belongsToMany(Service::class, 'service_user');
}

}
