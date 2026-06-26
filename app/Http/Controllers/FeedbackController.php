<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    public function index()
    {
        // Generate random 4 digit code
        $captcha = rand(1000, 9999);
        Session::put('captcha_code_feedback', $captcha);
        
        return view('saran-masukan', compact('captcha'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'captcha' => 'required|numeric',
        ]);

        // Validate Captcha
        if ($request->captcha != Session::get('captcha_code_feedback')) {
            return back()->withErrors(['captcha' => 'Kode verifikasi salah!'])->withInput();
        }

        Feedback::create($request->all());

        return redirect()->route('saran-masukan.index')->with('success', 'Saran dan masukan Anda berhasil dikirim. Terima kasih!');
    }
}
