@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('content')
    <h1 class="text-2xl font-bold">Pengelolaan koleksi</h1>
    <p class="text-stone-500 mb-5">
        Menampilkan {{ count($sepatu) }} dari {{ $ringkasan['total'] }} pasang sepatu.
    </p>

    <div class="flex flex-wrap gap-2 mb-5">
        @foreach ($opsiFilter as $opsi)
            <a href="{{ route('pengelolaan', ['username' => $username, 'status' => $opsi]) }}"
               class="px-3 py-1 rounded-full text-sm border
                      {{ $filterAktif === $opsi ? 'bg-stone-900 text-white border-stone-900' : 'bg-white text-stone-700 border-stone-300 hover:border-stone-500' }}">
                {{ ucfirst($opsi) }}
            </a>
        @endforeach
    </div>

    <div class="bg-white border border-stone-300 rounded-lg overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-stone-50 text-stone-500">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Merek</th>
                    <th class="px-4 py-3">Ukuran</th>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Kondisi</th>
                    <th class="px-4 py-3">Harga beli</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200">
                @forelse ($sepatu as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $item['nama'] }}</td>
                        <td class="px-4 py-3">{{ $item['merek'] }}</td>
                        <td class="px-4 py-3">{{ $item['ukuran'] }}</td>
                        <td class="px-4 py-3">{{ $item['tahun_beli'] }}</td>
                        <td class="px-4 py-3 {{ $item['kondisi'] === 'ada cacat' ? 'text-red-600' : '' }}">
                            {{ ucfirst($item['kondisi']) }}
                        </td>
                        <td class="px-4 py-3">Rp {{ number_format($item['harga_beli'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ ucfirst($item['status']) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-stone-500">
                            Tidak ada sepatu dengan status ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
