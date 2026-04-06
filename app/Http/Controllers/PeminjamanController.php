<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\Book;

class PeminjamanController extends Controller
{
    public function store($id)
{
    $book = Book::findOrFail($id);

    // cek stok
    if ($book->stok <= 0) {
        return back()->with('error', 'Stok habis!');
    }

    // simpan peminjaman
    Peminjaman::create([
        'book_id' => $book->id,
        'nama_peminjam' => 'User Demo', // nanti bisa diganti auth
        'tanggal_peminjaman' => now(),
    ]);

    // kurangi stok
    $book->decrement('stok');

    return back()->with('success', 'Buku berhasil dipinjam!');
}
}
