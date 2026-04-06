<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'book_id',
        'nama_peminjam',
        'tanggal_peminjaman',
        'tanggal_kembali',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
