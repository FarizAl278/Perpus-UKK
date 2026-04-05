<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Book::create([
                'cover' => 'covers/sample.jpg',
                'judul' => 'Buku Contoh ' . $i,
                'slug' => Str::slug('Buku Contoh ' . $i),
                'sub_judul' => 'Sub Judul ' . $i,
                'sinopsis' => 'Ini adalah sinopsis buku contoh.',
                'penulis' => 'Penulis ' . $i,
                'penerbit' => 'Penerbit ' . $i,
                'kategori' => 'Teknologi',
                'tahun_terbit' => now(),
                'stok' => rand(1, 10),
            ]);
        }
    }
}