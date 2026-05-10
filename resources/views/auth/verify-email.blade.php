<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - {{ config('app.name', 'Sistem Antrean RS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex flex-row-reverse">
        <!-- Right Side: Image/Branding -->
        <div class="hidden lg:flex lg:w-5/12 bg-indigo-600 flex-col justify-between p-12 relative overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-white text-2xl tracking-tight">RS<span class="text-indigo-200">Pro</span></span>
            </div>

            <div class="relative z-10 mt-auto">
                <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                    Satu Langkah<br>Lagi!
                </h1>
                <p class="text-indigo-100 text-lg max-w-md leading-relaxed">
                    Pastikan email Anda valid untuk menerima notifikasi penting terkait antrean, jadwal dokter, dan informasi kesehatan lainnya.
                </p>
            </div>
            
            <div class="relative z-10 text-indigo-200 text-sm mt-12 font-medium">
                &copy; {{ date('Y') }} Rumah Sakit Pro. All rights reserved.
            </div>
        </div>

        <!-- Left Side: Verify Form -->
        <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-16 bg-white relative overflow-y-auto">
            <div class="w-full max-w-md my-auto">
                
                <!-- Mobile Logo -->
                <div class="flex lg:hidden items-center gap-3 mb-8 justify-center">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800 text-2xl tracking-tight">RS<span class="text-indigo-600">Pro</span></span>
                </div>

                <div class="mb-8 text-center">
                    <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Periksa Email Anda 📧</h2>
                    <p class="text-slate-500 text-base leading-relaxed">
                        Terima kasih telah mendaftar! Kami telah mengirimkan tautan verifikasi ke alamat email Anda. Silakan klik tautan tersebut untuk mengaktifkan akun Anda.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm font-medium text-green-800">
                            Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.
                        </p>
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:shadow-md transform hover:-translate-y-0.5">
                            Kirim Ulang Email Verifikasi
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Keluar Akun
                        </button>
                    </form>
                </div>
                
                <p class="mt-8 text-center text-sm text-slate-500">
                    Belum menerima email? Periksa folder spam atau promosi Anda, atau klik tombol kirim ulang di atas.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
