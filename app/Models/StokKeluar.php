<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    use HasFactory;

    protected $table = 'stok_keluar';

    protected $fillable = [
        'produk_id',
        'jumlah_keluar',
        'tujuan',
    ];

    public $timestamps = false;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    
}