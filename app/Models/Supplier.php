<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $guarded = [];


    public function produk()
    {
        return $this->hasMany(Produk::class, 'supplier_id');
    }

    public function bahanBaku()
{
    return $this->hasMany(BahanBaku::class, 'supplier_id');
}
}