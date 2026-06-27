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
                @foreach($aboutPages as $page)
                <li style="border-bottom: 1px solid #eaeaea;">
                    <a href="{{ route('tentang-kami', $page->slug) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; text-decoration: none; color: {{ $currentSection->id == $page->id ? 'var(--primary-color)' : '#4a5568' }}; font-weight: {{ $currentSection->id == $page->id ? '600' : '400' }}; background: {{ $currentSection->id == $page->id ? '#f8fafc' : 'transparent' }}; transition: all 0.2s;">
                        <span>{{ app()->getLocale() == 'en' && $page->title_en ? $page->title_en : $page->title_id }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main style="flex: 1; min-width: 0; padding: 0;">
            <h2 style="font-size: 1.8em; font-weight: 600; color: #1e293b; margin-top: 0; margin-bottom: 24px;">{{ app()->getLocale() == 'en' && $currentSection->title_en ? $currentSection->title_en : $currentSection->title_id }}</h2>
            
            @if($currentSection->type == 'text')
                @if(in_array($currentSection->slug, ['struktur-organisasi', 'staff-perpustakaan', 'struktur', 'staff']))
                    <div style="display: flex; flex-direction: column; gap: 40px;">
                        @php
                            $groupedStaffs = $staffs->groupBy('position');
                        @endphp
                        @foreach($groupedStaffs as $position => $members)
                            <div>
                                <h3 style="margin-top: 0; margin-bottom: 24px; color: #334155; font-size: 1.3rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">{{ $position }}</h3>
                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px;">
                                    @foreach($members as $staff)
                                        @php
                                            $personNames = explode("\n", trim(strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $staff->name))));
                                        @endphp
                                        @foreach($personNames as $personName)
                                            @if(trim($personName))
                                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px 20px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); transition: transform 0.2s;">
                                                    @if($staff->photo)
                                                        <img src="{{ Storage::url($staff->photo) }}" alt="{{ trim($personName) }}" style="width: 90px; height: 90px; object-fit: cover; border-radius: 50%; margin: 0 auto 16px; border: 3px solid #f8fafc; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                                    @else
                                                        <div style="width: 90px; height: 90px; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0284c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto 16px; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2);">
                                                            <i class="fa-solid fa-user-tie"></i>
                                                        </div>
                                                    @endif
                                                    <h4 style="margin: 0; color: #1e293b; font-size: 1.1rem; font-weight: 700; line-height: 1.4;">{{ trim($personName) }}</h4>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        @if(count($staffs) == 0)
                            <div style="grid-column: 1 / -1; padding: 40px; border: 1px dashed #cbd5e1; border-radius: 12px; text-align: center; background: #f8fafc;">
                                <i class="fa-solid fa-users-slash" style="font-size: 3em; color: #94a3b8; margin-bottom: 16px;"></i>
                                <h3 style="color: #334155; font-size: 1.2em; margin-bottom: 8px;">Belum Ada Data</h3>
                                <p style="color: #64748b; line-height: 1.6; margin: 0;">Silakan tambahkan data melalui panel admin.</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="content-text" style="color: #334155; line-height: 1.8; font-size: 1.05rem; padding: 24px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
                        {!! nl2br(e(app()->getLocale() == 'en' && $currentSection->content_en ? $currentSection->content_en : $currentSection->content_id)) !!}
                    </div>
                @endif
            @elseif($currentSection->type == 'video')
                <div style="width: 100%; border-radius: 12px; overflow: hidden; position: relative; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); background: #f8fafc;">
                    @if($currentSection->file_path)
                        <video controls width="100%" style="max-height: 80vh; display: block;">
                            <source src="{{ asset('storage/' . $currentSection->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video HTML5.
                        </video>
                    @elseif($currentSection->video_url)
                        @php
                            $videoId = '';
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $currentSection->video_url, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp
                        @if($videoId)
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="display: block;"></iframe>
                        @else
                            <a href="{{ $currentSection->video_url }}" target="_blank" style="display: block; padding: 2rem; text-align: center;">Tonton Video</a>
                        @endif
                    @endif
                </div>
            @elseif($currentSection->type == 'pdf')
                <div style="width: 100%; height: 600px; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
                    @if($currentSection->file_path)
                        <iframe src="{{ asset('storage/' . $currentSection->file_path) }}" width="100%" height="100%" style="border: none;"></iframe>
                    @else
                        <div style="padding: 2rem; text-align: center; color: #64748b;">PDF tidak ditemukan.</div>
                    @endif
                </div>
            @elseif($currentSection->type == 'image')
                <div style="width: 100%; text-align: center;">
                    @if($currentSection->file_path)
                        <img src="{{ asset('storage/' . $currentSection->file_path) }}" alt="{{ $currentSection->title_id }}" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    @else
                        <div style="padding: 2rem; text-align: center; color: #64748b;">Gambar tidak ditemukan.</div>
                    @endif
                </div>
            @else
                <div style="padding: 40px; border: 1px dashed #cbd5e1; border-radius: 12px; text-align: center; background: #f8fafc;">
                    <i class="fa-solid fa-person-digging" style="font-size: 3em; color: #94a3b8; margin-bottom: 16px;"></i>
                    <h3 style="color: #334155; font-size: 1.2em; margin-bottom: 8px;">Halaman Dalam Pengembangan</h3>
                    <p style="color: #64748b; line-height: 1.6; margin: 0;">Konten sedang dipersiapkan.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
