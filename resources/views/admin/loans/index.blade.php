@extends('layouts.admin')

@section('title', 'Data Pinjaman')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Data Pinjaman Buku</h2>
    <a href="{{ route('admin.loans.create') }}" class="btn-primary" style="background-color: var(--primary-color); color: white; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem;"><i class="fa-solid fa-plus"></i> Tambah Data</a>
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
                    <th style="padding: 1rem;">NIM</th>
                    <th style="padding: 1rem;">Nama Mahasiswa</th>
                    <th style="padding: 1rem;">Judul Buku</th>
                    <th style="padding: 1rem;">Tgl Pinjam</th>
                    <th style="padding: 1rem;">Tgl Kembali</th>
                    <th style="padding: 1rem;">Status</th>
                    <th style="padding: 1rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem;">{{ $loan->member ? $loan->member->nim : 'Dihapus' }}</td>
                    <td style="padding: 1rem;">{{ $loan->member ? $loan->member->name : 'Anggota Dihapus' }}</td>
                    <td style="padding: 1rem;">{{ $loan->book ? $loan->book->title : 'Buku Dihapus' }}</td>
                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}</td>
                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</td>
                    <td style="padding: 1rem;">
                        @if($loan->status == 'Dipinjam')
                            <span style="background-color: #fef3c7; color: #d97706; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">{{ $loan->status }}</span>
                        @else
                            <span style="background-color: #dcfce7; color: #16a34a; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">{{ $loan->status }}</span>
                        @endif
                    </td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('admin.loans.edit', $loan) }}" style="color: #3b82f6; margin-right: 10px;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.loans.destroy', $loan) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data pinjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
