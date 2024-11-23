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
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('barang_id');
            $table->string('supplier')->nullable(); // Supplier
            $table->string('batch')->nullable(); // Batch produksi
            $table->date('tgl_exp')->nullable(); // Tanggal kedaluwarsa
            $table->string('warna')->nullable(); // Warna bahan baku
            $table->enum('bentuk', ['Cair', 'Cairan Kental', 'Butter', 'Serbuk', 'Pellet'])->nullable(); // Bentuk bahan baku
            $table->integer('harga'); // Harga bahan baku
            $table->enum('penyimpanan', ['Suhu Ruang', 'Kulkas'])->nullable(); // Jenis penyimpanan
            $table->string('pemeriksa')->nullable(); // Nama pemeriksa bahan baku
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps(); // created_at dan updated_at

            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku'); // Konsisten dengan nama tabel di up()
    }
};