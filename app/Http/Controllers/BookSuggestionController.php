<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookSuggestion;
use Illuminate\Support\Facades\Session;

class BookSuggestionController extends Controller
{
    public function index()
    {
        // Generate random 4 digit code
        $captcha = rand(1000, 9999);
        Session::put('captcha_code', $captcha);
        
        return view('usulan-buku', compact('captcha'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'captcha' => 'required|numeric',
        ]);

        // Validate Captcha
        if ($request->captcha != Session::get('captcha_code')) {
            return back()->withErrors(['captcha' => 'Kode verifikasi salah!'])->withInput();
        }

        BookSuggestion::create($request->all());

        return redirect()->route('usulan-buku.index')->with('success', 'Usulan buku Anda berhasil dikirim. Terima kasih!');
    }
}
