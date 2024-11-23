<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('barang_id');
            $table->enum('satuan', ['Buah', 'ml', 'gr']); // Kategori stok
            $table->integer('jumlah'); // Jumlah barang yang masuk
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan

            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
