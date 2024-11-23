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
        Schema::create('produk_jadi', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('barang_id');
            $table->string('batch')->nullable(); // Batch produksi produk jadi
            $table->date('tgl_exp')->nullable(); // Tanggal kedaluwarsa produk
            $table->string('warna')->nullable(); // Warna produk jadi
            $table->string('bentuk')->nullable(); // Bentuk produk jadi
            $table->string('bau')->nullable(); // Bau produk jadi
            $table->float('ph', 4, 2)->nullable(); // pH produk jadi, skala dua desimal
            $table->integer('jlh_sampel')->nullable(); // Jumlah sampel produk jadi
            $table->string('diproduksi')->nullable(); // Nama pihak yang memproduksi
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan

            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockproduk');
    }
};