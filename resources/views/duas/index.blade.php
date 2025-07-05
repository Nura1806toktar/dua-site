@extends('layouts.app')

@section('title', 'Таңғы дұғалар')

@section('content')
    <h1 class="text-3xl font-bold text-center text-blue-700 mb-10">
        🌅 Таңғы дұғалар
    </h1>

    <form method="GET" action="{{ route('duas.morning') }}" class="mb-8">
        <div class="flex items-center max-w-md mx-auto">
            <input type="text" name="search" value="{{ $search }}" placeholder="Іздеу..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-300" />
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition">
                🔍
            </button>
        </div>
    </form>


    <div class="flex flex-col gap-8">
        @foreach($duas as $key => $dua)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 p-6">
                <h2 class="text-2xl font-bold text-blue-800 mb-4">📖 Дұға {{ $key }}</h2>

                <div class="mb-3">
                    <p class="text-gray-700 mb-1 font-medium">🕋 Арабша:</p>
                    <div class="text-2xl leading-relaxed text-gray-900">{!! $dua['arabic'] !!}</div>
                </div>

                <div class="mb-3">
                    <p class="text-gray-700 mb-1 font-medium">🔤 Транскрипция:</p>
                    <div class="italic text-gray-800">{!!   $dua['transcriptions']['kazakh'] ?? '—' !!}</div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1 font-medium">💬 Аударма:</p>
                    <div class="text-gray-700">{!!   $dua['translations']['kazakh'] ?? '—' !!}</div>
                </div>

                @if(isset($dua['description']) && is_array($dua['description']))
                    <div class="mt-4">
                        <p class="font-medium text-gray-800 mb-1">📌 Ерекшеліктері:</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm">
                            @foreach($dua['description'] as $desc)
                                <li>{!! $desc !!}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        @endforeach
    </div>
@endsection
