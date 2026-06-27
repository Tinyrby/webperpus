<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        $books = $query->get();
        $categories = Category::all();
        
        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|string|max:4',
            'isbn' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'series_title' => 'nullable|string|max:255',
            'call_number' => 'nullable|string|max:255',
            'physical_description' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'classification' => 'nullable|string|max:255',
            'content_type' => 'nullable|string|max:255',
            'media_type' => 'nullable|string|max:255',
            'carrier_type' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'specific_detail_info' => 'nullable|string|max:255',
            'statement_of_responsibility' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->boolean('is_available', true);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        Book::create($data);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|string|max:4',
            'isbn' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'series_title' => 'nullable|string|max:255',
            'call_number' => 'nullable|string|max:255',
            'physical_description' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'classification' => 'nullable|string|max:255',
            'content_type' => 'nullable|string|max:255',
            'media_type' => 'nullable|string|max:255',
            'carrier_type' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'specific_detail_info' => 'nullable|string|max:255',
            'statement_of_responsibility' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->boolean('is_available', true);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
