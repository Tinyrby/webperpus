@extends('layouts.main')

@section('title', $currentFacility->name . ' - Fasilitas Perpustakaan')

@section('main-class', 'no-hero')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px 80px;">
    <div style="display: flex; gap: 40px; flex-wrap: wrap;">
        
        <!-- Sidebar -->
        <aside style="width: 100%; max-width: 280px; flex-shrink: 0;">
            <div style="margin-bottom: 20px;">
                <a href="{{ route('home') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500; font-size: 0.95em; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-arrow-left"></i> {{ app()->getLocale() == 'id' ? 'Kembali ke Beranda' : 'Back to Home' }}
                </a>
            </div>
            
            <ul style="list-style: none; padding: 0; margin: 0; border: 1px solid #eaeaea; border-radius: 8px; overflow: hidden; background: #fff;">
                @foreach($facilitiesList as $facility)
                <li style="border-bottom: 1px solid #eaeaea;">
                    <a href="{{ route('katalog.facilities', $facility->slug ?? $facility->id) }}" 
                       style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; text-decoration: none; color: {{ ($slug == $facility->slug || $slug == $facility->id) ? 'var(--primary-color)' : '#4a5568' }}; font-weight: {{ ($slug == $facility->slug || $slug == $facility->id) ? '600' : '400' }}; background: {{ ($slug == $facility->slug || $slug == $facility->id) ? '#f8fafc' : 'transparent' }}; transition: all 0.2s;">
                        <span>{{ $facility->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>

        <!-- Content Area -->
        <main style="flex: 1; min-width: 0; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #eaeaea;">
            <h2 style="font-size: 1.5rem; color: #1e293b; margin-top: 0; margin-bottom: 1.5rem; font-weight: 500; padding-bottom: 15px; border-bottom: 1px solid #eaeaea;">
                {{ $currentFacility->name }}
            </h2>
            
            @if($currentFacility->image_path)
                <div style="margin-bottom: 2rem; border-radius: 8px; overflow: hidden; border: 1px solid #eaeaea; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset('storage/' . $currentFacility->image_path) }}" alt="{{ $currentFacility->name }}" style="width: 100%; height: auto; display: block; max-height: 400px; object-fit: cover;">
                </div>
            @endif

            <div style="color: #4a5568; line-height: 1.7; font-size: 1rem; white-space: pre-wrap;">
                {!! $currentFacility->description ?? '<i>Belum ada deskripsi untuk fasilitas ini.</i>' !!}
            </div>
        </main>
    </div>
</div>
@endsection
