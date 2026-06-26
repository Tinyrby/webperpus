@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="container" style="max-width: 800px; margin: 4rem auto; padding: 2rem;">
    <h2 style="text-align: center; color: var(--primary-color); margin-bottom: 2rem; font-size: 2rem;">Cek Pinjaman</h2>
    
    <div style="display: flex; justify-content: center; margin-bottom: 3rem;">
        <form action="{{ route('cek-pinjaman') }}" method="GET" style="display: flex; width: 100%; max-width: 500px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
            <input type="text" name="nim" value="{{ request('nim') }}" placeholder="Masukkan NIM" style="flex: 1; padding: 1rem 1.5rem; border: none; outline: none; font-size: 1rem; font-family: inherit;">
            <button type="submit" style="background-color: #0052cc; color: white; border: none; padding: 0 2rem; font-weight: 600; cursor: pointer; transition: background-color 0.3s;">Cari</button>
        </form>
    </div>

    @if($nim)
        @if($loans && $loans->count() > 0)
            <div style="background: white; border-radius: var(--radius-lg); box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f1f5f9;">
                <div style="padding: 1.5rem; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h3 style="margin: 0; color: var(--primary-color); font-size: 1.2rem;">
                        Data Pinjaman: <span style="color: var(--text-main);">{{ $loans->first()->member ? $loans->first()->member->name : 'Anggota Tidak Diketahui' }} ({{ $nim }})</span>
                    </h3>
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f1f5f9; text-align: left;">
                                <th style="padding: 1rem 1.5rem; color: #475569; font-weight: 600;">Judul Buku</th>
                                <th style="padding: 1rem 1.5rem; color: #475569; font-weight: 600;">Tgl Pinjam</th>
                                <th style="padding: 1rem 1.5rem; color: #475569; font-weight: 600;">Tgl Kembali</th>
                                <th style="padding: 1rem 1.5rem; color: #475569; font-weight: 600;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr style="border-top: 1px solid #e2e8f0;">
                                <td style="padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                    @if($loan->book && $loan->book->cover_image)
                                        <img src="{{ asset('storage/' . $loan->book->cover_image) }}" alt="Cover" style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                                    @else
                                        <div style="width: 50px; height: 70px; background-color: #f1f5f9; border-radius: 4px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.7rem;">No Img</div>
                                    @endif
                                    <div>
                                        <div style="font-weight: 600; color: #0f172a;">{{ $loan->book ? $loan->book->title : 'Buku Dihapus' }}</div>
                                        <div style="font-size: 0.85rem; color: #64748b;">{{ $loan->book ? $loan->book->author : '' }}</div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</td>
                                <td style="padding: 1rem 1.5rem;">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    @if($loan->status == 'Dipinjam')
                                        <span style="background-color: #fef3c7; color: #d97706; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">{{ $loan->status }}</span>
                                    @else
                                        <span style="background-color: #dcfce7; color: #16a34a; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">{{ $loan->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 3rem; background: #fff; border-radius: var(--radius-lg); box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                <p style="color: #64748b; font-size: 1.1rem; margin: 0;">Data pinjaman tidak ditemukan</p>
            </div>
        @endif
    @endif
</div>
@endsection
