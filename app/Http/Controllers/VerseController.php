<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerseController extends Controller
{
    public function show()
    {
        return view('verse.random');
    }

    public function random()
    {
        $json = file_get_contents(resource_path('data/verses.json'));
        $verses = json_decode($json, true);

        $random = $verses[array_rand($verses)];

        return response()->json($random);
    }
    public function all()
    {
        $json = file_get_contents(resource_path('data/verses.json'));
        $verses = json_decode($json, true);
        return response()->json($verses);
    }

}
