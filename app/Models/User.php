<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    // Menambahkan method untuk menentukan jika user adalah pekerja
    public function isWorker()
    {
        return $this->role === self::ROLE_WORKER;
    }

    // Menambahkan method untuk menentukan jika user adalah customer
    public function isCustomer()
    {
        return $this->role === self::ROLE_CUSTOMER;
    }
}

