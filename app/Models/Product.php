<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // TAMBAHKAN 'description' di sini
    protected $fillable = [
        'category_id', 
        'name', 
        'price', 
        'stock', 
        'description',   // ← Pastikan ini ada
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}