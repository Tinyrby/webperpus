@extends('layouts.catalog')

@section('title', $book->title . ' - Katalog Online')

@section('content')
<!-- Small Hero Section -->
<section class="catalog-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover no-repeat; padding: 120px 20px 40px; text-align: center; position: relative;">
    <div style="max-width: 800px; margin: 0 auto; position: relative; z-index: 10;">
        <form action="{{ route('katalog.search') }}" method="GET" style="display: flex; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-radius: 8px; overflow: hidden; margin-top: 2rem;">
            <input type="text" name="keyword" placeholder="Masukkan kata kunci untuk mencari koleksi..." style="flex: 1; padding: 1.2rem 1.5rem; border: none; font-size: 1.1rem; outline: none;">
            <button type="submit" style="padding: 0 2rem; background: white; border: none; border-left: 1px solid #e2e8f0; cursor: pointer; color: #64748b; font-size: 1.2rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>

<!-- Detail Content -->
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 3rem 20px;">
    
    <div style="display: flex; flex-wrap: wrap; gap: 3rem;">
        
        <!-- Left: Cover -->
        <div style="width: 300px; flex-shrink: 0;">
            <div style="background: #e2e8f0; padding: 2rem; border-radius: 8px; display: flex; justify-content: center; align-items: center; min-height: 400px;">
                @if($book->cover_image)
                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; max-width: 250px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); border-radius: 4px;">
                @else
                    <i class="fa-solid fa-book" style="font-size: 8rem; color: #94a3b8;"></i>
                @endif
            </div>
        </div>

        <!-- Right: Info -->
        <div style="flex: 1; min-width: 300px;">
            <div style="margin-bottom: 2rem;">
                <span style="display: inline-block; color: #16a34a; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;"><i class="fa-solid fa-bookmark"></i> Buku</span>
                <h1 style="margin: 0 0 0.5rem; color: #0f172a; font-size: 2rem; font-weight: 600;">{{ $book->title }}</h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">
                    — <span style="color: #3b82f6;">{{ $book->author ?? 'Pengarang Tidak Diketahui' }}</span> - Nama Orang;
                </p>
                <div style="width: 100%; height: 1px; background: #e2e8f0; margin-bottom: 1.5rem;"></div>
                
                <p style="color: #475569; font-size: 0.95rem; line-height: 1.6;">
                    {{ $book->description ?? 'Tidak ada deskripsi tersedia untuk buku ini.' }}
                </p>
            </div>

            <!-- Ketersediaan -->
            <div style="margin-bottom: 3rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1rem; font-weight: 600;">Ketersediaan</h3>
                <div>
                    @if($book->is_available)
                        <span style="background: #38bdf8; color: white; padding: 0.4rem 1.2rem; border-radius: 4px; font-size: 0.95rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">Tersedia</span>
                    @else
                        <span style="background: #fbbf24; color: white; padding: 0.4rem 1.2rem; border-radius: 4px; font-size: 0.95rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">Dipinjam</span>
                    @endif
                </div>
            </div>

            <!-- Informasi Detail -->
            <div style="margin-bottom: 3rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1rem; font-weight: 600;">Informasi Detail</h3>
                <table style="width: 100%; font-size: 0.9rem; color: #475569; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 0.4rem 0; width: 30%; font-weight: 600; color: #1e293b; vertical-align: top;">Judul Seri</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">No. Panggil</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ substr(strtoupper($book->title), 0, 3) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Penerbit</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->publisher ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Tahun Terbit</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->published_year ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Deskripsi Fisik</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Bahasa</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">Indonesia</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">ISBN/ISSN</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Klasifikasi</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Tipe Isi</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Tipe Media</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Tipe Pembawa</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Edisi</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Subjek</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">
                            <a href="{{ route('katalog.search', ['keyword' => $book->category->name ?? '']) }}" style="color: #3b82f6; text-decoration: none; text-transform: uppercase;">{{ $book->category->name ?? '-' }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Info Detail Spesifik</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">Pernyataan Tanggungjawab</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->author ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Versi lain/terkait -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 0.5rem; font-weight: 600;">Versi lain/terkait</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; font-style: italic;">Tidak tersedia versi lain</p>
            </div>

            <!-- Lampiran Berkas -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 0.5rem; font-weight: 600;">Lampiran Berkas</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; font-style: italic;">Tidak Ada Data</p>
            </div>

            <!-- Komentar -->
            <div>
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 0.5rem; font-weight: 600;">Komentar</h3>
            </div>
            
        </div>
    </div>
</div>
@endsection
