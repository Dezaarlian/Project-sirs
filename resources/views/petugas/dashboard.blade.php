<x-app-layout>
    <x-slot name="title">Panel Petugas Poli</x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Panel Eksekusi Poli</h1>
                <p class="text-sm text-slate-500 mt-0.5">Manajemen pemanggilan pasien — <span class="font-medium text-slate-700">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span></p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right text-xs text-slate-500">
                    <div>Menunggu: <span class="font-bold text-slate-700">{{ $menunggu->count() }}</span></div>
                    <div>Selesai: <span class="font-bold text-emerald-600">{{ $selesai->count() }}</span></div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ── Alert Messages ──────────────────────────────────────────── --}}
            @if(session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 mb-6">
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-medium">{!! session('success') !!}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 mb-6">
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="text-sm font-medium">{!! session('error') !!}</div>
                </div>
            @endif

            {{-- ── Split Screen ─────────────────────────────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 min-h-[calc(100vh-220px)]">

                {{-- LEFT: Patient List ─────────────────────────────────────── --}}
                <div class="lg:col-span-2 space-y-4">

                    {{-- Currently Being Called --}}
                    @if($sedangDipanggil)
                        <div class="bg-amber-500 rounded-2xl p-5 text-white shadow-lg shadow-amber-500/30">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-white rounded-full animate-ping"></div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-amber-100">Sedang Dipanggil</span>
                                </div>
                            </div>
                            <div class="text-4xl font-extrabold">{{ $sedangDipanggil->nomor_urut }}</div>
                            <div class="mt-2 text-amber-100 text-sm">{{ $sedangDipanggil->user->name }}</div>
                            <div class="mt-0.5 text-amber-200 text-xs">{{ $sedangDipanggil->jadwal->poliklinik->nama_poli }} — {{ $sedangDipanggil->jadwal->nama_dokter }}</div>

                            <form method="POST" action="{{ route('petugas.selesai', $sedangDipanggil->id) }}" class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-white text-amber-700 hover:bg-amber-50 font-bold py-2.5 px-5 rounded-xl transition-all text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Selesai Diperiksa
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Waiting List ─────── --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-slate-700">Daftar Menunggu</h3>
                            <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded-full">{{ $menunggu->count() }}</span>
                        </div>
                        @if($menunggu->isEmpty())
                            <div class="py-8 text-center">
                                <svg class="w-10 h-10 text-slate-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-xs text-slate-400">Tidak ada pasien menunggu</p>
                            </div>
                        @else
                            <div class="divide-y divide-slate-100 max-h-96 overflow-y-auto">
                                @foreach($menunggu as $i => $antrean)
                                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs shrink-0">
                                            {{ $i + 1 }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-bold text-slate-800 text-sm">{{ $antrean->nomor_urut }}</div>
                                            <div class="text-xs text-slate-500 truncate">{{ $antrean->user->name }}</div>
                                            <div class="text-xs text-slate-400">{{ $antrean->jadwal->poliklinik->nama_poli }}</div>
                                        </div>
                                        <span class="text-xs px-1.5 py-0.5 rounded {{ $antrean->tipe_daftar === 'online' ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $antrean->tipe_daftar }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Completed ─────────── --}}
                    @if($selesai->isNotEmpty())
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-slate-700">Selesai Diperiksa</h3>
                                <span class="text-xs bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded-full">{{ $selesai->count() }}</span>
                            </div>
                            <div class="divide-y divide-slate-100 max-h-48 overflow-y-auto">
                                @foreach($selesai as $antrean)
                                    <div class="flex items-center gap-3 px-4 py-2.5 opacity-60">
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <div>
                                            <span class="font-semibold text-slate-700 text-sm line-through">{{ $antrean->nomor_urut }}</span>
                                            <span class="text-xs text-slate-400 ml-2">{{ $antrean->user->name }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT: Giant Execution Panel ─────────────────────────────── --}}
                <div class="lg:col-span-3 flex flex-col gap-4">

                    {{-- Main Call Button --}}
                    @if($menunggu->isNotEmpty())
                        @php $nextPatient = $menunggu->first(); @endphp
                        <div class="flex-1 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-xl shadow-blue-500/30 flex flex-col items-center justify-center text-center">
                            <div class="mb-6">
                                <div class="text-blue-200 text-sm uppercase tracking-widest font-medium mb-2">Pasien Berikutnya</div>
                                <div class="text-8xl font-black tracking-tighter mb-3">{{ $nextPatient->nomor_urut }}</div>
                                <div class="text-2xl font-semibold text-white">{{ $nextPatient->user->name }}</div>
                                <div class="text-blue-200 mt-2">{{ $nextPatient->jadwal->poliklinik->nama_poli }}</div>
                                <div class="text-blue-300 text-sm">{{ $nextPatient->jadwal->nama_dokter }}</div>
                            </div>

                            <form method="POST" action="{{ route('petugas.panggil', $nextPatient->id) }}" class="w-full max-w-sm">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-3 bg-white text-blue-700 hover:bg-blue-50 active:bg-blue-100 font-black text-xl py-5 px-8 rounded-2xl transition-all duration-150 shadow-lg shadow-blue-900/30 hover:scale-105 active:scale-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                    PANGGIL PASIEN SELANJUTNYA
                                </button>
                            </form>

                            <p class="text-blue-300 text-xs mt-4">
                                Masih {{ $menunggu->count() }} pasien dalam antrean
                            </p>
                        </div>

                        {{-- Quick Call Others --}}
                        @if($menunggu->count() > 1)
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                                <div class="px-5 py-3.5 border-b border-slate-100">
                                    <h3 class="text-sm font-semibold text-slate-700">Panggil Nomor Tertentu</h3>
                                    <p class="text-xs text-slate-400 mt-0.5">Klik untuk memanggil nomor antrean tertentu</p>
                                </div>
                                <div class="p-4 flex flex-wrap gap-2.5">
                                    @foreach($menunggu->take(12) as $antrean)
                                        <form method="POST" action="{{ route('petugas.panggil', $antrean->id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border-2 border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-600 hover:text-white hover:border-blue-600 font-bold text-sm transition-all duration-150">
                                                {{ $antrean->nomor_urut }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- Empty state --}}
                        <div class="flex-1 bg-white rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center p-12">
                            <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-5">
                                <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Semua Pasien Telah Dilayani!</h3>
                            <p class="text-slate-400 text-sm">Tidak ada pasien yang menunggu saat ini.</p>
                            <p class="text-slate-300 text-xs mt-1">Total selesai hari ini: {{ $selesai->count() }} pasien</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
