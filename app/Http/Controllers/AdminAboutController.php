<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function index()
    {
        $abouts = AboutPage::orderBy('order', 'asc')->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:text,video,pdf,image',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'file_path' => 'nullable|mimes:pdf,mp4,webm,jpg,jpeg,png|max:51200',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['file_path', 'is_active']);
        $data['slug'] = Str::slug($request->title_id);
        
        // Ensure slug is unique
        $originalSlug = $data['slug'];
        $count = 1;
        while (AboutPage::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }
        
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('abouts', 'public');
        }

        AboutPage::create($data);

        return redirect()->route('admin.about.index')->with('success', 'Halaman Tentang Kami berhasil ditambahkan.');
    }

    public function editSlug($slug)
    {
        $about = AboutPage::where('slug', $slug)->first();
        
        if (!$about) {
            // Jika belum ada, kita buat instance baru yang belum tersimpan agar view edit tetap jalan
            // Namun view edit menggunakan method PUT dan ID, sehingga lebih baik kita buatkan data default
            $titles = [
                'profile-perpustakaan' => 'Profile Perpustakaan',
                'visi-misi' => 'Visi & Misi',
                'tata-tertib' => 'Tata Tertib',
                'jam-buka' => 'Jam Buka',
                'kontak' => 'Kontak',
            ];
            
            $about = AboutPage::create([
                'title_id' => $titles[$slug] ?? ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'type' => 'text',
                'order' => 1,
                'is_active' => true,
            ]);
        }
        
        return view('admin.about.edit', compact('about'));
    }

    public function edit(AboutPage $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, AboutPage $about)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:text,video,pdf,image',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'file_path' => 'nullable|mimes:pdf,mp4,webm,jpg,jpeg,png|max:51200',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['file_path', 'is_active']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            if ($about->file_path) {
                Storage::disk('public')->delete($about->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('abouts', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'Halaman Tentang Kami berhasil diperbarui.');
    }

    public function destroy(AboutPage $about)
    {
        if ($about->file_path) {
            Storage::disk('public')->delete($about->file_path);
        }
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'Halaman Tentang Kami berhasil dihapus.');
    }
}
