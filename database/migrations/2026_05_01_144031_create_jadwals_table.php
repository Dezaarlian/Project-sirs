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
       // ..._create_jadwals_table.php
Schema::create('jadwals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('poliklinik_id')->constrained('polikliniks')->onDelete('cascade');
    $table->string('nama_dokter');
    $table->time('jam_mulai');
    $table->time('jam_selesai');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
