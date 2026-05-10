<x-app-layout>
    <x-slot name="title">Dashboard Resepsionis</x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Dashboard Resepsionis</h1>
                <p class="text-sm text-slate-500 mt-0.5">Manajemen pendaftaran & antrean — <span class="font-medium text-slate-700">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span></p>
            </div>
            <a href="{{ route('display.tv') }}" target="_blank"
               class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Buka TV Display
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-7">

            {{-- ── Alert Messages ──────────────────────────────────────────── --}}
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

            {{-- ── Stats Cards ─────────────────────────────────────────────── --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $totalMenunggu }}</div>
                        <div class="text-sm text-slate-500">Sedang Menunggu</div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $totalDipanggil }}</div>
                        <div class="text-sm text-slate-500">Sedang Dipanggil</div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $totalSelesai }}</div>
                        <div class="text-sm text-slate-500">Selesai Diperiksa</div>
                    </div>
                </div>
            </div>

            {{-- ── Two-Column Layout ───────────────────────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">

                {{-- Walk-in Registration Form --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-4">
                        <div class="px-5 py-4 border-b border-slate-100 bg-purple-50">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                </div>
                                <div>
                                    <h2 class="font-semibold text-slate-800 text-sm">Pendaftaran Walk-in</h2>
                                    <p class="text-xs text-purple-600">Offline / Datang Langsung</p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('resepsionis.daftar_offline') }}" class="p-5 space-y-4">
                            @csrf

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Nama Pasien <span class="text-red-500 normal-case font-normal">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Nama lengkap pasien"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">No HP / WhatsApp <span class="text-red-500 normal-case font-normal">*</span></label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                <p class="mt-1 text-xs text-slate-400">Digunakan sebagai ID pasien walk-in</p>
                                @error('no_hp')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Pilih Jadwal Dokter <span class="text-red-500 normal-case font-normal">*</span></label>
                                <select name="jadwal_id" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                    <option value="">-- Pilih Jadwal --</option>
                                    @foreach($jadwals->groupBy('poliklinik.nama_poli') as $namaPoli => $jadwalGroup)
                                        <optgroup label="{{ $namaPoli }}">
                                            @foreach($jadwalGroup as $jadwal)
                                                <option value="{{ $jadwal->id }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                                                    {{ $jadwal->nama_dokter }} ({{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }})
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('jadwal_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2.5 px-5 rounded-xl transition-all text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Daftarkan & Cetak Tiket
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Master Queue Table --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-slate-800">Master Antrean Hari Ini</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Total {{ $antreans->count() }} pendaftar</p>
                        </div>
                        <button onclick="window.location.reload()"
                            class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-blue-600 border border-slate-200 hover:border-blue-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Refresh
                        </button>
                    </div>

                    @if($antreans->isEmpty())
                        <div class="py-16 text-center">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <p class="text-sm text-slate-500">Belum ada pendaftaran hari ini</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-slate-50 text-left border-b border-slate-100">
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nomor</th>
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pasien</th>
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Poliklinik</th>
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipe</th>
                                        <th class="px-5 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($antreans as $i => $antrean)
                                        <tr class="hover:bg-slate-50 transition-colors {{ $antrean->status === 'dipanggil' ? 'bg-amber-50' : '' }}">
                                            <td class="px-5 py-3 text-slate-400 text-xs">{{ $i + 1 }}</td>
                                            <td class="px-5 py-3 font-bold text-slate-800">{{ $antrean->nomor_urut }}</td>
                                            <td class="px-5 py-3">
                                                <div class="font-medium text-slate-700">{{ $antrean->user->name }}</div>
                                                <div class="text-xs text-slate-400">{{ $antrean->user->no_hp ?? '-' }}</div>
                                            </td>
                                            <td class="px-5 py-3">
                                                <div class="text-slate-700">{{ $antrean->jadwal->poliklinik->nama_poli }}</div>
                                                <div class="text-xs text-slate-400">{{ $antrean->jadwal->nama_dokter }}</div>
                                            </td>
                                            <td class="px-5 py-3">
                                                @if($antrean->tipe_daftar === 'online')
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/></svg>
                                                        Online
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                                        Walk-in
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-3">
                                                @php
                                                    $statusClass = match($antrean->status) {
                                                        'menunggu'  => 'bg-slate-100 text-slate-600',
                                                        'dipanggil' => 'bg-amber-100 text-amber-700',
                                                        'selesai'   => 'bg-emerald-100 text-emerald-700',
                                                        default     => 'bg-gray-100 text-gray-600',
                                                    };
                                                    $statusLabel = match($antrean->status) {
                                                        'menunggu'  => 'Menunggu',
                                                        'dipanggil' => '🔊 Dipanggil',
                                                        'selesai'   => '✓ Selesai',
                                                        default     => ucfirst($antrean->status),
                                                    };
                                                @endphp
                                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClass }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
