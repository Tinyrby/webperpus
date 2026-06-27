@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px 80px;">
    <div style="display: flex; gap: 40px; flex-wrap: wrap;">
        
        <!-- Sidebar -->
        <aside style="width: 100%; max-width: 280px; flex-shrink: 0;">
            <div style="margin-bottom: 20px;">
                <a href="{{ route('home') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500; font-size: 0.95em; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
            
            <ul style="list-style: none; padding: 0; margin: 0; border: 1px solid #eaeaea; border-radius: 8px; overflow: hidden; background: #fff;">
                @foreach($sections as $slug => $name)
                <li style="border-bottom: 1px solid #eaeaea;">
                    <a href="{{ route('tentang-kami', $slug) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; text-decoration: none; color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#4a5568' }}; font-weight: {{ $currentSection == $slug ? '600' : '400' }}; background: {{ $currentSection == $slug ? '#f8fafc' : 'transparent' }}; transition: all 0.2s;">
                        <span>{{ $name }}</span>
                        @if($slug == 'profile-perpustakaan')
                            <i class="fa-solid fa-globe" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'visi-misi')
                            <i class="fa-solid fa-lightbulb" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'struktur-organisasi')
                            <i class="fa-solid fa-sitemap" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'staff-perpustakaan')
                            <i class="fa-solid fa-users" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'tata-tertib')
                            <i class="fa-solid fa-circle-info" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'jam-buka')
                            <i class="fa-solid fa-clock" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @elseif($slug == 'kontak')
                            <i class="fa-solid fa-phone" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }};"></i>
                        @else
                            <i class="fa-solid fa-chevron-right" style="color: {{ $currentSection == $slug ? 'var(--primary-color)' : '#cbd5e1' }}; font-size: 0.8em;"></i>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main style="flex: 1; min-width: 0; background: #fff; padding: 0;">
            <h2 style="font-size: 1.8em; font-weight: 600; color: #1e293b; margin-bottom: 24px;">{{ $title }}</h2>
            
            @if($currentSection == 'profile-perpustakaan')
                <div style="width: 100%; border-radius: 12px; overflow: hidden; position: relative; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <!-- Video Embed sesuai screenshot -->
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/n4fCqgU9E9M?si=1T-jH-C5E0s0N9vR" title="Profile UPT Perpustakaan Universitas Negeri Gorontalo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="display: block;"></iframe>
                </div>
            @else
                <div style="padding: 40px; border: 1px dashed #cbd5e1; border-radius: 12px; text-align: center; background: #f8fafc;">
                    <i class="fa-solid fa-person-digging" style="font-size: 3em; color: #94a3b8; margin-bottom: 16px;"></i>
                    <h3 style="color: #334155; font-size: 1.2em; margin-bottom: 8px;">Halaman Dalam Pengembangan</h3>
                    <p style="color: #64748b; line-height: 1.6; margin: 0;">Konten untuk bagian <strong>{{ $title }}</strong> sedang dipersiapkan dan akan segera tersedia.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
