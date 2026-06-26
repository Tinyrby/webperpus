@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')
<div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.books.index') }}" style="color: #64748b; margin-right: 15px; text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <h2 style="margin: 0; color: #1e293b;">Tambah Data Buku</h2>
</div>

@if ($errors->any())
    <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: start;">
        
        <!-- Kolom Kiri: Info Utama & Tambahan -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- Info Utama -->
            <div class="card">
                <h3 style="margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; color: #334155; font-size: 1.1rem;">Informasi Utama</h3>
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Judul Buku <span style="color: red;">*</span></label>
                    <input type="text" name="title" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('title') }}" required>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Penulis / Pengarang</label>
                        <input type="text" name="author" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('author') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Pernyataan Tanggungjawab</label>
                        <input type="text" name="statement_of_responsibility" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('statement_of_responsibility') }}">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Penerbit</label>
                        <input type="text" name="publisher" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('publisher') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tahun Terbit</label>
                        <input type="text" name="publication_year" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('publication_year') }}" placeholder="Contoh: 2023">
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Deskripsi / Sinopsis</label>
                    <textarea name="description" class="form-control" rows="4" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Info Detail -->
            <div class="card">
                <h3 style="margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; color: #334155; font-size: 1.1rem;">Informasi Detail Tambahan</h3>
                
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Judul Seri</label>
                        <input type="text" name="series_title" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('series_title') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">No. Panggil</label>
                        <input type="text" name="call_number" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('call_number') }}">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">ISBN / ISSN</label>
                        <input type="text" name="isbn" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('isbn') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Bahasa</label>
                        <input type="text" name="language" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('language') }}" placeholder="Contoh: Indonesia">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Klasifikasi</label>
                        <input type="text" name="classification" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('classification') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Kategori / Subjek <span style="color: red;">*</span></label>
                        <select name="category_id" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tipe Isi</label>
                        <input type="text" name="content_type" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('content_type') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tipe Media</label>
                        <input type="text" name="media_type" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('media_type') }}">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tipe Pembawa</label>
                        <input type="text" name="carrier_type" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('carrier_type') }}">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Edisi</label>
                        <input type="text" name="edition" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('edition') }}">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Deskripsi Fisik</label>
                        <input type="text" name="physical_description" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('physical_description') }}" placeholder="Contoh: x, 254 hal, 23cm">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Info Detail Spesifik</label>
                        <input type="text" name="specific_detail_info" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('specific_detail_info') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Cover, Ketersediaan & Submit -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div class="card">
                <h3 style="margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; color: #334155; font-size: 1.1rem;">Media & Ketersediaan</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Cover Buku (Gambar)</label>
                    <input type="file" name="cover_image" class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 4px; background-color: #f8fafc;" accept="image/*">
                    <small style="color: #64748b; margin-top: 5px; display: block;">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                </div>

                <div style="margin-bottom: 1.5rem; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 6px; background-color: #f8fafc;">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_available" value="1" style="width: 18px; height: 18px; margin-right: 10px;" {{ old('is_available', true) ? 'checked' : '' }}>
                        <span style="font-weight: 500; color: #475569;">Tersedia (Dapat Dipinjam)</span>
                    </label>
                    <small style="color: #64748b; margin-top: 5px; display: block; margin-left: 28px;">Hapus centang jika buku sedang hilang atau tidak dapat dipinjam.</small>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" style="width: 100%; background-color: var(--primary-color); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data Buku
                    </button>
                </div>
            </div>

        </div>

    </div>
</form>
@endsection
