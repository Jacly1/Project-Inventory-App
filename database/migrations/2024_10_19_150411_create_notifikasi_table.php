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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->unsignedBigInteger('users_id');
            $table->date('tgl_notif'); // Tanggal notifikasi
            $table->enum('jenis_notif', ['Peringatan Stock', 'Peringatan Reorder']);
            $table->text('desc_notif'); // Deskripsi notifikasi
            $table->string('link_notif')->nullable(); // Tautan terkait notifikasi, opsional
            $table->boolean('status_notif')->default(false); // Status notifikasi, default false (belum dibaca)
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};