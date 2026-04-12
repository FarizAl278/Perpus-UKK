<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $query = Book::query();

        // 🔥 ambil keyword (support q ATAU search)
        $search = request('q') ?? request('search');

        // 🔥 SEARCH (judul, penulis, kategori)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // 🔥 FILTER KATEGORI
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        $books = $query->latest()->get();

        return view('pages.index', compact('books'));
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        // ambil buku lain (exclude yang sekarang)
        $relatedBooks = Book::where('id', '!=', $book->id)
            ->latest()
            ->take(8)
            ->get();

        return view('pages.show', compact('book', 'relatedBooks'));
    }
}
