<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'book_id',
        'kelas',
        'jurusan',
        'tanggal_peminjaman',
        'tanggal_kembali',
        'status',
        'expired_at',
        'diambil_at',
    ];

    protected $casts = [
        'tanggal_peminjaman' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'expired_at' => 'datetime',
        'diambil_at' => 'datetime',
    ];

    public function isLate()
    {
        return $this->status === 'dipinjam' &&
            Carbon::parse($this->tanggal_kembali)->isPast();
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
