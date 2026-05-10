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
        Schema::create('antreans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID Pasien
    $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('cascade');
    $table->date('tanggal_berobat');
    $table->string('nomor_urut'); // Contoh: A-12
    $table->enum('tipe_daftar', ['online', 'offline']);
    $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'dilewati'])->default('menunggu');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antreans');
    }
};
