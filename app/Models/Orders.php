<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Orderdetails;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    // HAPUS atau KOMEN baris ini karena salah
    // protected $primaryKey = 'id_orders'; 

    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'kembalian',
        'tanggal_pemesanan',
        'status',
        'metode_pembayaran',
    ];

    public $timestamps = false; // INI TAMBAHKAN KARENA TABLE orders TIDAK PUNYA created_at, updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders_details()
    {
        return $this->hasMany(Orderdetails::class, 'id_orders');
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'id_orders');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'id_orders', 'id');
    }
}
