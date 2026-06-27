@extends('layouts.admin')

@section('title', 'Tambah Data ' . $title)
@section('page_title', 'Tambah Data ' . $title)

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Form Tambah Data</h3>
        <a href="{{ route('admin.staff.index', ['category' => $category]) }}" class="btn" style="background: #e2e8f0; color: #475569;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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

    <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="category" value="{{ $category }}">
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Jabatan / Bagian <span style="color: red;">*</span></label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;" placeholder="Contoh: Bagian Referensi / Tesis / Disertasi">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Daftar Anggota <span style="color: red;">*</span></label>
            <div id="members-container">
                <div class="member-item" style="display: flex; gap: 15px; margin-bottom: 15px; align-items: flex-start; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div style="flex: 1;">
                        <input type="text" name="names[]" class="form-control" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; margin-bottom: 10px;" placeholder="Nama Lengkap (Contoh: Yustin Mastin Otaya, S.Sos)">
                        <input type="file" name="photos[]" class="form-control" accept="image/*" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px; background: #fff;" title="Foto Profil (Opsional)">
                        <small style="color: #64748b;">Foto Profil (Opsional, Format JPG/PNG, Maks 5MB).</small>
                    </div>
                    <button type="button" class="btn remove-member-btn" style="background: #fee2e2; color: #dc2626; padding: 0.75rem; border: none; border-radius: 4px; cursor: pointer; display: none;" onclick="this.parentElement.remove(); checkRemoveButtons();"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <button type="button" id="add-member-btn" class="btn" style="background: #e0f2fe; color: #0284c7; border: 1px dashed #0284c7; width: 100%; padding: 10px; border-radius: 6px; cursor: pointer;"><i class="fa-solid fa-plus"></i> Tambah Anggota</button>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #334155;">Urutan Tampil Jabatan <span style="color: red;">*</span></label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;">
            <small style="color: #64748b;">Angka yang lebih kecil akan membuat kelompok jabatan ini tampil lebih dulu.</small>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem; font-size: 1rem;"><i class="fa-solid fa-save"></i> Simpan Data</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-member-btn').addEventListener('click', function() {
        const container = document.getElementById('members-container');
        const newItem = container.children[0].cloneNode(true);
        
        // Reset values
        newItem.querySelector('input[type="text"]').value = '';
        newItem.querySelector('input[type="file"]').value = '';
        
        container.appendChild(newItem);
        checkRemoveButtons();
    });

    function checkRemoveButtons() {
        const items = document.querySelectorAll('.member-item');
        items.forEach((item, index) => {
            const btn = item.querySelector('.remove-member-btn');
            if (items.length > 1) {
                btn.style.display = 'block';
            } else {
                btn.style.display = 'none';
            }
        });
    }
</script>
@endsection
