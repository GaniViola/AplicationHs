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
        'worker_id'
    ];

    public static function PendingRequests() {
        return self::where('status', 'pending')->count();
    }

    public static function totalSetoran()
    {
        return self::count();
    }

    public static function jumlahSelesai()
    {
        return self::where('status', 'selesai')->count();
    }

    public static function persentaseSelesai()
    {
        $total = self::totalSetoran();
        $selesai = self::jumlahSelesai();

        return $total > 0 ? round(($selesai / $total) * 100, 2) : 0;
    }

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
    public function setoran()
{
    return $this->hasOne(Setoran::class);
}


public function orderDetails()
{
    return $this->hasMany(OrderDetails::class, 'id_orders'); // Sesuai kolom foreign key di order_details
}

public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id'); // pekerja
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id'); // customer
    }
public function workPhotos()
{
    return $this->hasMany(WorkPhoto::class, 'order_id');
}

}

