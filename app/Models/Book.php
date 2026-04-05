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
        'kategori',
        'tahun_terbit',
        'stok',
    ];
}
