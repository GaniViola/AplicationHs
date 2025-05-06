<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders; // <--- tambahkan ini!
use App\Models\User;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setorans';
    protected $primaryKey = 'id_setoran';

    protected $fillable = [
        'id_orders',
        'id',
        'jumlah_setoran',
        'tanggal_setoran',
        'status_setoran',
    ];

    public function Order()
    {
        return $this->belongsTo(Orders::class, 'id_orders');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
