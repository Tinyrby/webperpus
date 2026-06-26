<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Facility;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $nim = $request->query('nim');
        $loans = null;
        if ($nim) {
            $loans = Loan::with(['book', 'member'])->whereHas('member', function($query) use ($nim) {
                $query->where('nim', $nim);
            })->orderBy('borrow_date', 'desc')->get();
        }

        // We also need to pass facilities for the navbar
        $facilities = Facility::all();

        return view('cek-pinjaman', compact('loans', 'nim', 'facilities'));
    }
}
