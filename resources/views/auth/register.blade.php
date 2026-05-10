<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Pasien - {{ config('app.name', 'Sistem Antrean RS') }}</title>
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
                    Mulai Perjalanan<br>Kesehatan Anda
                </h1>
                <p class="text-indigo-100 text-lg max-w-md leading-relaxed">
                    Daftar satu kali untuk menikmati kemudahan mengambil nomor antrean secara online kapan saja dan di mana saja.
                </p>
            </div>
            
            <div class="relative z-10 text-indigo-200 text-sm mt-12 font-medium">
                &copy; {{ date('Y') }} Rumah Sakit Pro. All rights reserved.
            </div>
        </div>

        <!-- Left Side: Register Form -->
        <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-16 bg-white relative overflow-y-auto">
            <div class="w-full max-w-lg my-auto">
                
                <!-- Mobile Logo -->
                <div class="flex lg:hidden items-center gap-3 mb-8 justify-center">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800 text-2xl tracking-tight">RS<span class="text-indigo-600">Pro</span></span>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Daftar Pasien Baru 🏥</h2>
                    <p class="text-slate-500 text-base">Lengkapi data diri Anda di bawah ini dengan benar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Induk Kependudukan (NIK)</label>
                        <input id="nik" type="text" name="nik" value="{{ old('nik') }}" required autofocus
                            class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                            placeholder="Masukkan 16 digit NIK" maxlength="16" minlength="16">
                        <x-input-error :messages="$errors->get('nik')" class="mt-1.5" />
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap Sesuai KTP</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required 
                            class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                            placeholder="Nama Lengkap">
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                                class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                                placeholder="email@contoh.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor WhatsApp/HP</label>
                            <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" required 
                                class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                                placeholder="0812xxxx">
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-1.5" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5, pt-2">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                                placeholder="Minimal 8 karakter">
                            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Sandi</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-shadow py-3" 
                                placeholder="Ulangi sandi">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:shadow-md transform hover:-translate-y-0.5">
                            Daftarkan Akun Saya
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 hover:underline transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
