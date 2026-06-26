<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Facility;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        $heroImage = Setting::where('key', 'hero_image')->first();
        
        return view('home', compact('facilities', 'heroImage'));
    }
}
