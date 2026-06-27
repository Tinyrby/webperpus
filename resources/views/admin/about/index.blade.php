@extends('layouts.admin')

@section('title', 'Manajemen Tentang Kami')
@section('page_title', 'Manajemen Tentang Kami')

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Daftar Halaman Tentang Kami</h3>
        <a href="{{ route('admin.about.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Halaman</a>
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
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Judul Halaman</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Tipe Konten</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abouts as $about)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">{{ $about->order }}</td>
                    <td style="padding: 1rem;">
                        <strong>{{ $about->title_id }}</strong><br>
                        <small style="color: #64748b;">Slug: {{ $about->slug }}</small>
                    </td>
                    <td style="padding: 1rem;">
                        <span style="background: {{ $about->type == 'text' ? '#e0f2fe' : ($about->type == 'video' ? '#fee2e2' : '#fef3c7') }}; color: {{ $about->type == 'text' ? '#0369a1' : ($about->type == 'video' ? '#991b1b' : '#b45309') }}; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">
                            {{ strtoupper($about->type) }}
                        </span>
                    </td>
                    <td style="padding: 1rem;">
                        <span style="color: {{ $about->is_active ? '#16a34a' : '#dc2626' }};">
                            <i class="fa-solid {{ $about->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                            {{ $about->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td style="padding: 1rem; display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.about.edit', $about->id) }}" class="btn" style="background: #e2e8f0; color: #475569; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #fee2e2; color: #dc2626; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($abouts->isEmpty())
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data halaman Tentang Kami.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
