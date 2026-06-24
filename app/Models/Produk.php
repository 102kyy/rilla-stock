<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'stok_akhir',
        'harga',
        'foto_produk',
    ];
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function stokKeluar()
    {
        return $this->hasMany(StokKeluar::class, 'produk_id');
    }
}