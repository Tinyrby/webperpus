@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="bg-decorative" style="min-height: calc(100vh - 100px); display: flex; flex-direction: column; justify-content: center; position: relative;">
    <i class="fa-solid fa-book-open bg-graphic bg-graphic-tl"></i>
    <i class="fa-solid fa-graduation-cap bg-graphic bg-graphic-tr"></i>
    <i class="fa-solid fa-microscope bg-graphic bg-graphic-bl"></i>
    <i class="fa-solid fa-award bg-graphic bg-graphic-br"></i>
    <div class="container content-relative" style="max-width: 800px; margin: 0 auto; padding: 2rem;">
        
    <h2 style="text-align: center; color: var(--primary-color); margin-bottom: 0.5rem; font-size: 2rem;">Cek Pinjaman</h2>
    <p style="text-align: center; color: var(--text-muted); margin-bottom: 2rem; font-size: 1rem;">
        Masukkan NIM Anda untuk melihat status peminjaman buku.
    </p>
    
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 3rem;">
        <form action="{{ route('cek-pinjaman') }}" method="GET" class="search-container" style="width: 100%; max-width: 600px; margin: 0; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <input type="text" name="nim" value="{{ request('nim') }}" class="search-input" placeholder="Masukkan NIM Anda...">
            <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Cek</button>
        </form>
        
        <div style="display: flex; gap: 1rem; margin-top: 1.5rem; flex-wrap: wrap; justify-content: center;">
            <a href="{{ route('usulan-buku.index') }}" style="background: white; border: 1px solid #e2e8f0; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.85rem; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.02);" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.color='var(--primary-color)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#64748b';">
                <i class="fa-solid fa-lightbulb"></i> Usulkan Buku Baru
            </a>
            <a href="{{ route('katalog.search') }}" style="background: white; border: 1px solid #e2e8f0; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.85rem; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.02);" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.color='var(--primary-color)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#64748b';">
                <i class="fa-solid fa-book-open"></i> Lihat Katalog
            </a>
            <a href="{{ route('katalog.information') }}" style="background: white; border: 1px solid #e2e8f0; padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.85rem; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.02);" onmouseover="this.style.borderColor='var(--primary-color)'; this.style.color='var(--primary-color)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#64748b';">
                <i class="fa-solid fa-clock"></i> Jam Layanan
            </a>
        </div>
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
</div>
@endsection
