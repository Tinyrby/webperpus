<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;

class AdminLoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'member'])->orderBy('created_at', 'desc')->get();
        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();
        $members = Member::orderBy('name')->get();
        return view('admin.loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:Dipinjam,Dikembalikan',
        ]);

        Loan::create($request->all());
        return redirect()->route('admin.loans.index')->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

    public function edit(Loan $loan)
    {
        $books = Book::orderBy('title')->get();
        $members = Member::orderBy('name')->get();
        return view('admin.loans.edit', compact('loan', 'books', 'members'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:Dipinjam,Dikembalikan',
        ]);

        $loan->update($request->all());
        return redirect()->route('admin.loans.index')->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('admin.loans.index')->with('success', 'Data pinjaman berhasil dihapus.');
    }
}
