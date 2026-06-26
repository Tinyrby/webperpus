@extends('layouts.admin')

@section('title', 'Tambah Anggota')

@section('content')
<div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.members.index') }}" style="color: #64748b; margin-right: 15px; text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <h2 style="margin: 0; color: #1e293b;">Tambah Data Anggota</h2>
</div>

<div class="card" style="max-width: 600px;">
    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.members.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">NIM <span style="color: red;">*</span></label>
            <input type="text" name="nim" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('nim') }}" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Nama Lengkap <span style="color: red;">*</span></label>
            <input type="text" name="name" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('name') }}" required>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Fakultas</label>
                <input type="text" name="faculty" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('faculty') }}">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Program Studi</label>
                <input type="text" name="study_program" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('study_program') }}">
            </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Email</label>
                <input type="email" name="email" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('email') }}">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">No. Telepon / WA</label>
                <input type="text" name="phone" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('phone') }}">
            </div>
        </div>

        <div>
            <button type="submit" style="background-color: var(--primary-color); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; cursor: pointer;">Simpan Anggota</button>
        </div>
    </form>
</div>
@endsection
