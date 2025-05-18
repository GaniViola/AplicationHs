<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPhoto extends Model
{
   protected $fillable = ['order_id', 'worker_id', 'photo_before', 'photo_after', 'catatan'];
 //
}
