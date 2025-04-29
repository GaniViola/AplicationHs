<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    // Ini hapus atau ganti:
    // protected $primaryKey = 'id_order_detail'; 
    protected $primaryKey = 'id_order_detail'; // Primary key yang benar dari tabel

    protected $fillable = [
        'id_orders', 
        'service_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public $timestamps = true; // Karena ada created_at dan updated_at di tabel

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_orders');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    
}
