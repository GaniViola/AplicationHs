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
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'phone',
        'role',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
}
