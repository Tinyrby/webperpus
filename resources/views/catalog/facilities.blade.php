@extends('layouts.main')

@section('title', $currentFacility->name . ' - Fasilitas Perpustakaan')

@section('main-class', 'no-hero')

@section('content')
<style>
    .main-content.no-hero {
        padding-top: 75px !important; /* adjust spacing from navbar */
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
                        Daftar Fasilitas
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($facilitiesList as $facility)
                        <li style="border-bottom: 1px solid #f1f5f9;">
                            <a href="{{ route('katalog.facilities', $facility->slug ?? $facility->id) }}" 
                            style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; text-decoration: none; color: {{ ($slug == $facility->slug || $slug == $facility->id) ? 'var(--primary-color)' : '#475569' }}; font-weight: {{ ($slug == $facility->slug || $slug == $facility->id) ? '600' : '500' }}; background: {{ ($slug == $facility->slug || $slug == $facility->id) ? 'rgba(204, 0, 0, 0.05)' : 'transparent' }}; border-left: 4px solid {{ ($slug == $facility->slug || $slug == $facility->id) ? 'var(--primary-color)' : 'transparent' }}; transition: all 0.2s;">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.8em; opacity: {{ ($slug == $facility->slug || $slug == $facility->id) ? '1' : '0.3' }}; margin-right: 4px;"></i>
                                <span>{{ $facility->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Content Area -->
            <main style="flex: 1; min-width: 0; background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.03);">
                <h2 style="font-size: 2.2rem; color: var(--primary-dark); margin-top: 0; margin-bottom: 1rem; font-weight: 800; line-height: 1.2;">
                    {{ $currentFacility->name }}
                </h2>
                
                <div style="width: 60px; height: 4px; background: var(--primary-color); border-radius: 2px; margin-bottom: 2rem;"></div>
                
                @if($currentFacility->image_path)
                    <div style="margin-bottom: 2.5rem; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        <img src="{{ asset('storage/' . $currentFacility->image_path) }}" alt="{{ $currentFacility->name }}" style="width: 100%; height: auto; display: block; max-height: 450px; object-fit: cover;">
                    </div>
                @endif

                <div style="color: #334155; line-height: 1.8; font-size: 1.05rem;" class="facility-desc-content">
                    {!! $currentFacility->description ?? '<p style="color: #94a3b8; font-style: italic;">Belum ada deskripsi untuk fasilitas ini.</p>' !!}
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
