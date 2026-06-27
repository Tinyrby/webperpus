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

        $searchResults = $keyword ? $query->paginate(12)->withQueryString() : null;

        if (!$keyword) {
            $popularBooks = Book::with('category')->withCount('loans')->orderBy('loans_count', 'desc')->take(6)->get();
            $newBooks = Book::with('category')->orderBy('created_at', 'desc')->take(6)->get();
            $topMembers = Member::withCount('loans')->orderBy('loans_count', 'desc')->take(4)->get();
            $categories = \App\Models\Category::all();
            
            return view('catalog.index', compact('keyword', 'searchResults', 'popularBooks', 'newBooks', 'topMembers', 'categories'));
        }

        return view('catalog.index', compact('keyword', 'searchResults'));
    }

    public function show(Book $book)
    {
        $book->load(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        return view('catalog.show', compact('book'));
    }

    public function information()
    {
        return view('catalog.information');
    }

    public function help()
    {
        return view('catalog.help');
    }

    public function guidelines($slug = null)
    {
        $guidelinesList = \App\Models\Guideline::where('is_active', true)
                                               ->orderBy('order', 'asc')
                                               ->get();

        if ($guidelinesList->isEmpty()) {
            abort(404, 'Panduan tidak ditemukan.');
        }

        if (!$slug) {
            $currentGuide = $guidelinesList->first();
            return redirect()->route('katalog.guidelines', $currentGuide->slug);
        }

        $currentGuide = $guidelinesList->where('slug', $slug)->first();

        if (!$currentGuide) {
            abort(404, 'Panduan tidak ditemukan.');
        }

        return view('catalog.guidelines', compact('slug', 'guidelinesList', 'currentGuide'));
    }

    public function storeComment(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $book->comments()->create([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
