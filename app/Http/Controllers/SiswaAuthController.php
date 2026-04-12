<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SiswaAuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('pages.loginUser');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        // Deteksi otomatis: pakai email atau NIS
        $field = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        // Coba autentikasi
        // ⚠️ Ganti Auth::attempt() jadi Auth::guard('siswa')->attempt() jika pakai guard terpisah
        if (Auth::attempt([$field => $request->identity, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect ke halaman utama siswa
            return redirect()->intended('/'); 
        }

        // Jika gagal, kembalikan error ke form
        throw ValidationException::withMessages([
            'identity' => 'NIS/Email atau password salah.',
        ]);
    }

    // Logout siswa
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/loginuser')->with('success', 'Berhasil logout.');
    }
}