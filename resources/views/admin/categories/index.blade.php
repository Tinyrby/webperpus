@extends('layouts.admin')

@section('title', 'Kategori / Subjek')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Kategori / Subjek Buku</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary" style="background-color: var(--primary-color); color: white; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem;"><i class="fa-solid fa-plus"></i> Tambah Kategori</a>
</div>

@if(session('success'))
    <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0; text-align: left;">
                    <th style="padding: 1rem; width: 60px;">No</th>
                    <th style="padding: 1rem;">Ikon</th>
                    <th style="padding: 1rem;">Nama Kategori / Subjek</th>
                    <th style="padding: 1rem;">Jumlah Buku</th>
                    <th style="padding: 1rem; width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem; color: #64748b;">{{ $loop->iteration }}</td>
                    <td style="padding: 1rem; font-size: 1.5rem;">{{ $category->icon ?? '-' }}</td>
                    <td style="padding: 1rem; font-weight: 500; color: #0f172a;">{{ $category->name }}</td>
                    <td style="padding: 1rem; color: #475569;">
                        <span style="background: #f1f5f9; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;">
                            {{ $category->books_count ?? 0 }} Koleksi
                        </span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('admin.categories.edit', $category) }}" style="color: #3b82f6; margin-right: 10px;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
