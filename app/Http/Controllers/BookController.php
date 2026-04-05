<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $query = Book::query();

        // search
        if (request('search')) {
            $query->where('judul', 'like', '%'.request('search').'%');
        }

        // filter kategori
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
