@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $total = max($ringkasan['total'], 1);
        $persenHarian = round($ringkasan['harian'] / $total * 100);
        $persenPajang = round($ringkasan['pajang'] / $total * 100);
        $persenDijual = round($ringkasan['dijual'] / $total * 100);
    @endphp

    {{-- Banner sapaan --}}
    <div class="relative overflow-hidden rounded-2xl bg-stone-900 p-6 md:p-8 text-stone-100 mb-6">
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-amber-500/20"></div>
        <div class="absolute -bottom-16 right-24 w-40 h-40 rounded-full bg-amber-400/10"></div>
        <div class="relative">
            <p class="text-amber-400 text-sm">👋 Selamat datang kembali</p>
            <h1 class="text-3xl font-bold mt-1">Halo, {{ $username }}!</h1>
            <p class="text-stone-400 mt-2 max-w-md">
                Rak kamu berisi {{ $ringkasan['total'] }} pasang sepatu dengan total nilai
                <span class="text-amber-300 font-semibold">Rp {{ number_format($ringkasan['nilai'], 0, ',', '.') }}</span> 💰
            </p>
        </div>
    </div>

    {{-- Kartu angka --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="rounded-xl border border-stone-300 bg-white p-4 transition hover:-translate-y-1 hover:shadow-lg">
            <p class="text-2xl">👟</p>
            <p class="text-3xl font-bold mt-1">{{ $ringkasan['total'] }}</p>
            <p class="text-sm text-stone-500">Total sepatu</p>
        </div>
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 transition hover:-translate-y-1 hover:shadow-lg">
            <p class="text-2xl">🏃</p>
            <p class="text-3xl font-bold mt-1 text-emerald-700">{{ $ringkasan['harian'] }}</p>
            <p class="text-sm text-emerald-700/80">Dipakai harian</p>
        </div>
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 transition hover:-translate-y-1 hover:shadow-lg">
            <p class="text-2xl">🏆</p>
            <p class="text-3xl font-bold mt-1 text-amber-700">{{ $ringkasan['pajang'] }}</p>
            <p class="text-sm text-amber-700/80">Koleksi pajang</p>
        </div>
        <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 transition hover:-translate-y-1 hover:shadow-lg">
            <p class="text-2xl">💸</p>
            <p class="text-3xl font-bold mt-1 text-rose-700">{{ $ringkasan['dijual'] }}</p>
            <p class="text-sm text-rose-700/80">Mau dijual</p>
        </div>
    </div>

    {{-- Komposisi rak --}}
    <section class="rounded-xl border border-stone-300 bg-white p-5 mb-6">
        <h2 class="font-bold mb-4">📊 Komposisi rak</h2>

        <div class="space-y-4 text-sm">
            <div>
                <div class="flex justify-between mb-1">
                    <span>🏃 Dipakai harian</span>
                    <span class="font-medium">{{ $persenHarian }}%</span>
                </div>
                <div class="h-2.5 rounded-full bg-stone-200">
                    <div class="h-2.5 rounded-full bg-emerald-500" style="width: {{ $persenHarian }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-1">
                    <span>🏆 Koleksi pajang</span>
                    <span class="font-medium">{{ $persenPajang }}%</span>
                </div>
                <div class="h-2.5 rounded-full bg-stone-200">
                    <div class="h-2.5 rounded-full bg-amber-500" style="width: {{ $persenPajang }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-1">
                    <span>💸 Mau dijual</span>
                    <span class="font-medium">{{ $persenDijual }}%</span>
                </div>
                <div class="h-2.5 rounded-full bg-stone-200">
                    <div class="h-2.5 rounded-full bg-rose-500" style="width: {{ $persenDijual }}%"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Dua daftar --}}
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <section>
            <h2 class="font-bold mb-3">🆕 Pembelian terbaru</h2>
            <ul class="bg-white border border-stone-300 rounded-xl divide-y divide-stone-200 overflow-hidden">
                @foreach ($terbaru as $sepatu)
                    <li class="flex items-center gap-3 px-4 py-3 transition hover:bg-stone-50">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-stone-900 text-amber-400 flex items-center justify-center font-bold">
                            {{ substr($sepatu['merek'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium">{{ $sepatu['nama'] }}</p>
                            <p class="text-sm text-stone-500">{{ $sepatu['merek'] }} &middot; dibeli {{ $sepatu['tahun_beli'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="font-bold mb-3">🛠️ Perlu perhatian</h2>
            <ul class="bg-white border border-stone-300 rounded-xl divide-y divide-stone-200 overflow-hidden">
                @forelse ($perhatian as $sepatu)
                    <li class="flex items-center gap-3 px-4 py-3 transition hover:bg-stone-50">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-red-100 flex items-center justify-center">⚠️</div>
                        <div>
                            <p class="font-medium">{{ $sepatu['nama'] }}</p>
                            <p class="text-sm text-red-600">Kondisi: {{ $sepatu['kondisi'] }}</p>
                        </div>
                    </li>
                @empty
                    <li class="px-4 py-3 text-stone-500">✅ Semua sepatu dalam kondisi baik.</li>
                @endforelse
            </ul>
        </section>
    </div>

    {{-- Pintasan --}}
    <div class="grid sm:grid-cols-2 gap-3">
        <a href="{{ route('pengelolaan', ['username' => $username]) }}"
           class="flex items-center justify-between rounded-xl bg-amber-400 px-5 py-4 font-medium text-stone-900 transition hover:bg-amber-300">
            <span>📦 Kelola koleksi</span>
            <span>→</span>
        </a>
        <a href="{{ route('profile', ['username' => $username]) }}"
           class="flex items-center justify-between rounded-xl bg-stone-900 px-5 py-4 font-medium text-stone-100 transition hover:bg-stone-700">
            <span>🙋 Lihat profil</span>
            <span>→</span>
        </a>
    </div>
@endsection
