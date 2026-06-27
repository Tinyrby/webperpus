@extends('layouts.admin')

@section('title', 'Manajemen ' . $title)
@section('page_title', 'Manajemen ' . $title)

@section('content')
<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Daftar {{ $title }}</h3>
        <a href="{{ route('admin.staff.create', ['category' => $category]) }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Data</a>
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
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Nama Lengkap</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Jabatan</th>
                    <th style="padding: 1rem; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">{{ $staff->order }}</td>
                    <td style="padding: 1rem; display: flex; align-items: center; gap: 12px;">
                        @if($staff->photo)
                            <img src="{{ Storage::url($staff->photo) }}" alt="{{ $staff->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b;"><i class="fa-solid fa-user"></i></div>
                        @endif
                        <strong>{!! nl2br(e($staff->name)) !!}</strong>
                    </td>
                    <td style="padding: 1rem;">{{ $staff->position }}</td>
                    <td style="padding: 1rem; display: flex; gap: 0.5rem;">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn" style="background: #e2e8f0; color: #475569; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #fee2e2; color: #dc2626; padding: 0.5rem 0.75rem;"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($staffs->isEmpty())
                <tr>
                    <td colspan="4" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
