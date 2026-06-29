@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="form-page-wrapper bg-decorative">
    <i class="fa-solid fa-book-journal-whills bg-graphic bg-graphic-tl"></i>
    <i class="fa-solid fa-lightbulb bg-graphic bg-graphic-tr"></i>
    <i class="fa-solid fa-layer-group bg-graphic bg-graphic-bl"></i>
    <i class="fa-solid fa-medal bg-graphic bg-graphic-br"></i>
    <i class="fa-solid fa-pen-nib bg-graphic bg-graphic-ml"></i>
    <i class="fa-solid fa-glasses bg-graphic bg-graphic-mr"></i>
    <div class="form-container content-relative">
        <div class="form-header">
            <h2 class="form-title">Usulan Buku Baru</h2>
            <p class="form-subtitle">Bantu kami memperkaya koleksi perpustakaan dengan mengusulkan buku atau referensi yang Anda butuhkan.</p>
        </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.25rem;"></i>
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('usulan-buku.store') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="form-group half-width">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
            </div>

            <div class="form-group half-width">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Judul Buku/Koleksi <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku atau koleksi yang diusulkan" value="{{ old('title') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group half-width">
                <label class="form-label">Pengarang</label>
                <input type="text" name="author" class="form-control" placeholder="Nama pengarang (opsional)" value="{{ old('author') }}">
            </div>

            <div class="form-group half-width">
                <label class="form-label">Penerbit</label>
                <input type="text" name="publisher" class="form-control" placeholder="Nama penerbit (opsional)" value="{{ old('publisher') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="Nomor ISBN (opsional)" value="{{ old('isbn') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Keterangan tambahan</label>
            <textarea name="notes" class="form-control" placeholder="Berikan keterangan tambahan seperti tahun terbit atau mengapa buku ini dibutuhkan..." required>{{ old('notes') }}</textarea>
        </div>

        <div class="captcha-container">
            <label class="captcha-label">Kode Verifikasi: {{ $captcha }}</label>
            <input type="text" name="captcha" class="form-control" style="max-width: 280px; margin: 0 auto; text-align: center; font-size: 1.1rem; letter-spacing: 2px;" placeholder="Masukkan kode di atas" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Kirim Usulan Buku
            </button>
        </div>
    </form>
    </div>
</div>
@endsection
