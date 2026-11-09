@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="max-w-4xl mx-auto md:mt-6 grid md:grid-cols-2 overflow-hidden rounded-2xl border border-stone-300 bg-white shadow-xl">

        {{-- Sisi kiri: hanya tampil di layar lebar --}}
        <div class="relative hidden md:flex flex-col justify-between bg-stone-900 p-10 text-stone-100 overflow-hidden">
            <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full bg-amber-500/20"></div>
            <div class="absolute -bottom-24 -left-12 w-80 h-80 rounded-full bg-amber-400/10"></div>

            <p class="relative text-xs tracking-[0.3em] uppercase text-amber-400">👟 Rak Sepatu</p>

            <div class="relative">
                <h2 class="text-3xl font-bold leading-tight">Satu rak, semua cerita sepatumu ✨</h2>
                <p class="mt-3 text-sm text-stone-400">
                    Catat mana yang dipakai harian, mana yang dipajang, dan mana yang siap dilepas.
                </p>

                <ul class="mt-6 space-y-2 text-sm text-stone-300">
                    <li>🏃 Dipakai harian</li>
                    <li>🏆 Koleksi pajang</li>
                    <li>💸 Siap dijual</li>
                </ul>
            </div>

            <p class="relative text-xs text-stone-500">📚 UTS Pemrograman Web 2026</p>
        </div>

        {{-- Sisi kanan: form --}}
        <div class="p-8 md:p-10">
            <h1 class="text-2xl font-bold">Selamat datang 👋</h1>
            <p class="text-sm text-stone-500 mb-6">Isi username dan password untuk mulai mengelola koleksi.</p>

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    @foreach ($errors->all() as $pesan)
                        <p>⚠️ {{ $pesan }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.proses') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium mb-1">👤 Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                           placeholder="mis. nama panggilanmu"
                           class="w-full rounded-lg border border-stone-300 bg-stone-50 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">🔑 Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               placeholder="minimal 4 karakter"
                               class="w-full rounded-lg border border-stone-300 bg-stone-50 px-4 py-2.5 pr-24 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400">
                        <button type="button" id="tombolLihat"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-medium text-stone-500 hover:text-stone-900">
                            👁️ Lihat
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-stone-900 py-2.5 font-medium text-white transition hover:bg-amber-500 hover:text-stone-900">
                    Masuk ke rak 🚪
                </button>
            </form>
        </div>
    </div>

    <script>
        const kolomPassword = document.getElementById('password');
        const tombolLihat = document.getElementById('tombolLihat');

        tombolLihat.addEventListener('click', function () {
            const tersembunyi = kolomPassword.type === 'password';
            kolomPassword.type = tersembunyi ? 'text' : 'password';
            tombolLihat.textContent = tersembunyi ? '🙈 Sembunyi' : '👁️ Lihat';
        });
    </script>
@endsection
