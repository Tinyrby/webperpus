@extends('layouts.admin')

@section('title', 'Katalog Buku')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Katalog Buku</h2>
    <a href="{{ route('admin.books.create') }}" class="btn-primary" style="background-color: var(--primary-color); color: white; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem;"><i class="fa-solid fa-plus"></i> Tambah Buku</a>
</div>

@if(session('success'))
    <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div style="overflow-x: auto;">
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0; text-align: left;">
                    <th style="padding: 1rem; width: 80px;">Cover</th>
                    <th style="padding: 1rem;">Judul Buku</th>
                    <th style="padding: 1rem;">Penulis</th>
                    <th style="padding: 1rem;">Penerbit (Tahun)</th>
                    <th style="padding: 1rem;">ISBN</th>
                    <th style="padding: 1rem; width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" style="width: 60px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                        @else
                            <div style="width: 60px; height: 80px; background-color: #f1f5f9; border-radius: 4px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.8rem;">No Img</div>
                        @endif
                    </td>
                    <td style="padding: 1rem; font-weight: 500; color: #0f172a;">{{ $book->title }}</td>
                    <td style="padding: 1rem; color: #475569;">{{ $book->author ?? '-' }}</td>
                    <td style="padding: 1rem; color: #475569;">
                        {{ $book->publisher ?? '-' }} 
                        @if($book->publication_year) ({{ $book->publication_year }}) @endif
                    </td>
                    <td style="padding: 1rem; color: #475569;">{{ $book->isbn ?? '-' }}</td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('admin.books.edit', $book) }}" style="color: #3b82f6; margin-right: 10px;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
