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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreignId('pengguna_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->enum('jenis_pengajuan', ['perbaikan', 'pergantian']);
            $table->enum('status_pengajuan', ['diproses', 'disetujui', 'ditolak'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
