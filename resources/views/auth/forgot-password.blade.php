<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi - {{ config('app.name', 'Sistem Antrean RS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.8; }
            100% { transform: scale(1.3); opacity: 0; }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid rgba(59, 130, 246, 0.4);
            animation: pulse-ring 2s ease-out infinite;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex">

        {{-- Left Side: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-blue-600 flex-col justify-between p-12 relative overflow-hidden">
            {{-- Decorative blobs --}}
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-x-1/2 translate-y-1/2"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>

            {{-- Logo --}}
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-white text-2xl tracking-tight">RS<span class="text-blue-200">Pro</span></span>
            </div>

            {{-- Center Illustration --}}
            <div class="relative z-10 flex flex-col items-center justify-center flex-1 py-16">
                <div class="relative animate-float">
                    <div class="relative pulse-ring">
                        <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30 shadow-2xl">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <h3 class="text-2xl font-bold text-white mb-3">Reset via Email</h3>
                    <p class="text-blue-100 text-sm max-w-xs leading-relaxed">
                        Kami akan mengirimkan tautan reset kata sandi langsung ke inbox email Anda.
                    </p>
                </div>

                {{-- Steps --}}
                <div class="mt-10 space-y-4 w-full max-w-xs">
                    @foreach([
                        ['1', 'Masukkan alamat email Anda'],
                        ['2', 'Cek inbox / folder spam'],
                        ['3', 'Klik tautan & buat sandi baru'],
                    ] as $step)
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/20">
                        <div class="w-8 h-8 bg-white text-blue-600 rounded-full flex items-center justify-center text-sm font-bold shrink-0">
                            {{ $step[0] }}
                        </div>
                        <p class="text-white text-sm font-medium">{{ $step[1] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="relative z-10 text-blue-200 text-sm font-medium">
                &copy; {{ date('Y') }} Rumah Sakit Pro. All rights reserved.
            </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white relative">
            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="flex lg:hidden items-center gap-3 mb-10 justify-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800 text-2xl tracking-tight">RS<span class="text-blue-600">Pro</span></span>
                </div>

                {{-- Icon --}}
                <div class="flex justify-center lg:justify-start mb-8">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center border border-blue-100">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                </div>

                {{-- Heading --}}
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Lupa Kata Sandi? 🔑</h2>
                    <p class="text-slate-500 text-base leading-relaxed">
                        Tenang! Masukkan email yang terdaftar dan kami akan kirimkan tautan untuk mereset kata sandi Anda.
                    </p>
                </div>

                {{-- Session Status (success message) --}}
                @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
                    <div class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">Email Terkirim!</p>
                        <p class="text-sm text-emerald-700 mt-0.5">{{ session('status') }}</p>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="email@anda.com"
                                class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-shadow py-3"
                            >
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md transform hover:-translate-y-0.5"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Kirim Tautan Reset
                    </button>
                </form>

                {{-- Back to login --}}
                <p class="mt-8 text-center text-sm text-slate-600">
                    Ingat kata sandi Anda?
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 hover:underline transition-colors ml-1">
                        Kembali Masuk
                    </a>
                </p>

                {{-- Help note --}}
                <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                    <p class="text-xs text-slate-500 text-center leading-relaxed">
                        💡 Tidak menerima email? Periksa folder <strong>Spam</strong> atau <strong>Promosi</strong>. Tautan berlaku selama <strong>60 menit</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
