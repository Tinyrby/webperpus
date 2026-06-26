@extends('layouts.admin')

@section('title', 'Saran & Masukan')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0; color: #1e293b;">Daftar Saran & Masukan</h2>
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
                    <th style="padding: 1rem; width: 150px;">Tanggal</th>
                    <th style="padding: 1rem; width: 250px;">Pengirim</th>
                    <th style="padding: 1rem;">Isi Pesan</th>
                    <th style="padding: 1rem; width: 60px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 1rem; color: #64748b;">{{ \Carbon\Carbon::parse($feedback->created_at)->format('d M Y H:i') }}</td>
                    <td style="padding: 1rem;">
                        <div style="font-weight: 500; color: #0f172a;">{{ $feedback->name }}</div>
                        <div style="font-size: 0.85rem; color: #64748b;"><i class="fa-regular fa-envelope"></i> {{ $feedback->email }}</div>
                    </td>
                    <td style="padding: 1rem; color: #475569; font-size: 0.95rem; line-height: 1.5;">
                        {{ $feedback->message }}
                    </td>
                    <td style="padding: 1rem; text-align: center;">
                        <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;" title="Hapus Pesan"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 3rem; text-align: center; color: #64748b;">Belum ada saran atau masukan dari pengunjung.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
