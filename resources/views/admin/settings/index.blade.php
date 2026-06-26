@extends('layouts.admin')

@section('title', 'Pengaturan Web')
@section('page_title', 'Pengaturan Web')

@section('content')
<div class="admin-panel" style="max-width: 600px;">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Pengaturan Halaman Utama</h3>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="hero_image">Gambar Latar Hero (Judul & Pencarian)</label>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 10px;">Gambar yang akan muncul di belakang judul "Perpustakaan UNG" di halaman utama.</p>
            <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/*">
            @error('hero_image') <small style="color: red;">{{ $message }}</small> @enderror
            
            <div style="margin-top: 15px;">
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 5px;">Gambar Saat Ini:</p>
                @php
                    $heroImage = \App\Models\Setting::where('key', 'hero_image')->first();
                @endphp
                
                @if($heroImage && $heroImage->value)
                    <img src="{{ asset('storage/' . $heroImage->value) }}" alt="Hero Background" style="height: 150px; width: 100%; object-fit: cover; border-radius: 5px;">
                @else
                    <div style="height: 150px; width: 100%; background: #eee; border-radius: 5px; display:flex; align-items:center; justify-content:center; color: #999;">
                        Menggunakan Gambar Default (Bawaan)
                    </div>
                @endif
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </div>
    </form>
</div>
@endsection
