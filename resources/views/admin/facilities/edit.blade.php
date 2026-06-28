@extends('layouts.admin')

@section('title', 'Ubah Fasilitas')
@section('page_title', 'Ubah Fasilitas')

@section('content')
<div class="admin-panel" style="max-width: 600px;">
    <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="name">Nama Fasilitas</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $facility->name) }}">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Deskripsi Fasilitas</label>
            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $facility->description) }}</textarea>
            @error('description') <small style="color: red;">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="image">Gambar Fasilitas (Kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image') <small style="color: red;">{{ $message }}</small> @enderror
            
            @if($facility->image_path)
                <div style="margin-top: 10px;">
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 5px;">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->name }}" style="height: 100px; border-radius: 5px;">
                </div>
            @endif
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.facilities.index') }}" class="btn" style="background: #e5e7eb; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>
@endsection
