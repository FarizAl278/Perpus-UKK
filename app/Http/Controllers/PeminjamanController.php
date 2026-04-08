<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok habis!');
        }

        // Cek apakah user masih meminjam buku yang sama
        $sudahPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu masih meminjam buku ini!');
        }

        $request->validate([
            'lama_hari' => 'required|integer|min:1|max:7',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'kelas' => Auth::user()->kelas,
            'jurusan' => Auth::user()->jurusan,
            'tanggal_peminjaman' => now(),
            'tanggal_kembali' => now()->addDays((int) $request->lama_hari),
            'status' => 'dipinjam',
        ]);

        $book->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function riwayat()
    {
        $riwayat = Peminjaman::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.riwayat', compact('riwayat'));
    }
}
