<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
    ];

    public function user() {
        return $this->belongsToMany(User::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
