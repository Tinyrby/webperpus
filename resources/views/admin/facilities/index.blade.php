@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')
@section('page_title', 'Manajemen Fasilitas')

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Daftar Fasilitas</h3>
        <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Fasilitas</a>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid rgba(0,0,0,0.05); color: var(--text-muted);">
                <th style="padding: 1rem 0.5rem; font-weight: 500;">Gambar</th>
                <th style="padding: 1rem 0.5rem; font-weight: 500;">Nama Fasilitas</th>
                <th style="padding: 1rem 0.5rem; font-weight: 500; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facilities as $facility)
            <tr style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                <td style="padding: 1rem 0.5rem;">
                    @if($facility->image_path)
                        <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->name }}" style="height: 60px; width: 80px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div style="height: 60px; width: 80px; background: #eee; border-radius: 5px; display:flex; align-items:center; justify-content:center; color: #999;">No Image</div>
                    @endif
                </td>
                <td style="padding: 1rem 0.5rem; font-weight: 500;">{{ $facility->name }}</td>
                <td style="padding: 1rem 0.5rem; text-align: right;">
                    <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-sm" style="background: var(--primary-light); color: white;"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="padding: 2rem; text-align: center; color: var(--text-muted);">Belum ada data fasilitas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
