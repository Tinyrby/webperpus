@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')
@section('page_title', 'Tambah Fasilitas')

@section('content')
<div class="admin-panel" style="max-width: 600px;">
    <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Nama Fasilitas</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Deskripsi Fasilitas</label>
            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
            @error('description') <small style="color: red;">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="image">Gambar Fasilitas</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            @error('image') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.facilities.index') }}" class="btn" style="background: #e5e7eb; margin-left: 10px;">Batal</a>
        </div>
    </form>
</div>
@endsection
