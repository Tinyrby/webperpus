@extends('layouts.admin')

@section('title', 'Edit Halaman Tentang Kami')
@section('page_title', 'Edit Halaman Tentang Kami')

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Form Edit Halaman</h3>
        <a href="{{ route('admin.about.index') }}" class="btn" style="background: #e2e8f0; color: #475569;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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

    <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Judul Menu (ID) <span style="color: red;">*</span></label>
            <input type="text" name="title_id" class="form-control" value="{{ old('title_id', $about->title_id) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Judul Menu (EN) <small>(Opsional)</small></label>
            <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $about->title_en) }}" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Tipe Konten <span style="color: red;">*</span></label>
            <select name="type" id="content_type" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
                <option value="text" {{ old('type', $about->type) == 'text' ? 'selected' : '' }}>Teks / HTML (Wysiwyg)</option>
                <option value="video" {{ old('type', $about->type) == 'video' ? 'selected' : '' }}>Video YouTube / MP4</option>
                <option value="pdf" {{ old('type', $about->type) == 'pdf' ? 'selected' : '' }}>File PDF</option>
                <option value="image" {{ old('type', $about->type) == 'image' ? 'selected' : '' }}>Gambar (Galeri/Struktur)</option>
            </select>
        </div>

        <div id="text_content_section" style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Isi Konten (ID)</label>
            <textarea name="content_id" class="form-control" rows="8" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">{{ old('content_id', $about->content_id) }}</textarea>
            
            <label style="display: block; font-weight: 500; margin-top: 1rem; margin-bottom: 0.5rem; color: #334155;">Isi Konten (EN)</label>
            <textarea name="content_en" class="form-control" rows="8" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">{{ old('content_en', $about->content_en) }}</textarea>
        </div>

        <div id="file_upload_section" style="margin-bottom: 1.5rem; display: none;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Upload File Baru (Abaikan jika tidak ingin mengubah)</label>
            @if($about->file_path)
                <div style="margin-bottom: 0.5rem; padding: 0.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px;">
                    <span style="color: #64748b; font-size: 0.9rem;">File saat ini: </span>
                    <a href="{{ asset('storage/' . $about->file_path) }}" target="_blank" style="color: var(--primary-color);">{{ basename($about->file_path) }}</a>
                </div>
            @endif
            <input type="file" name="file_path" accept=".pdf,.mp4,.webm,.jpg,.jpeg,.png" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; background: white;">
        </div>

        <div id="video_url_section" style="margin-bottom: 1.5rem; display: none;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Atau Gunakan URL Video YouTube</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $about->video_url) }}" placeholder="https://youtube.com/watch?v=..." style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Urutan Tampil <span style="color: red;">*</span></label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $about->order) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Status Aktif</label>
                <div style="padding-top: 0.75rem;">
                    <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $about->is_active) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        Tampilkan menu ini di web
                    </label>
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; font-size: 1rem;"><i class="fa-solid fa-save"></i> Perbarui Halaman</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('content_type');
        const textSection = document.getElementById('text_content_section');
        const fileSection = document.getElementById('file_upload_section');
        const videoUrlSection = document.getElementById('video_url_section');

        function toggleSections() {
            const val = typeSelect.value;
            textSection.style.display = 'none';
            fileSection.style.display = 'none';
            videoUrlSection.style.display = 'none';

            if (val === 'text') {
                textSection.style.display = 'block';
            } else if (val === 'video') {
                fileSection.style.display = 'block';
                videoUrlSection.style.display = 'block';
            } else if (val === 'pdf' || val === 'image') {
                fileSection.style.display = 'block';
            }
        }

        typeSelect.addEventListener('change', toggleSections);
        toggleSections(); // trigger on load
    });
</script>
@endsection
