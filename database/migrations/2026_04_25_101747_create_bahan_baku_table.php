<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('supplier')->onDelete('cascade');
            $table->string('nama_bahan');
            $table->integer('stok_bahan')->default(0);
            $table->string('satuan');
            $table->decimal('harga_beli', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};