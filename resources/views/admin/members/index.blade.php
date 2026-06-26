@extends('layouts.admin')

@section('title', 'Data Keanggotaan')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Data Keanggotaan</h2>
    <a href="{{ route('admin.members.create') }}" class="btn-primary" style="background-color: var(--primary-color); color: white; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem;"><i class="fa-solid fa-plus"></i> Tambah Anggota</a>
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
                    <th style="padding: 1rem;">Nama Lengkap</th>
                    <th style="padding: 1rem;">Fakultas / Prodi</th>
                    <th style="padding: 1rem;">Kontak</th>
                    <th style="padding: 1rem; width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem; font-weight: 500; color: #0f172a;">{{ $member->nim }}</td>
                    <td style="padding: 1rem;">{{ $member->name }}</td>
                    <td style="padding: 1rem; color: #475569;">
                        {{ $member->faculty ?? '-' }}<br>
                        <span style="font-size: 0.85rem; color: #64748b;">{{ $member->study_program ?? '-' }}</span>
                    </td>
                    <td style="padding: 1rem; color: #475569;">
                        @if($member->email) <div><i class="fa-regular fa-envelope"></i> {{ $member->email }}</div> @endif
                        @if($member->phone) <div><i class="fa-solid fa-phone"></i> {{ $member->phone }}</div> @endif
                    </td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('admin.members.edit', $member) }}" style="color: #3b82f6; margin-right: 10px;" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('admin.members.destroy', $member) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: #64748b;">Belum ada data keanggotaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
