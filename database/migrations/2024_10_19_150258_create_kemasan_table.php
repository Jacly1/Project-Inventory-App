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
        Schema::create('kemasan', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('barang_id');
            $table->string('supplier')->nullable(); // Supplier
            $table->enum('jenis_bahan', ['Kaca', 'Plastik', 'Aluminium']); // Jenis bahan kemasan
            $table->enum('jenis_kemasan', ['Spray', 'Pipet', 'Tube', 'Jar', 'Biasa', 'Pump']); // Jenis kemasan
            $table->string('warna_badan')->nullable(); // Warna badan kemasan
            $table->string('warna_tutup')->nullable(); // Warna tutup kemasan
            $table->integer('volume'); // Volume kemasan dalam ml/mg
            $table->integer('harga'); // Harga kemasan
            $table->string('pemeriksa')->nullable(); // Nama pemeriksa
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
        Schema::dropIfExists('stockkemasan');
    }
};