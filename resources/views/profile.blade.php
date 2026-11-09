@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="flex items-center gap-4 mb-8">
        <div class="w-14 h-14 rounded-full bg-stone-900 text-amber-400 flex items-center justify-center text-2xl font-bold">
            {{ strtoupper(substr($username, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-2xl font-bold">{{ $username }}</h1>
            <p class="text-stone-500">Kolektor dengan {{ $ringkasan['total'] }} pasang sepatu</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <section>
            <h2 class="font-bold mb-3">Koleksi per merek</h2>
            <ul class="bg-white border border-stone-300 rounded-lg divide-y divide-stone-200">
                @foreach ($perMerek as $merek => $jumlah)
                    <li class="px-4 py-3 flex justify-between">
                        <span>{{ $merek }}</span>
                        <span class="font-semibold">{{ $jumlah }} pasang</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="font-bold mb-3">Catatan koleksi</h2>
            <div class="bg-white border border-stone-300 rounded-lg divide-y divide-stone-200">
                <div class="px-4 py-3">
                    <p class="text-sm text-stone-500">Ukuran yang paling sering</p>
                    <p class="font-medium">{{ $ukuranUmum }}</p>
                </div>
                <div class="px-4 py-3">
                    <p class="text-sm text-stone-500">Termahal</p>
                    <p class="font-medium">{{ $termahal['nama'] }}</p>
                    <p class="text-sm text-stone-500">Rp {{ number_format($termahal['harga_beli'], 0, ',', '.') }}</p>
                </div>
                <div class="px-4 py-3">
                    <p class="text-sm text-stone-500">Paling lama dimiliki</p>
                    <p class="font-medium">{{ $tertua['nama'] }}</p>
                    <p class="text-sm text-stone-500">Dibeli {{ $tertua['tahun_beli'] }}</p>
                </div>
            </div>
        </section>
    </div>
@endsection
