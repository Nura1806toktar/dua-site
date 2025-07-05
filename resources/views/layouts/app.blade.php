<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Таңғы дұғалар')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-blue-50 to-white text-gray-900 font-sans min-h-screen flex flex-col">

{{-- Навигациялық мәзір --}}
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold text-blue-700">📿 Dua.kz</a>
        <nav class="space-x-4">
            <a href="/morning" class="text-gray-700 hover:text-blue-600 font-medium">🌅 Таңғы дұғалар</a>
            <a href="/evening" class="text-gray-700 hover:text-blue-600 font-medium">🌇 Кешкі дұғалар</a>
            <a href="/verse" class="text-gray-700 hover:text-green-600 font-medium">🌟 Бүгінгі аятың</a>

        </nav>
    </div>
</header>

{{-- Контент --}}
<main class="flex-1 container mx-auto px-4 py-10">
    @yield('content')
</main>

{{-- Футер --}}
<footer class="bg-white border-t border-gray-200 py-6 text-center text-sm text-gray-500">
    © {{ date('Y') }} Dua.kz — Барлық құқықтар қорғалған. | Аллаға деген махаббатпен жасалды ❤️
</footer>

</body>
</html>
