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
        Schema::create('keluar', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('barang_id');
            $table->date('tgl_keluar'); // Tanggal barang keluar
            $table->integer('jumlah'); // Jumlah barang yang keluar
            $table->string('kategori'); // Kategori pengeluaran
            $table->string('nama_barang_jadi')->nullable(); // Nama barang jadi (bisa null)
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan

            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluar');
    }
};
