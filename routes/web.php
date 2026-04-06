<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/', [BookController::class, 'index']);
Route::get('/books/{slug}', [BookController::class, 'show']);

Route::post('/pinjam/{id}', [PeminjamanController::class, 'store']);