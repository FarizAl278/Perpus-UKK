<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genres;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('genres');

        $search = $request->q ?? $request->search;

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhereHas('genres', function ($genres) use ($search) {
                      $genres->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // FILTER GENRE
        if ($request->genre) {
            $query->where('genres_id', $request->genre);
        }

        $books = $query->latest()->get();

        $genres = Genres::orderBy('name')->get();

        return view('pages.index', compact('books', 'genres'));
    }

    public function show($slug)
    {
        $book = Book::with('genres')->where('slug', $slug)->firstOrFail();

        $relatedBooks = Book::where('id', '!=', $book->id)
            ->latest()
            ->take(8)
            ->get();

        return view('pages.show', compact('book', 'relatedBooks'));
    }
}