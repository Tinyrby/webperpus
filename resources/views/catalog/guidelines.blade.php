@extends('layouts.main')

@section('title', (app()->getLocale() == 'en' && $currentGuide->title_en ? $currentGuide->title_en : $currentGuide->title_id) . ' - Panduan Perpustakaan')

@section('main-class', 'no-hero')

@section('content')
<style>
    .main-content.no-hero {
        padding-top: 75px !important; /* adjust spacing from navbar */
    }
    /* Sembunyikan tombol play besar di tengah video bawaan Chrome agar tidak ganda */
    video::-webkit-media-controls-overlay-play-button {
        display: none !important;
    }
</style>
<div style="background-color: var(--bg-color); padding-bottom: 40px;">
    <div class="container content-relative" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; gap: 40px; flex-wrap: wrap;">
            
            <!-- Sidebar -->
            <aside style="width: 100%; max-width: 300px; flex-shrink: 0;">
                <div style="margin-bottom: 25px;">
                    <a href="{{ route('home') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 600; font-size: 1rem; display: inline-flex; align-items: center; gap: 10px; background: #fff; padding: 10px 20px; border-radius: 50px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: all 0.3s;" onmouseover="this.style.transform='translateX(-5px)'" onmouseout="this.style.transform='translateX(0)'">
                        <i class="fa-solid fa-arrow-left"></i> {{ app()->getLocale() == 'id' ? 'Kembali ke Beranda' : 'Back to Home' }}
                    </a>
                </div>
                
                <div style="background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid rgba(0,0,0,0.02);">
                    <h3 style="padding: 20px; margin: 0; font-size: 1.1rem; color: var(--primary-dark); border-bottom: 1px solid #f1f5f9; background: #f8fafc; font-weight: 700;">
                        Panduan Perpustakaan
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($guidelinesList as $guide)
                        <li style="border-bottom: 1px solid #f1f5f9;">
                            <a href="{{ route('katalog.guidelines', $guide->slug) }}" 
                            style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; text-decoration: none; color: {{ $slug == $guide->slug ? 'var(--primary-color)' : '#475569' }}; font-weight: {{ $slug == $guide->slug ? '600' : '500' }}; background: {{ $slug == $guide->slug ? 'rgba(204, 0, 0, 0.05)' : 'transparent' }}; border-left: 4px solid {{ $slug == $guide->slug ? 'var(--primary-color)' : 'transparent' }}; transition: all 0.2s;">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.8em; opacity: {{ $slug == $guide->slug ? '1' : '0.3' }}; margin-right: 4px;"></i>
                                <span>{{ app()->getLocale() == 'en' && $guide->title_en ? $guide->title_en : $guide->title_id }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Document Viewer -->
            <main class="document-viewer" style="flex: 1; min-width: 0; background: #fff; padding: 30px; border-radius: 16px; box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column;">
            <!-- Title removed as requested -->
        <div style="flex: 1; display: flex; align-items: center; justify-content: center; overflow: hidden; min-height: 500px; border-radius: 8px; background: #000;">
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
        
        <div style="margin-top: 30px; margin-bottom: 0; display: flex; justify-content: center;">
            @if($currentGuide->file_path)
                <a href="{{ asset('storage/' . $currentGuide->file_path) }}" download style="background-color: var(--primary-color); color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(204, 0, 0, 0.2);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(204, 0, 0, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(204, 0, 0, 0.2)';">
                    <i class="fa-solid fa-cloud-arrow-down" style="font-size: 1em;"></i> 
                    {{ app()->getLocale() == 'id' ? 'Download Panduan' : 'Download Guide' }}
                </a>
            @endif
        </div>

        </main>

    </div>
    </div>
</div>
@endsection
