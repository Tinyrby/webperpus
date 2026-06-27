@extends('layouts.admin')

@section('title', 'Tambah Panduan')
@section('page_title', 'Tambah Panduan')

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Form Tambah Panduan</h3>
        <a href="{{ route('admin.guidelines.index') }}" class="btn" style="background: #e2e8f0; color: #475569;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 1.5rem; background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.guidelines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Judul Panduan (ID) <span style="color: red;">*</span></label>
            <input type="text" name="title_id" class="form-control" value="{{ old('title_id') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            <small style="color: #64748b;">Contoh: Buku Panduan Perpustakaan</small>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Judul Panduan (EN) <small>(Opsional)</small></label>
            <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            <small style="color: #64748b;">Contoh: Library Guidebook</small>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Tipe Dokumen <span style="color: red;">*</span></label>
            <select name="type" id="doc_type" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>File PDF</option>
                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video YouTube</option>
            </select>
        </div>

        <div id="pdf_upload_section" style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Upload File (PDF / MP4)</label>
            <input type="file" name="file_path" accept=".pdf,.mp4,.webm" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; background: white;">
            <small style="color: #64748b;">Maksimal ukuran file: PDF (10MB), Video (50MB).</small>
        </div>

        <div id="video_url_section" style="margin-bottom: 1.5rem; display: none;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Atau Gunakan URL Video YouTube</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=..." style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            <small style="color: #64748b;">Gunakan URL lengkap video YouTube (jika tidak mengupload file).</small>
        </div>

        <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Urutan Tampil <span style="color: red;">*</span></label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                <small style="color: #64748b;">Angka yang lebih kecil akan tampil lebih dulu.</small>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Status Aktif</label>
                <div style="padding-top: 0.75rem;">
                    <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        Tampilkan panduan ini di web
                    </label>
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; font-size: 1rem;"><i class="fa-solid fa-save"></i> Simpan Panduan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('doc_type');
        const pdfSection = document.getElementById('pdf_upload_section');
        const videoSection = document.getElementById('video_url_section');

        function toggleSections() {
            if (typeSelect.value === 'pdf') {
                pdfSection.style.display = 'block';
                videoSection.style.display = 'none';
            } else {
                pdfSection.style.display = 'block'; // Allow file upload for video too
                videoSection.style.display = 'block';
            }
        }

        typeSelect.addEventListener('change', toggleSections);
        toggleSections(); // trigger on load
    });
</script>
@endsection
