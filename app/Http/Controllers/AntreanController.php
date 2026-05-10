<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Antrean, Jadwal, Poliklinik, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AntreanController extends Controller
{
    // ==========================================
    // 1. DASHBOARD VIEWS
    // ==========================================

    public function dashboardPasien()
    {
        $antreanAktif = Antrean::with('jadwal.poliklinik')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['menunggu', 'dipanggil'])
            ->latest()
            ->first();

        $riwayat = Antrean::with('jadwal.poliklinik')
            ->where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->latest()
            ->take(5)
            ->get();

        $jadwals = Jadwal::with('poliklinik')->orderBy('poliklinik_id')->get();

        $quotaInfo = [];
        foreach ($jadwals as $jadwal) {
            $terdaftar = Antrean::where('jadwal_id', $jadwal->id)
                ->whereDate('tanggal_berobat', today())
                ->count();
            $quotaInfo[$jadwal->id] = [
                'terdaftar' => $terdaftar,
                'kuota'     => $jadwal->poliklinik->kuota_harian,
                'sisa'      => max(0, $jadwal->poliklinik->kuota_harian - $terdaftar),
            ];
        }

        return view('pasien.dashboard', compact('antreanAktif', 'riwayat', 'jadwals', 'quotaInfo'));
    }

    public function dashboardResepsionis()
    {
        $antreans = Antrean::with('user', 'jadwal.poliklinik')
            ->whereDate('tanggal_berobat', today())
            ->orderBy('id', 'asc')
            ->get();

        $jadwals = Jadwal::with('poliklinik')->orderBy('poliklinik_id')->get();

        $totalMenunggu  = $antreans->where('status', 'menunggu')->count();
        $totalDipanggil = $antreans->where('status', 'dipanggil')->count();
        $totalSelesai   = $antreans->where('status', 'selesai')->count();

        return view('resepsionis.dashboard', compact(
            'antreans', 'jadwals', 'totalMenunggu', 'totalDipanggil', 'totalSelesai'
        ));
    }

    public function dashboardPetugas()
    {
        $antreans = Antrean::with('user', 'jadwal.poliklinik')
            ->whereDate('tanggal_berobat', today())
            ->orderBy('id', 'asc')
            ->get();

        $sedangDipanggil = $antreans->where('status', 'dipanggil')->first();
        $menunggu        = $antreans->where('status', 'menunggu')->values();
        $selesai         = $antreans->where('status', 'selesai')->values();

        return view('petugas.dashboard', compact('antreans', 'sedangDipanggil', 'menunggu', 'selesai'));
    }

    public function layarTungguPublik()
    {
        $panggilanAktif = Antrean::with('user', 'jadwal.poliklinik')
            ->whereDate('tanggal_berobat', today())
            ->where('status', 'dipanggil')
            ->orderBy('updated_at', 'desc')
            ->first();

        $antreanSelanjutnya = Antrean::with('jadwal.poliklinik')
            ->whereDate('tanggal_berobat', today())
            ->where('status', 'menunggu')
            ->orderBy('id', 'asc')
            ->take(8)
            ->get();

        $totalHariIni = Antrean::whereDate('tanggal_berobat', today())->count();
        $totalSelesai = Antrean::whereDate('tanggal_berobat', today())->where('status', 'selesai')->count();

        return view('display', compact('panggilanAktif', 'antreanSelanjutnya', 'totalHariIni', 'totalSelesai'));
    }

    // ==========================================
    // 2. CORE LOGIC: PENDAFTARAN (ONLINE & OFFLINE)
    // ==========================================

    private function prosesPendaftaran(int $userId, int $jadwalId, string $tanggal, string $tipeDaftar): Antrean|false
    {
        return DB::transaction(function () use ($userId, $jadwalId, $tanggal, $tipeDaftar) {
            $jadwal = Jadwal::with('poliklinik')->lockForUpdate()->findOrFail($jadwalId);

            $jumlahTerdaftar = Antrean::where('jadwal_id', $jadwalId)
                ->whereDate('tanggal_berobat', $tanggal)
                ->count();

            if ($jumlahTerdaftar >= $jadwal->poliklinik->kuota_harian) {
                return false;
            }

            $nomorUrut = strtoupper($jadwal->poliklinik->kode_poli) . '-' . str_pad($jumlahTerdaftar + 1, 3, '0', STR_PAD_LEFT);

            return Antrean::create([
                'user_id'         => $userId,
                'jadwal_id'       => $jadwalId,
                'tanggal_berobat' => $tanggal,
                'nomor_urut'      => $nomorUrut,
                'tipe_daftar'     => $tipeDaftar,
                'status'          => 'menunggu',
            ]);
        });
    }

    public function daftarOnline(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal'   => 'required|date|after_or_equal:today',
        ]);

        $sudahDaftar = Antrean::where('user_id', auth()->id())
            ->where('jadwal_id', $request->jadwal_id)
            ->whereDate('tanggal_berobat', $request->tanggal)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah terdaftar di jadwal ini pada tanggal tersebut.');
        }

        $antrean = $this->prosesPendaftaran(auth()->id(), $request->jadwal_id, $request->tanggal, 'online');

        if (!$antrean) {
            return back()->with('error', 'Maaf, kuota poli untuk hari tersebut sudah penuh. Silakan pilih jadwal atau tanggal lain.');
        }

        return back()->with('success', "Pendaftaran berhasil! Nomor antrean Anda: <strong>{$antrean->nomor_urut}</strong>. Harap hadir tepat waktu.");
    }

    public function daftarOffline(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'no_hp'     => 'required|string|max:20',
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        $pasien = User::firstOrCreate(
            ['no_hp' => $request->no_hp],
            [
                'name'     => $request->nama,
                'email'    => preg_replace('/[^a-zA-Z0-9]/', '', $request->no_hp) . '@pasien.rs.local',
                'role'     => 'pasien',
                'password' => Hash::make($request->no_hp),
            ]
        );

        $sudahDaftar = Antrean::where('user_id', $pasien->id)
            ->where('jadwal_id', $request->jadwal_id)
            ->whereDate('tanggal_berobat', today())
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', "Pasien {$pasien->name} sudah terdaftar di jadwal ini hari ini.");
        }

        $antrean = $this->prosesPendaftaran($pasien->id, $request->jadwal_id, today()->toDateString(), 'offline');

        if (!$antrean) {
            return back()->with('error', 'Kuota poliklinik hari ini sudah penuh.');
        }

        return back()->with('success', "Pendaftaran walk-in berhasil! Nomor: <strong>{$antrean->nomor_urut}</strong> atas nama {$pasien->name}.");
    }

    // ==========================================
    // 3. CORE LOGIC: EKSEKUSI PEMANGGILAN
    // ==========================================

    public function panggilPasien(int $id)
    {
        // Reset semua yang masih dipanggil ke menunggu terlebih dahulu
        Antrean::whereDate('tanggal_berobat', today())
            ->where('status', 'dipanggil')
            ->update(['status' => 'menunggu']);

        $antrean = Antrean::with('user', 'jadwal.poliklinik')->findOrFail($id);
        $antrean->update(['status' => 'dipanggil']);

        // MENGIRIM NOTIFIKASI WHATSAPP MELALUI FONNTE API
        if ($antrean->user->no_hp && env('FONNTE_TOKEN')) {
            $pesan = "Halo *{$antrean->user->name}*! 👋\n\n";
            $pesan .= "Giliran Anda telah tiba untuk poli *{$antrean->jadwal->poliklinik->nama_poli}*.\n";
            $pesan .= "Nomor Antrean Anda: *{$antrean->nomor_urut}*\n\n";
            $pesan .= "Mohon segera menuju ruang pemeriksaan dokter *{$antrean->jadwal->nama_dokter}*.\n";
            $pesan .= "Terima kasih telah mempercayakan layanan kesehatan Anda pada RSPro.";

            try {
                \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => env('FONNTE_TOKEN'),
                ])->post('https://api.fonnte.com/send', [
                    'target' => $antrean->user->no_hp,
                    'message' => $pesan,
                    'countryCode' => '62', // Default kode negara Indonesia
                ]);
            } catch (\Exception $e) {
                // Logika fallback jika API WA gagal, misalnya koneksi terputus
                \Illuminate\Support\Facades\Log::error('WA Notification Error: ' . $e->getMessage());
            }
        }

        return back()->with('success', "Berhasil memanggil nomor <strong>{$antrean->nomor_urut}</strong>. Notifikasi WhatsApp otomatis terkirim.");
    }

    public function selesaikanPasien(int $id)
    {
        $antrean = Antrean::findOrFail($id);
        $antrean->update(['status' => 'selesai']);

        return back()->with('success', "Pemeriksaan pasien nomor <strong>{$antrean->nomor_urut}</strong> selesai dicatat.");
    }
}