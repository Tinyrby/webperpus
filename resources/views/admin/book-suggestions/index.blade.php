@extends('layouts.admin')

@section('title', 'Usulan Buku Baru')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Daftar Usulan Buku Baru</h2>
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
                    <th style="padding: 1rem;">Tanggal</th>
                    <th style="padding: 1rem;">Pengusul</th>
                    <th style="padding: 1rem;">Judul Buku</th>
                    <th style="padding: 1rem;">Detail Buku</th>
                    <th style="padding: 1rem;">Keterangan</th>
                    <th style="padding: 1rem; width: 60px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suggestions as $suggestion)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem; color: #64748b;">{{ \Carbon\Carbon::parse($suggestion->created_at)->format('d M Y') }}</td>
                    <td style="padding: 1rem;">
                        <div style="font-weight: 500; color: #0f172a;">{{ $suggestion->name }}</div>
                        <div style="font-size: 0.85rem; color: #64748b;"><i class="fa-regular fa-envelope"></i> {{ $suggestion->email }}</div>
                    </td>
                    <td style="padding: 1rem; font-weight: 600; color: var(--primary-color);">{{ $suggestion->title }}</td>
                    <td style="padding: 1rem; color: #475569; font-size: 0.9rem;">
                        @if($suggestion->author) <div><strong>Pengarang:</strong> {{ $suggestion->author }}</div> @endif
                        @if($suggestion->publisher) <div><strong>Penerbit:</strong> {{ $suggestion->publisher }}</div> @endif
                        @if($suggestion->isbn) <div><strong>ISBN:</strong> {{ $suggestion->isbn }}</div> @endif
                    </td>
                    <td style="padding: 1rem; color: #475569; font-size: 0.9rem; max-width: 250px;">
                        {{ $suggestion->notes ?? '-' }}
                    </td>
                    <td style="padding: 1rem; text-align: center;">
                        <form action="{{ route('admin.book-suggestions.destroy', $suggestion) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus usulan buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus Usulan"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 3rem; text-align: center; color: #64748b;">Belum ada usulan buku baru dari pengunjung.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
