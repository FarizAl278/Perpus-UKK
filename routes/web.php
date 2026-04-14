<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login/api', function () {
    return redirect('/loginuser');
})->name('login');

Route::get('/loginuser', [SiswaAuthController::class, 'index'])->name('siswa.login');
Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])->name('siswa.logout');
Route::post('/loginuser', [SiswaAuthController::class, 'login'])
    ->name('siswa.login.store')
    ->middleware('throttle:5,1'); // Max 5 percobaan per menit

// Profile routes (harus setelah auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
});

Route::get('/', [BookController::class, 'index']);
Route::get('/books/{slug}', [BookController::class, 'show']);

Route::post('/pinjam/{book}', [PeminjamanController::class, 'store'])
    ->middleware('auth')
    ->name('pinjam.store');

Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');

// ✅ ROUTE BARU: Batalkan Peminjaman
Route::post('/riwayat/{id}/cancel', [PeminjamanController::class, 'cancel'])
    ->middleware('auth')
    ->name('riwayat.cancel');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');