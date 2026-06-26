<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('hero_image')) {
            $setting = Setting::firstOrCreate(['key' => 'hero_image']);
            
            if ($setting->value) {
                Storage::disk('public')->delete($setting->value);
            }
            
            $path = $request->file('hero_image')->store('settings', 'public');
            $setting->update(['value' => $path]);
            
            return back()->with('success', 'Gambar latar hero berhasil diperbarui.');
        }

        return back()->with('success', 'Tidak ada perubahan yang dilakukan.');
    }
}
