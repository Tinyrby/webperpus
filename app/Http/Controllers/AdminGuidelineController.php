<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guideline;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminGuidelineController extends Controller
{
    public function index()
    {
        $guidelines = Guideline::orderBy('order', 'asc')->get();
        return view('admin.guidelines.index', compact('guidelines'));
    }

    public function create()
    {
        return view('admin.guidelines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:pdf,video',
            'file_path' => 'nullable|mimes:pdf,mp4,webm|max:51200',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['file_path', 'is_active']);
        $data['slug'] = Str::slug($request->title_id) . '-' . time();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('guidelines', 'public');
        }

        Guideline::create($data);

        return redirect()->route('admin.guidelines.index')->with('success', 'Panduan berhasil ditambahkan.');
    }

    public function edit(Guideline $guideline)
    {
        return view('admin.guidelines.edit', compact('guideline'));
    }

    public function update(Request $request, Guideline $guideline)
    {
        $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:pdf,video',
            'file_path' => 'nullable|mimes:pdf,mp4,webm|max:51200',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['file_path', 'is_active']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            if ($guideline->file_path) {
                Storage::disk('public')->delete($guideline->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('guidelines', 'public');
        }

        $guideline->update($data);

        return redirect()->route('admin.guidelines.index')->with('success', 'Panduan berhasil diperbarui.');
    }

    public function destroy(Guideline $guideline)
    {
        if ($guideline->file_path) {
            Storage::disk('public')->delete($guideline->file_path);
        }
        $guideline->delete();

        return redirect()->route('admin.guidelines.index')->with('success', 'Panduan berhasil dihapus.');
    }
}
