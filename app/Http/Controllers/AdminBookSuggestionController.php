<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookSuggestion;

class AdminBookSuggestionController extends Controller
{
    public function index()
    {
        $suggestions = BookSuggestion::orderBy('created_at', 'desc')->get();
        return view('admin.book-suggestions.index', compact('suggestions'));
    }

    public function destroy(BookSuggestion $book_suggestion)
    {
        $book_suggestion->delete();
        return redirect()->route('admin.book-suggestions.index')->with('success', 'Usulan buku berhasil dihapus.');
    }
}
