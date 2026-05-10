<x-app-layout>
    <x-slot name="title">Dashboard Pasien</x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Portal Pasien</h1>
                <p class="text-sm text-slate-500 mt-0.5">Selamat datang, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span></p>
            </div>
            <div class="text-right">
                <div class="text-xs text-slate-500">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
                <div class="text-xs text-slate-400 mt-0.5">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ── Alert Messages ─────────────────────────────────────── --}}
            @if(session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4">
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-medium">{!! session('success') !!}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-medium">{!! session('error') !!}</div>
                </div>
            @endif

            {{-- ── Live Digital Ticket ─────────────────────────────────── --}}
            @if($antreanAktif)
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl p-6 text-white shadow-lg shadow-blue-500/30">
                    <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
                        <svg viewBox="0 0 200 200" fill="currentColor"><circle cx="150" cy="50" r="120"/></svg>
                    </div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                            <span class="text-sm font-medium text-blue-100">TIKET ANTREAN AKTIF</span>
                        </div>
                        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                            <div>
                                <div class="text-blue-200 text-xs uppercase tracking-wider mb-1">Nomor Antrean</div>
                                <div class="text-5xl font-extrabold tracking-tight">{{ $antreanAktif->nomor_urut }}</div>
                            </div>
                            <div>
                                <div class="text-blue-200 text-xs uppercase tracking-wider mb-1">Poliklinik</div>
                                <div class="text-xl font-bold">{{ $antreanAktif->jadwal->poliklinik->nama_poli }}</div>
                                <div class="text-blue-200 text-sm mt-0.5">{{ $antreanAktif->jadwal->nama_dokter }}</div>
                            </div>
                            <div>
                                <div class="text-blue-200 text-xs uppercase tracking-wider mb-1">Tanggal Berobat</div>
                                <div class="text-lg font-semibold">{{ \Carbon\Carbon::parse($antreanAktif->tanggal_berobat)->locale('id')->isoFormat('D MMM Y') }}</div>
                                <div class="text-blue-200 text-sm mt-0.5">{{ \Carbon\Carbon::parse($antreanAktif->jadwal->jam_mulai)->format('H:i') }}–{{ \Carbon\Carbon::parse($antreanAktif->jadwal->jam_selesai)->format('H:i') }}</div>
                            </div>
                            <div>
                                <div class="text-blue-200 text-xs uppercase tracking-wider mb-1">Status</div>
                                @if($antreanAktif->status === 'dipanggil')
                                    <div class="inline-flex items-center gap-1.5 bg-amber-400 text-amber-900 font-bold text-sm px-3 py-1.5 rounded-full animate-pulse">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                        GILIRAN ANDA!
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-1.5 bg-white/20 text-white font-semibold text-sm px-3 py-1.5 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Menunggu
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty state when no active ticket --}}
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-10 text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-700 mb-1">Belum Ada Antrean Aktif</h3>
                    <p class="text-sm text-slate-500">Daftarkan diri Anda ke poliklinik melalui form di bawah.</p>
                </div>
            @endif

            {{-- ── Two Column: Form + Poli Info ─────────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Registration Form --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-800">Daftar Antrean Online</h2>
                            <p class="text-xs text-slate-500">Pilih jadwal dan tanggal kunjungan</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('pasien.daftar') }}" class="p-6 space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Pilih Jadwal Dokter <span class="text-red-500">*</span></label>
                            <select name="jadwal_id" id="jadwal_id" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="">-- Pilih Poliklinik & Dokter --</option>
                                @foreach($jadwals->groupBy('poliklinik.nama_poli') as $namaPoliGroup => $jadwalGroup)
                                    <optgroup label="🏥 {{ $namaPoliGroup }}">
                                        @foreach($jadwalGroup as $jadwal)
                                            @php
                                                $quota = $quotaInfo[$jadwal->id];
                                                $isFull = $quota['sisa'] === 0;
                                            @endphp
                                            <option value="{{ $jadwal->id }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }} {{ $isFull ? 'disabled' : '' }}>
                                                {{ $jadwal->nama_dokter }} ({{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}–{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }})
                                                — Sisa: {{ $quota['sisa'] }}/{{ $quota['kuota'] }}{{ $isFull ? ' [PENUH]' : '' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('jadwal_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Kunjungan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal" id="tanggal"
                                min="{{ today()->toDateString() }}"
                                value="{{ old('tanggal', today()->toDateString()) }}"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('tanggal')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-150 shadow-sm shadow-blue-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Daftarkan Antrean
                        </button>
                    </form>
                </div>

                {{-- Quota Info Sidebar --}}
                <div class="space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <h3 class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Kuota Hari Ini
                        </h3>
                        <div class="space-y-3">
                            @foreach($jadwals->groupBy('poliklinik.nama_poli') as $namaPoli => $jadwalGroup)
                                @foreach($jadwalGroup as $jadwal)
                                    @php
                                        $quota = $quotaInfo[$jadwal->id];
                                        $pct = $quota['kuota'] > 0 ? ($quota['terdaftar'] / $quota['kuota']) * 100 : 0;
                                        $barColor = $pct >= 90 ? 'bg-red-500' : ($pct >= 60 ? 'bg-amber-500' : 'bg-emerald-500');
                                    @endphp
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs font-medium text-slate-600">{{ $namaPoli }}</span>
                                            <span class="text-xs text-slate-500">{{ $quota['terdaftar'] }}/{{ $quota['kuota'] }}</span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-2">
                                            <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500" style="width: {{ min(100, $pct) }}%"></div>
                                        </div>
                                        <div class="text-xs text-slate-400 mt-0.5">dr. {{ Str::before($jadwal->nama_dokter, ',') }}</div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="bg-blue-50 rounded-2xl border border-blue-100 p-4">
                        <h4 class="text-xs font-semibold text-blue-800 mb-2 uppercase tracking-wider">Informasi</h4>
                        <ul class="space-y-1.5 text-xs text-blue-700">
                            <li class="flex gap-2"><span>•</span><span>Hadir 15 menit sebelum jadwal</span></li>
                            <li class="flex gap-2"><span>•</span><span>Bawa KTP dan BPJS/Asuransi</span></li>
                            <li class="flex gap-2"><span>•</span><span>Notifikasi akan dikirim via WhatsApp</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ── Riwayat Kunjungan ─────────────────────────────────────── --}}
            @if($riwayat->isNotEmpty())
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="font-semibold text-slate-800">Riwayat Kunjungan</h2>
                        <p class="text-xs text-slate-500 mt-0.5">5 kunjungan terakhir yang telah selesai</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50 text-left">
                                    <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Antrean</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Poliklinik</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Dokter</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($riwayat as $r)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-3.5 font-bold text-slate-800">{{ $r->nomor_urut }}</td>
                                        <td class="px-6 py-3.5 text-slate-600">{{ $r->jadwal->poliklinik->nama_poli }}</td>
                                        <td class="px-6 py-3.5 text-slate-600">{{ $r->jadwal->nama_dokter }}</td>
                                        <td class="px-6 py-3.5 text-slate-500">{{ \Carbon\Carbon::parse($r->tanggal_berobat)->locale('id')->isoFormat('D MMM Y') }}</td>
                                        <td class="px-6 py-3.5">
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $r->tipe_daftar === 'online' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                                {{ ucfirst($r->tipe_daftar) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
