@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="form-page-wrapper bg-decorative">
    <i class="fa-solid fa-comments bg-graphic bg-graphic-tl"></i>
    <i class="fa-solid fa-paper-plane bg-graphic bg-graphic-tr"></i>
    <i class="fa-solid fa-envelope-open-text bg-graphic bg-graphic-bl"></i>
    <i class="fa-solid fa-face-smile bg-graphic bg-graphic-br"></i>
    <div class="form-container content-relative">
        <div class="form-header">
        <h2 class="form-title">Saran dan Masukan</h2>
        <p class="form-subtitle">Kami sangat menghargai setiap saran, kritik, dan masukan Anda untuk peningkatan layanan Perpustakaan.</p>
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

    <form action="{{ route('saran-masukan.store') }}" method="POST">
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
            <label class="form-label">Pesan <span class="text-danger">*</span></label>
            <textarea name="message" class="form-control" placeholder="Tuliskan saran, kritik, atau masukan Anda di sini..." required>{{ old('message') }}</textarea>
        </div>

        <div class="captcha-container">
            <label class="captcha-label">Kode Verifikasi: {{ $captcha }}</label>
            <input type="text" name="captcha" class="form-control" style="max-width: 280px; margin: 0 auto; text-align: center; font-size: 1.1rem; letter-spacing: 2px;" placeholder="Masukkan kode di atas" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
            </button>
        </div>
    </form>
    </div>
</div>
@endsection
