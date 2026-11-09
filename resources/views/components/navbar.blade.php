@props(['username' => null])

<nav class="bg-stone-900 text-stone-100">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <span class="font-bold tracking-wide">Rak Sepatu</span>

        @if ($username)
            <div class="flex items-center gap-5 text-sm">
                <a class="hover:text-amber-400" href="{{ route('dashboard', ['username' => $username]) }}">Dashboard</a>
                <a class="hover:text-amber-400" href="{{ route('pengelolaan', ['username' => $username]) }}">Pengelolaan</a>
                <a class="hover:text-amber-400" href="{{ route('profile', ['username' => $username]) }}">Profil</a>
                <a class="text-stone-400 hover:text-red-400" href="{{ route('login') }}">Keluar</a>
            </div>
        @endif
    </div>
</nav>
