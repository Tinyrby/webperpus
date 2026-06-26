@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="container" style="max-width: 800px; margin: 4rem auto; padding: 2rem;">
    <h2 style="text-align: center; color: #475569; margin-bottom: 2rem; font-size: 1.8rem; font-weight: 500;">Usulan Buku Baru</h2>
    
    @if(session('success'))
        <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usulan-buku.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Nama Lengkap</label>
            <input type="text" name="name" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Email</label>
            <input type="email" name="email" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="name@example.com" value="{{ old('email') }}" required>
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Judul Buku/Koleksi</label>
            <input type="text" name="title" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="Judul Buku/Koleksi" value="{{ old('title') }}" required>
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Pengarang</label>
            <input type="text" name="author" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="Pengarang" value="{{ old('author') }}">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Penerbit</label>
            <input type="text" name="publisher" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="Penerbit" value="{{ old('publisher') }}">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">ISBN</label>
            <input type="text" name="isbn" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="ISBN" value="{{ old('isbn') }}">
        </div>

        <div style="margin-bottom: 1.2rem;">
            <label style="display: block; font-weight: 400; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Keterangan tambahan</label>
            <textarea name="notes" rows="4" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none; font-family: inherit;">{{ old('notes') }}</textarea>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem;">Kode Verifikasi : {{ $captcha }}</label>
            <input type="text" name="captcha" style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none;" placeholder="Masukkan kode verifikasi" required>
        </div>

        <div style="text-align: center;">
            <button type="submit" style="background-color: #0d6efd; color: white; border: none; padding: 0.6rem 2rem; border-radius: 4px; font-weight: 500; cursor: pointer; font-size: 1rem;">Kirim</button>
        </div>
    </form>
</div>
@endsection
