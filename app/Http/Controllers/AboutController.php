<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AboutPage;

class AboutController extends Controller
{
    public function index($slug = null)
    {
        $aboutPages = AboutPage::where('is_active', true)->orderBy('order', 'asc')->get();

        if ($aboutPages->isEmpty()) {
            abort(404, 'Halaman Tentang Kami belum tersedia.');
        }

        if (!$slug) {
            $currentSection = $aboutPages->first();
            return redirect()->route('tentang-kami', $currentSection->slug);
        }

        $currentSection = $aboutPages->where('slug', $slug)->first();

        if (!$currentSection) {
            abort(404, 'Halaman Tentang Kami tidak ditemukan.');
        }

        $staffs = [];
        if (in_array($slug, ['struktur-organisasi', 'staff-perpustakaan'])) {
            $category = $slug == 'struktur-organisasi' ? 'struktur_organisasi' : 'staff_perpustakaan';
            $staffs = \App\Models\Staff::where('category', $category)->orderBy('order', 'asc')->get();
        }

        return view('about.index', [
            'currentSection' => $currentSection,
            'aboutPages' => $aboutPages,
            'staffs' => $staffs
        ]);
    }
}
