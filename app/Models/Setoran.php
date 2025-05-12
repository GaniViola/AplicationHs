<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Orders; // <--- tambahkan ini!
use App\Models\User;

class Setoran extends Model
{
    protected $fillable = [
        'order_id',
        'worker_id',
        'jumlah_setoran',
        'jumlah_admin',
        'jumlah_pekerja',
        'tanggal_setoran',
        'status_setoran',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

   public function worker()
{
    return $this->belongsTo(User::class, 'worker_id');
}
    // Dapatkan customer melalui relasi order
    public function customer()
    {
        return $this->belongsToThrough(User::class, Orders::class, 'user_id');
    }
}
