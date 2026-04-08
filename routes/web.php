<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [BookController::class, 'index']);
Route::get('/books/{slug}', [BookController::class, 'show']);

Route::post('/pinjam/{book}', [PeminjamanController::class, 'store'])
    ->middleware('auth')
    ->name('pinjam.store');

Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');









    

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');