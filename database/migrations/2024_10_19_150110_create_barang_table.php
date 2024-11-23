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
        Schema::create('barang', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('nama_barang'); // Nama barang
            $table->enum('kategori_barang', ['Bahan Baku', 'Kemasan', 'Produk Jadi']); // Kategori barang
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan
            $table->softDeletes(); // Kolom untuk soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
