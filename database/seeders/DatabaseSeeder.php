<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Poliklinik;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Staff Accounts ────────────────────────────────────────────────
        User::create([
            'name'     => 'Resepsionis 1',
            'email'    => 'resep@rs.com',
            'no_hp'    => '08111000001',
            'role'     => 'resepsionis',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name'     => 'Petugas Poli Umum',
            'email'    => 'petugas@rs.com',
            'no_hp'    => '08111000002',
            'role'     => 'petugas_poli',
            'password' => Hash::make('password'),
        ]);

        // ─── Demo Pasien ───────────────────────────────────────────────────
        User::create([
            'name'     => 'Budi Santoso',
            'nik'      => '3201010101010001',
            'email'    => 'budi@mail.com',
            'no_hp'    => '08222000001',
            'role'     => 'pasien',
            'password' => Hash::make('password'),
        ]);

        // ─── Polikliniks ───────────────────────────────────────────────────
        $poli_umum = Poliklinik::create([
            'kode_poli'     => 'PUMUM',
            'nama_poli'     => 'Poli Umum',
            'kuota_harian'  => 30,
        ]);

        $poli_gigi = Poliklinik::create([
            'kode_poli'     => 'PGIGI',
            'nama_poli'     => 'Poli Gigi & Mulut',
            'kuota_harian'  => 20,
        ]);

        $poli_anak = Poliklinik::create([
            'kode_poli'     => 'PANAK',
            'nama_poli'     => 'Poli Anak',
            'kuota_harian'  => 25,
        ]);

        // ─── Jadwals ───────────────────────────────────────────────────────
        Jadwal::create([
            'poliklinik_id' => $poli_umum->id,
            'nama_dokter'   => 'dr. Andi Pratama, Sp.PD',
            'jam_mulai'     => '08:00:00',
            'jam_selesai'   => '12:00:00',
        ]);

        Jadwal::create([
            'poliklinik_id' => $poli_umum->id,
            'nama_dokter'   => 'dr. Sari Dewi',
            'jam_mulai'     => '13:00:00',
            'jam_selesai'   => '16:00:00',
        ]);

        Jadwal::create([
            'poliklinik_id' => $poli_gigi->id,
            'nama_dokter'   => 'drg. Mega Putri',
            'jam_mulai'     => '08:00:00',
            'jam_selesai'   => '12:00:00',
        ]);

        Jadwal::create([
            'poliklinik_id' => $poli_anak->id,
            'nama_dokter'   => 'dr. Reza Maulana, Sp.A',
            'jam_mulai'     => '09:00:00',
            'jam_selesai'   => '14:00:00',
        ]);
    }
}

