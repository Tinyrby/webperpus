<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index($section = 'profile-perpustakaan')
    {
        $validSections = [
            'profile-perpustakaan' => 'Profile Perpustakaan',
            'visi-misi' => 'Visi & Misi',
            'struktur-organisasi' => 'Struktur Organisasi',
            'staff-perpustakaan' => 'Staff Perpustakaan',
            'tata-tertib' => 'Tata Tertib',
            'jam-buka' => 'Jam Buka',
            'kontak' => 'Kontak',
            'berita' => 'Berita',
            'galeri' => 'Galeri',
        ];

        if (!array_key_exists($section, $validSections)) {
            abort(404);
        }

        return view('about.index', [
            'currentSection' => $section,
            'title' => $validSections[$section],
            'sections' => $validSections
        ]);
    }
}
