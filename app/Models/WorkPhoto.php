<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\orders;


class WorkPhoto extends Model
{
   protected $fillable = ['order_id', 'worker_id', 'photo_before', 'photo_after', 'catatan'];
 //
 public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
