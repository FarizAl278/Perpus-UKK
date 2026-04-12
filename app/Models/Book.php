<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'cover',
        'judul',
        'slug',
        'sub_judul',
        'sinopsis',
        'penulis',
        'penerbit',
        'genres_id',
        'tahun_terbit',
        'stok',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function genres()
    {
        return $this->belongsTo(Genres::class);
    }
}

