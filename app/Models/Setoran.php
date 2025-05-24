<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Orders;
use App\Models\User;

class Setoran extends Model
{
    use HasFactory;
    
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

    public static function earningsMonthly()
    {
        return self::whereMonth('tanggal_setoran', now()->month)
                    ->whereYear('tanggal_setoran', now()->year)
                    ->sum('jumlah_setoran');
    }

    public static function earningsAdmin()
    {
        return self::whereYear('tanggal_setoran', now()->year)
                    ->sum('jumlah_admin');
    }

    public static function getSetoranPerBulan() {
        $data = DB::table('setorans')
                ->selectRaw('MONTH(tanggal_setoran) as bulan, SUM(jumlah_setoran) as total')
                ->whereYear('tanggal_setoran', date('Y'))
                ->groupBy(DB::raw('MONTH(tanggal_setoran)'))
                ->pluck('total', 'bulan');

        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data[$i] ?? 0;
        }
        return $result;
    }
}
