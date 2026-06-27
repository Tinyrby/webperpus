@extends('layouts.admin')

@section('title', 'Edit Data ' . $title)
@section('page_title', 'Edit Data ' . $title)

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Form Edit Data</h3>
        <a href="{{ route('admin.staff.index', ['category' => $staff->category]) }}" class="btn" style="background: #e2e8f0; color: #475569;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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

    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="category" value="{{ $staff->category }}">
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Jabatan / Bagian <span style="color: red;">*</span></label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $staff->position) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Nama Lengkap <span style="color: red;">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Foto Profil (Opsional)</label>
            @if($staff->photo)
                <div style="margin-bottom: 10px;">
                    <img src="{{ Storage::url($staff->photo) }}" alt="Foto Profil" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                </div>
            @endif
            <input type="file" name="photo" class="form-control" accept="image/*" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; background: #fff;">
            <small style="color: #64748b;">Format JPG, JPEG, PNG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah foto saat ini.</small>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Urutan Tampil <span style="color: red;">*</span></label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $staff->order) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; font-size: 1rem;"><i class="fa-solid fa-save"></i> Perbarui Data</button>
        </div>
    </form>
</div>
@endsection
