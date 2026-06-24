<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';

    protected $fillable = [
        'supplier_id',
        'nama_bahan',
        'stok_bahan',
        'satuan',
        'harga_beli',
    ];

    public $timestamps = false;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}