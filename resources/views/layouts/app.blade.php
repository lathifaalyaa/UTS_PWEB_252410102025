<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Koleksi Sepatu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 text-stone-800">

    <x-navbar :username="$username ?? null" />

    <main class="max-w-5xl mx-auto px-4 py-8 min-h-[70vh]">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
