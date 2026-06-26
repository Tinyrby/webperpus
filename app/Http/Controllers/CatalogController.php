<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Query for search or base catalog
        $query = Book::with('category');
        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('author', 'like', "%{$keyword}%")
                  ->orWhereHas('category', function($q) use ($keyword) {
                      $q->where('name', 'like', "%{$keyword}%");
                  });
        }

        $searchResults = $keyword ? $query->paginate(12) : null;

        // Fetch popular books (mocked by random or latest for now)
        $popularBooks = Book::inRandomOrder()->take(6)->get();

        // Fetch latest books
        $newBooks = Book::orderBy('created_at', 'desc')->take(6)->get();

        // Fetch top members (mocked by random)
        $topMembers = Member::inRandomOrder()->take(3)->get();

        return view('catalog.index', compact('keyword', 'searchResults', 'popularBooks', 'newBooks', 'topMembers'));
    }

    public function show(Book $book)
    {
        return view('catalog.show', compact('book'));
    }
}
