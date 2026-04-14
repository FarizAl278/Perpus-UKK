<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok habis!');
        }

        // 🔶 CEK: masih nunggu pengambilan
        $menunggu = Peminjaman::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'pengambilan')
            ->where(function ($q) {
                $q->whereNull('expired_at')
                    ->orWhere('expired_at', '>', now());
            })
            ->exists();

        if ($menunggu) {
            return back()->with('error', 'Kamu sudah memesan buku ini, silakan ambil dalam 12 jam!');
        }

        // 🔷 CEK: masih dipinjam
        $dipinjam = Peminjaman::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($dipinjam) {
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
            'status' => 'pengambilan',
            'expired_at' => now()->addHours(12), // 12 jam untuk pengambilan
        ]);

        $book->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam, silakan ambil di perpustakaan dalam 12 jam!');
    }

    public function riwayat()
    {
        $riwayat = Peminjaman::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.riwayat', compact('riwayat'));
    }

    /**
     * ✅ METHOD BARU: Batalkan Peminjaman
     * Hanya bisa dibatalkan jika status masih 'pengambilan' dan belum expired
     */
    public function cancel($id)
    {
        try {
            $peminjaman = Peminjaman::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Validasi: Hanya bisa batalkan jika status masih 'pengambilan'
            if ($peminjaman->status !== 'pengambilan') {
                return back()->with('error', 'Peminjaman ini tidak dapat dibatalkan karena status sudah berubah.');
            }

            // Validasi: Cek apakah sudah lewat deadline expired_at
            if ($peminjaman->expired_at && now()->gt($peminjaman->expired_at)) {
                // Jika sudah expired, ubah status otomatis jadi dibatalkan
                $peminjaman->update([
                    'status' => 'dibatalkan',
                    'cancelled_at' => now(),
                    'cancelled_reason' => 'Waktu pengambilan habis',
                ]);
                // Kembalikan stok
                $peminjaman->book->increment('stok');
                return back()->with('error', 'Waktu pengambilan telah habis. Peminjaman otomatis dibatalkan.');
            }

            // Proses pembatalan
            $peminjaman->update([
                'status' => 'dibatalkan',
                'cancelled_at' => now(),
                'cancelled_reason' => 'Dibatalkan oleh peminjam',
            ]);

            // Kembalikan stok buku
            $peminjaman->book->increment('stok');

            return back()->with('success', 'Peminjaman berhasil dibatalkan. Stok buku telah dikembalikan.');

        } catch (\Exception $e) {
            Log::error('Cancel Peminjaman Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membatalkan peminjaman.');
        }
    }
}