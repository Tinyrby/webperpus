@extends('layouts.main')

@section('title', (app()->getLocale() == 'en' && $currentGuide->title_en ? $currentGuide->title_en : $currentGuide->title_id) . ' - Panduan Perpustakaan')

@section('main-class', 'no-hero')

@section('content')
<div style="max-width: 1200px; margin: 2rem auto; padding: 0 5%; display: grid; grid-template-columns: 300px 1fr; gap: 2rem; min-height: 70vh;">
    
    <!-- Sidebar -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1rem 0; height: fit-content;">
        <a href="{{ route('home') }}" style="display: block; padding: 0.75rem 1.5rem; color: #3b82f6; text-decoration: none; font-weight: 500; font-size: 0.95rem; border-bottom: 1px solid #e2e8f0; margin-bottom: 0.5rem;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 5px;"></i> {{ app()->getLocale() == 'id' ? 'Kembali ke Beranda' : 'Back to Home' }}
        </a>
        
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach($guidelinesList as $guide)
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('katalog.guidelines', $guide->slug) }}" 
                       style="display: block; padding: 0.75rem 1rem; border-radius: 6px; text-decoration: none; color: {{ $slug == $guide->slug ? '#fff' : '#475569' }}; background: {{ $slug == $guide->slug ? '#0369a1' : 'transparent' }}; font-weight: {{ $slug == $guide->slug ? '600' : '400' }}; transition: all 0.2s;">
                        {{ app()->getLocale() == 'en' && $guide->title_en ? $guide->title_en : $guide->title_id }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Document Viewer -->
    <div class="document-viewer" style="background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 1.5rem; display: flex; flex-direction: column;">
        <!-- Title removed as requested -->
        <div style="flex: 1; background: #f8fafc; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; min-height: 500px;">
            @if($currentGuide->type == 'video')
                @if($currentGuide->file_path)
                    <video controls width="100%" style="max-height: 80vh; border-radius: 6px;">
                        <source src="{{ asset('storage/' . $currentGuide->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video HTML5.
                    </video>
                @elseif($currentGuide->video_url)
                    @php
                        // Extract youtube ID for embed
                        $videoId = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $currentGuide->video_url, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="min-height: 500px;"></iframe>
                    @else
                        <div style="text-align: center; color: #64748b; padding: 2rem;">
                            <i class="fa-solid fa-link" style="font-size: 3rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                            <p style="font-size: 1.1rem;"><a href="{{ $currentGuide->video_url }}" target="_blank">{{ app()->getLocale() == 'id' ? 'Lihat Video di sini' : 'Watch Video here' }}</a></p>
                        </div>
                    @endif
                @else
                    <div style="text-align: center; color: #64748b; padding: 2rem;">
                        <i class="fa-solid fa-video" style="font-size: 3rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                        <p style="font-size: 1.1rem;">{{ app()->getLocale() == 'id' ? 'Video tutorial belum tersedia.' : 'Video tutorial is not available yet.' }}</p>
                    </div>
                @endif
            @else
                @if($currentGuide->file_path)
                    <iframe src="{{ asset('storage/' . $currentGuide->file_path) }}" width="100%" height="100%" style="border: none; min-height: 600px;">
                        <p>Browser Anda tidak mendukung iframe PDF. <a href="{{ asset('storage/' . $currentGuide->file_path) }}">Unduh PDF</a>.</p>
                    </iframe>
                @else
                    <div style="text-align: center; color: #64748b; padding: 2rem;">
                        <i class="fa-solid fa-file-pdf" style="font-size: 3rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                        <p style="font-size: 1.1rem;">{{ app()->getLocale() == 'id' ? 'Dokumen PDF belum diunggah.' : 'PDF document has not been uploaded yet.' }}</p>
                    </div>
                @endif
            @endif
        </div>
        
        <div style="margin-top: 1.5rem;">
            @if($currentGuide->file_path)
                <a href="{{ asset('storage/' . $currentGuide->file_path) }}" download style="color: #94a3b8; text-decoration: none; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.2s;">
                    <i class="fa-solid fa-download"></i> {{ app()->getLocale() == 'id' ? 'klik disini untuk download' : 'click here to download' }}
                </a>
            @endif
        </div>

    </div>

</div>
@endsection
