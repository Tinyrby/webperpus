@extends('layouts.admin')

@section('title', 'Manajemen Panduan')
@section('page_title', 'Manajemen Panduan')

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Daftar Panduan</h3>
        <a href="{{ route('admin.guidelines.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Panduan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem; background: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f1f5f9; color: #475569; font-size: 0.9rem; text-transform: uppercase;">
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Urutan</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Judul (ID)</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Tipe</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guidelines as $guideline)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">{{ $guideline->order }}</td>
                    <td style="padding: 1rem;">
                        <strong>{{ $guideline->title_id }}</strong><br>
                        <small style="color: #64748b;">Slug: {{ $guideline->slug }}</small>
                    </td>
                    <td style="padding: 1rem;">
                        <span style="background: {{ $guideline->type == 'pdf' ? '#e0f2fe' : '#fee2e2' }}; color: {{ $guideline->type == 'pdf' ? '#0369a1' : '#991b1b' }}; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">
                            {{ strtoupper($guideline->type) }}
                        </span>
                    </td>
                    <td style="padding: 1rem;">
                        <span style="color: {{ $guideline->is_active ? '#16a34a' : '#dc2626' }};">
                            <i class="fa-solid {{ $guideline->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                            {{ $guideline->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td style="padding: 1rem; display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.guidelines.edit', $guideline->id) }}" class="btn" style="background: #e2e8f0; color: #475569; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.guidelines.destroy', $guideline->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus panduan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #fee2e2; color: #dc2626; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($guidelines->isEmpty())
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data panduan.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
