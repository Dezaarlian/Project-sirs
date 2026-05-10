<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Panel Kendali Poliklinik</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Daftar Antrean -->
            <div class="bg-white shadow rounded-lg p-6 border-t-4 border-blue-500">
                <h3 class="font-bold text-lg mb-4">Antrean Hari Ini</h3>
                <ul>
                    @foreach($antreans as $a)
                    <li class="p-3 mb-2 rounded border {{ $a->status == 'dipanggil' ? 'bg-blue-50 border-blue-400' : 'bg-gray-50' }}">
                        <div class="flex justify-between items-center">
                            <span class="font-bold">{{ $a->nomor_urut }}</span>
                            <span class="text-sm">{{ $a->user->name }}</span>
                            <span class="text-xs px-2 py-1 bg-yellow-200 rounded-full">{{ $a->status }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Kolom Kanan: Eksekusi -->
            <div class="md:col-span-2 bg-white shadow rounded-lg p-10 text-center">
                @php $aktif = $antreans->where('status', 'dipanggil')->first(); @endphp
                
                <h3 class="text-gray-500 text-xl mb-2">Sedang Dilayani</h3>
                <h1 class="text-7xl font-black text-gray-900 my-4">{{ $aktif ? $aktif->nomor_urut : '--' }}</h1>
                <p class="text-2xl text-gray-600 mb-10">{{ $aktif ? $aktif->user->name : 'Belum ada panggilan' }}</p>

                <div class="flex justify-center space-x-4">
                    @if($aktif)
                        <form action="{{ route('petugas.selesai', $aktif->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded shadow-lg text-lg">
                                SELESAI DIPERIKSA
                            </button>
                        </form>
                    @endif

                    @php $selanjutnya = $antreans->where('status', 'menunggu')->first(); @endphp
                    @if($selanjutnya)
                        <form action="{{ route('petugas.panggil', $selanjutnya->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded shadow-lg text-lg">
                                PANGGIL SELANJUTNYA ({{ $selanjutnya->nomor_urut }})
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>