<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id', 
        'can_produk', 
        'can_bahan_baku', 
        'can_kategori', 
        'can_supplier', 
        'can_stok_masuk', 
        'can_stok_keluar', 
        'can_laporan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}