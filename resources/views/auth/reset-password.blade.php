<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Kata Sandi - {{ config('app.name', 'Sistem Antrean RS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }

        .strength-bar { transition: width 0.4s ease, background-color 0.4s ease; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex">

        {{-- Left Side: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 bg-blue-600 flex-col justify-between p-12 relative overflow-hidden">
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

            {{-- Center Content --}}
            <div class="relative z-10 flex flex-col items-center justify-center flex-1 py-16">
                <div class="animate-float">
                    <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30 shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <h3 class="text-2xl font-bold text-white mb-3">Buat Sandi Baru</h3>
                    <p class="text-blue-100 text-sm max-w-xs leading-relaxed">
                        Pilih kata sandi yang kuat dan unik untuk melindungi akun Anda.
                    </p>
                </div>

                {{-- Tips --}}
                <div class="mt-10 space-y-3 w-full max-w-xs">
                    <p class="text-blue-200 text-xs font-semibold uppercase tracking-widest mb-2">Tips Sandi Kuat</p>
                    @foreach([
                        ['🔡', 'Minimal 8 karakter'],
                        ['🔢', 'Kombinasi huruf & angka'],
                        ['🔣', 'Tambahkan simbol (!@#$)'],
                        ['🚫', 'Jangan gunakan data pribadi'],
                    ] as $tip)
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2.5 border border-white/20">
                        <span class="text-base">{{ $tip[0] }}</span>
                        <p class="text-white text-sm">{{ $tip[1] }}</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                {{-- Heading --}}
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Buat Sandi Baru 🔐</h2>
                    <p class="text-slate-500 text-base leading-relaxed">
                        Masukkan kata sandi baru Anda. Pastikan mudah diingat namun sulit ditebak.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6" id="resetForm">
                    @csrf

                    {{-- Hidden token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                value="{{ old('email', $request->email) }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-shadow py-3 bg-slate-50"
                                readonly
                            >
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                oninput="checkStrength(this.value)"
                                class="pl-10 pr-12 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-shadow py-3"
                            >
                            <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg id="eyeIcon1" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Strength indicator --}}
                        <div class="mt-2">
                            <div class="flex gap-1 mb-1">
                                <div id="bar1" class="h-1.5 flex-1 rounded-full bg-slate-200 strength-bar"></div>
                                <div id="bar2" class="h-1.5 flex-1 rounded-full bg-slate-200 strength-bar"></div>
                                <div id="bar3" class="h-1.5 flex-1 rounded-full bg-slate-200 strength-bar"></div>
                                <div id="bar4" class="h-1.5 flex-1 rounded-full bg-slate-200 strength-bar"></div>
                            </div>
                            <p id="strengthText" class="text-xs text-slate-400">Ketik sandi untuk melihat kekuatannya</p>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi kata sandi baru"
                                oninput="checkMatch()"
                                class="pl-10 pr-12 block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm transition-shadow py-3"
                            >
                            <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg id="eyeIcon2" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <p id="matchText" class="mt-1.5 text-xs text-slate-400 hidden"></p>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md transform hover:-translate-y-0.5"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Kata Sandi Baru
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Ingat kata sandi Anda?
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 hover:underline transition-colors ml-1">
                        Kembali Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }

        function checkStrength(val) {
            const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
            const text = document.getElementById('strengthText');

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const colors = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-emerald-500'];
            const labels = ['Sangat Lemah', 'Lemah', 'Cukup Kuat', 'Sangat Kuat'];
            const textColors = ['text-red-500', 'text-orange-500', 'text-yellow-600', 'text-emerald-600'];

            bars.forEach((bar, i) => {
                bar.className = 'h-1.5 flex-1 rounded-full strength-bar ' + (i < score ? colors[score - 1] : 'bg-slate-200');
            });

            if (val.length === 0) {
                text.textContent = 'Ketik sandi untuk melihat kekuatannya';
                text.className = 'text-xs text-slate-400';
            } else {
                text.textContent = labels[score - 1] || 'Sangat Lemah';
                text.className = 'text-xs ' + (textColors[score - 1] || 'text-red-500');
            }

            checkMatch();
        }

        function checkMatch() {
            const pw = document.getElementById('password').value;
            const cf = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('matchText');

            if (cf.length === 0) {
                matchText.classList.add('hidden');
                return;
            }
            matchText.classList.remove('hidden');
            if (pw === cf) {
                matchText.textContent = '✓ Kata sandi cocok';
                matchText.className = 'mt-1.5 text-xs text-emerald-600 font-medium';
            } else {
                matchText.textContent = '✗ Kata sandi tidak cocok';
                matchText.className = 'mt-1.5 text-xs text-red-500 font-medium';
            }
        }
    </script>
</body>
</html>
