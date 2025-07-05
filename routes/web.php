<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\VerseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/morning', [DuaController::class, 'index'])->name('duas.morning');

Route::get('/verse', [VerseController::class, 'show'])->name('verse.show');
Route::get('/api/verse', [VerseController::class, 'random'])->name('verse.random');
Route::get('/api/verses', [VerseController::class, 'all']);


