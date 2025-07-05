@extends('layouts.app')

@section('title', 'Бүгінгі аятың')

@section('content')

    {{-- Анимация эффект --}}
    <style>
        @keyframes pulseText {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .loading-text {
            animation: pulseText 1s infinite;
        }
    </style>

    {{-- Тақырып --}}
    <h1 class="text-3xl text-center text-green-700 font-bold mb-8">
        📖 Бұл аят саған жайдан-жай жолыққан жоқ...
    </h1>

    {{-- Аят шығатын бөлім --}}
    <div id="verse-box" class="bg-white rounded-2xl shadow p-6 text-center hidden transition-all duration-300">
        <p class="text-3xl text-gray-900 font-semibold leading-relaxed mb-4" id="arabic"></p>
        <p class="text-lg text-gray-700" id="translation"></p>
        <p class="text-sm text-gray-400 mt-2" id="reference"></p>
    </div>

    {{-- Батырма --}}
    <div class="text-center mt-10">
        <button onclick="getVerse()" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition text-lg shadow-md">
            📩 Бүгінгі аятты алу
        </button>
    </div>

    {{-- JavaScript логика --}}
    <script>
        let allVerses = [];
        let interval = null;

        // Жүктеген кезде барлық аяттарды аламыз
        window.onload = () => {
            fetch('/api/verses')
                .then(res => res.json())
                .then(data => {
                    allVerses = data;
                });
        };

        function getVerse() {
            const box = document.getElementById('verse-box');
            const arabic = document.getElementById('arabic');
            const translation = document.getElementById('translation');
            const reference = document.getElementById('reference');

            // Әр басқанда нөлден бастаймыз
            clearInterval(interval);
            box.classList.remove('hidden');

            translation.innerText = '';
            reference.innerText = '';
            arabic.classList.add('loading-text');

            // Аяттарды жылдам ауыстырып тұру
            interval = setInterval(() => {
                const random = allVerses[Math.floor(Math.random() * allVerses.length)];
                arabic.innerText = random.arabic;
            }, 120);

            // 2.5 сек кейін тоқтату
            setTimeout(() => {
                clearInterval(interval);
                const final = allVerses[Math.floor(Math.random() * allVerses.length)];

                arabic.classList.remove('loading-text');
                arabic.innerText = final.arabic;
                translation.innerText = final.translation;
                reference.innerText = `📍 ${final.surah}, ${final.verse}-аят`;
            }, 2500);
        }
    </script>


@endsection
