@extends('layouts.main')

@section('title', 'FAQ - Perpustakaan UNG')

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
                @foreach($faqList as $key => $item)
                    <li style="border-bottom: 1px solid #eaeaea;">
                        <a href="{{ route('katalog.faq', $key) }}" 
                           style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; text-decoration: none; color: {{ $slug == $key ? 'var(--primary-color)' : '#4a5568' }}; font-weight: {{ $slug == $key ? '600' : '400' }}; background: {{ $slug == $key ? '#f8fafc' : 'transparent' }}; transition: all 0.2s;">
                            <span>{{ $item['question'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Content Area -->
        <main style="flex: 1; min-width: 0; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #eaeaea;">
            <h2 style="font-size: 1.5rem; color: #1e293b; margin-top: 0; margin-bottom: 1.5rem; font-weight: 500; padding-bottom: 15px; border-bottom: 1px solid #eaeaea;">
                {{ $currentFaq['question'] }}
            </h2>
            
            <div style="color: #4a5568; line-height: 1.7; font-size: 1rem;">
                {!! $currentFaq['answer'] !!}
            </div>
            
            <div style="margin-top: 4rem; padding-top: 20px; border-top: 1px solid #eaeaea; display: flex; justify-content: flex-end; align-items: center; gap: 1rem; color: #64748b; font-size: 0.95rem;">
                <span style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#64748b'"><i class="fa-regular fa-thumbs-up"></i> Membantu</span>
                <span>|</span>
                <span style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#64748b'"><i class="fa-regular fa-thumbs-down"></i> Tidak Membantu</span>
            </div>
        </main>
    </div>
</div>
@endsection
