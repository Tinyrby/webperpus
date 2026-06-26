@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')
<div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.books.index') }}" style="color: #64748b; margin-right: 15px; text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <h2 style="margin: 0; color: #1e293b;">Edit Data Buku</h2>
</div>

<div class="card" style="max-width: 800px;">
    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Judul Buku <span style="color: red;">*</span></label>
            <input type="text" name="title" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('title', $book->title) }}" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Penulis</label>
                <input type="text" name="author" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('author', $book->author) }}">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Penerbit</label>
                <input type="text" name="publisher" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('publisher', $book->publisher) }}">
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tahun Terbit</label>
                <input type="text" name="publication_year" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px; max-width: 150px;" value="{{ old('publication_year', $book->publication_year) }}" placeholder="Contoh: 2023">
            </div>
            <div style="flex: 2;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">ISBN</label>
                <input type="text" name="isbn" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('isbn', $book->isbn) }}">
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Cover Buku (Gambar)</label>
            @if($book->cover_image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Cover" style="width: 100px; border-radius: 4px; border: 1px solid #cbd5e1;">
                </div>
            @endif
            <input type="file" name="cover_image" class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; background-color: #f8fafc;" accept="image/*">
            <small style="color: #64748b; margin-top: 5px; display: block;">Biarkan kosong jika tidak ingin mengubah cover. Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Deskripsi / Sinopsis</label>
            <textarea name="description" class="form-control" rows="4" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">{{ old('description', $book->description) }}</textarea>
        </div>

        <div>
            <button type="submit" style="background-color: var(--primary-color); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; cursor: pointer;">Update Buku</button>
        </div>
    </form>
</div>
@endsection
