<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('can_produk')->default(false);
            $table->boolean('can_bahan_baku')->default(false);
            $table->boolean('can_kategori')->default(false);
            $table->boolean('can_supplier')->default(false);
            $table->boolean('can_stok_masuk')->default(false);
            $table->boolean('can_stok_keluar')->default(false);
            $table->boolean('can_laporan')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};