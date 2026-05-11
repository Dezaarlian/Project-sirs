<?php

use App\Http\Controllers\AntreanController;
use Illuminate\Support\Facades\Route;

// Rute Halaman Awal
Route::get('/', function () { 
    return view('welcome'); 
});

// Rute TV Ruang Tunggu (Publik, tidak perlu login)
Route::get('/display', [AntreanController::class, 'layarTungguPublik'])->name('display.tv');

// --- TRAFFIC ROUTER SETELAH LOGIN ---
Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'resepsionis'  => redirect()->route('resepsionis.dashboard'),
        'petugas_poli' => redirect()->route('petugas.dashboard'),
        default        => redirect()->route('pasien.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

// --- GRUP PASIEN ---
Route::middleware(['auth', 'verified', 'role:pasien'])->group(function () {
    Route::get('/pasien/dashboard', [AntreanController::class, 'dashboardPasien'])->name('pasien.dashboard');
    Route::post('/pasien/daftar', [AntreanController::class, 'daftarOnline'])->name('pasien.daftar');
});

// --- GRUP RESEPSIONIS ---
Route::middleware(['auth', 'role:resepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [AntreanController::class, 'dashboardResepsionis'])->name('resepsionis.dashboard');
    Route::post('/resepsionis/daftar-offline', [AntreanController::class, 'daftarOffline'])->name('resepsionis.daftar_offline');
});

// --- GRUP PETUGAS POLI ---
Route::middleware(['auth', 'role:petugas_poli'])->group(function () {
    Route::get('/petugas/dashboard', [AntreanController::class, 'dashboardPetugas'])->name('petugas.dashboard');
    Route::post('/petugas/panggil/{id}', [AntreanController::class, 'panggilPasien'])->name('petugas.panggil');
    Route::post('/petugas/selesai/{id}', [AntreanController::class, 'selesaikanPasien'])->name('petugas.selesai');
});

// Memuat rute bawaan Laravel Breeze (Login, Register, dll)
require __DIR__.'/auth.php';