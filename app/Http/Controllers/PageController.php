<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Data koleksi sepatu (pengganti database).
     */
    private function koleksi(): array
    {
        return [
            ['nama' => 'Air Jordan 1 Low "Chicago"',        'merek' => 'Nike',        'ukuran' => 42, 'tahun_beli' => 2023, 'kondisi' => 'bagus',     'harga_beli' => 1850000, 'status' => 'koleksi pajang'],
            ['nama' => 'Dunk Low "Panda"',                  'merek' => 'Nike',        'ukuran' => 42, 'tahun_beli' => 2022, 'kondisi' => 'bagus',     'harga_beli' => 1650000, 'status' => 'dipakai harian'],
            ['nama' => 'Samba OG "White Black Gum"',        'merek' => 'Adidas',      'ukuran' => 42, 'tahun_beli' => 2024, 'kondisi' => 'baru',      'harga_beli' => 1700000, 'status' => 'dipakai harian'],
            ['nama' => 'Air Force 1 Low "Triple White"',    'merek' => 'Nike',        'ukuran' => 42, 'tahun_beli' => 2021, 'kondisi' => 'ada cacat', 'harga_beli' => 1450000, 'status' => 'dijual'],
            ['nama' => 'Chuck 70 Hi "Parchment"',           'merek' => 'Converse',    'ukuran' => 41, 'tahun_beli' => 2023, 'kondisi' => 'bagus',     'harga_beli' => 1200000, 'status' => 'dipakai harian'],
            ['nama' => 'Old Skool "Black White"',           'merek' => 'Vans',        'ukuran' => 42, 'tahun_beli' => 2022, 'kondisi' => 'bagus',     'harga_beli' => 950000,  'status' => 'dipakai harian'],
            ['nama' => '990v6 "Grey"',                      'merek' => 'New Balance', 'ukuran' => 42, 'tahun_beli' => 2024, 'kondisi' => 'baru',      'harga_beli' => 3200000, 'status' => 'koleksi pajang'],
            ['nama' => 'Gazelle "Bold Pink"',               'merek' => 'Adidas',      'ukuran' => 41, 'tahun_beli' => 2023, 'kondisi' => 'ada cacat', 'harga_beli' => 1500000, 'status' => 'dijual'],
            ['nama' => 'Club C 85 Vintage "Chalk White"',   'merek' => 'Reebok',      'ukuran' => 42, 'tahun_beli' => 2022, 'kondisi' => 'bagus',     'harga_beli' => 1100000, 'status' => 'dipakai harian'],
            ['nama' => 'Air Max 90 "Infrared"',             'merek' => 'Nike',        'ukuran' => 42, 'tahun_beli' => 2020, 'kondisi' => 'ada cacat', 'harga_beli' => 2100000, 'status' => 'koleksi pajang'],
        ];
    }

    /**
     * Hitung ringkasan angka dari seluruh koleksi.
     */
    private function ringkasan(array $koleksi): array
    {
        $data = collect($koleksi);

        return [
            'total'  => $data->count(),
            'nilai'  => $data->sum('harga_beli'),
            'harian' => $data->where('status', 'dipakai harian')->count(),
            'pajang' => $data->where('status', 'koleksi pajang')->count(),
            'dijual' => $data->where('status', 'dijual')->count(),
        ];
    }

    /**
     * Ambil username dari request parameter (?username=...).
     */
    private function ambilUsername(Request $request): ?string
    {
        $username = trim((string) $request->query('username', ''));

        return $username === '' ? null : $username;
    }

    public function login()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|min:3|max:30',
                'password' => 'required|string|min:4',
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'username.min'      => 'Username minimal 3 karakter.',
                'username.max'      => 'Username maksimal 30 karakter.',
                'password.required' => 'Password wajib diisi.',
                'password.min'      => 'Password minimal 4 karakter.',
            ]
        );

        // Simulasi login: username dikirim ke dashboard lewat request parameter
        return redirect()->route('dashboard', [
            'username' => $request->input('username'),
        ]);
    }

    public function dashboard(Request $request)
    {
        $username = $this->ambilUsername($request);

        if ($username === null) {
            return redirect()->route('login');
        }

        $koleksi = $this->koleksi();
        $data = collect($koleksi);

        return view('dashboard', [
            'username'  => $username,
            'ringkasan' => $this->ringkasan($koleksi),
            'terbaru'   => $data->sortByDesc('tahun_beli')->take(4)->values()->all(),
            'perhatian' => $data->where('kondisi', 'ada cacat')->values()->all(),
        ]);
    }

    public function pengelolaan(Request $request)
    {
        $username = $this->ambilUsername($request);

        if ($username === null) {
            return redirect()->route('login');
        }

        $koleksi = $this->koleksi();
        $filterAktif = $request->query('status', 'semua');

        $daftar = $filterAktif === 'semua'
            ? $koleksi
            : array_values(array_filter($koleksi, function ($sepatu) use ($filterAktif) {
                return $sepatu['status'] === $filterAktif;
            }));

        return view('pengelolaan', [
            'username'    => $username,
            'ringkasan'   => $this->ringkasan($koleksi),
            'sepatu'      => $daftar,
            'filterAktif' => $filterAktif,
            'opsiFilter'  => ['semua', 'dipakai harian', 'koleksi pajang', 'dijual'],
        ]);
    }

    public function profile(Request $request)
    {
        $username = $this->ambilUsername($request);

        if ($username === null) {
            return redirect()->route('login');
        }

        $koleksi = $this->koleksi();
        $data = collect($koleksi);

        return view('profile', [
            'username'    => $username,
            'ringkasan'   => $this->ringkasan($koleksi),
            'perMerek'    => $data->countBy(fn ($s) => $s['merek'])->sortDesc()->all(),
            'ukuranUmum'  => $data->countBy(fn ($s) => $s['ukuran'])->sortDesc()->keys()->first(),
            'termahal'    => $data->sortByDesc('harga_beli')->first(),
            'tertua'      => $data->sortBy('tahun_beli')->first(),
        ]);
    }
}
