<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DuaController extends Controller
{
    public function index(Request $request)
    {
        $json = file_get_contents(resource_path('data/duas.json'));
        $data = json_decode($json, true);
        $duas = $data['morning'] ?? [];

        $search = $request->query('search');

        if ($search) {
            $duas = collect($duas)->filter(function ($dua, $key) use ($search) {
                return str_contains(strtolower($key), strtolower($search)) ||
                    str_contains(strtolower($dua['arabic']), strtolower($search)) ||
                    str_contains(strtolower($dua['transcriptions']['kazakh'] ?? ''), strtolower($search)) ||
                    str_contains(strtolower($dua['translations']['kazakh'] ?? ''), strtolower($search));
            })
                ->map(function ($dua) use ($search) {
                    $dua['arabic'] = $this->highlightSearch($dua['arabic'], $search);
                    $dua['transcriptions']['kazakh'] = $this->highlightSearch($dua['transcriptions']['kazakh'] ?? '', $search);
                    $dua['translations']['kazakh'] = $this->highlightSearch($dua['translations']['kazakh'] ?? '', $search);

                    if (isset($dua['description']) && is_array($dua['description'])) {
                        foreach ($dua['description'] as $i => $desc) {
                            $dua['description'][$i] = $this->highlightSearch($desc, $search);
                        }
                    }

                    return $dua;
                })
                ->toArray();

        }

        return view('duas.index', [
            'duas' => $duas,
            'search' => $search,
        ]);
    }

    protected function highlightSearch($text, $search)
    {
        if (!$search) return $text;

        return preg_replace(
            '/(' . preg_quote($search, '/') . ')/i',
            '<mark class="bg-yellow-200 px-1 rounded">$1</mark>',
            $text
        );
    }
}
