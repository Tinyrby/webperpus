<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class AdminStaffController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'struktur_organisasi');
        $staffs = Staff::where('category', $category)->orderBy('order', 'asc')->get();
        
        $title = $category == 'struktur_organisasi' ? 'Struktur Organisasi' : 'Staff Perpustakaan';
        
        return view('admin.staff.index', compact('staffs', 'category', 'title'));
    }

    public function create(Request $request)
    {
        $category = $request->query('category', 'struktur_organisasi');
        $title = $category == 'struktur_organisasi' ? 'Struktur Organisasi' : 'Staff Perpustakaan';
        
        return view('admin.staff.create', compact('category', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'names' => 'required|array|min:1',
            'names.*' => 'required|string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'category' => 'required|in:struktur_organisasi,staff_perpustakaan',
            'order' => 'required|integer',
        ]);

        foreach ($request->names as $index => $name) {
            $photoPath = null;
            if ($request->hasFile("photos.$index")) {
                $photoPath = $request->file("photos.$index")->store('staff_photos', 'public');
            }

            Staff::create([
                'name' => $name,
                'position' => $request->position,
                'category' => $request->category,
                'order' => $request->order,
                'photo' => $photoPath,
            ]);
        }

        return redirect()->route('admin.staff.index', ['category' => $request->category])
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        $title = $staff->category == 'struktur_organisasi' ? 'Struktur Organisasi' : 'Staff Perpustakaan';
        return view('admin.staff.edit', compact('staff', 'title'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'category' => 'required|in:struktur_organisasi,staff_perpustakaan',
            'order' => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($staff->photo);
            }
            $data['photo'] = $request->file('photo')->store('staff_photos', 'public');
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index', ['category' => $staff->category])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($staff->photo);
        }
        $category = $staff->category;
        $staff->delete();

        return redirect()->route('admin.staff.index', ['category' => $category])
            ->with('success', 'Data berhasil dihapus.');
    }
}
