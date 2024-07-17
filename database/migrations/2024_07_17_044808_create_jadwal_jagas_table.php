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
        Schema::create('jadwal_jagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->json('hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_jagas');
    }
};
