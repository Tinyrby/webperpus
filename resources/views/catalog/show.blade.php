@extends('layouts.catalog')

@section('title', $book->title . ' - Katalog Online')

@section('content')
<!-- Small Hero Section -->
@php
    $catalogBg = \App\Models\Setting::where('key', 'catalog_bg_image')->first();
    $bgUrl = ($catalogBg && $catalogBg->value) ? Storage::url($catalogBg->value) : 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
@endphp
<section class="catalog-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ $bgUrl }}') center/cover no-repeat; padding: 120px 20px 40px; text-align: center; position: relative;">
    <div style="max-width: 800px; margin: 0 auto; position: relative; z-index: 10;">
        <form action="{{ route('katalog.search') }}" method="GET" style="display: flex; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-radius: 8px; overflow: hidden; margin-top: 2rem;">
            <input type="text" name="keyword" placeholder="Masukkan kata kunci untuk mencari koleksi..." style="flex: 1; padding: 1.2rem 1.5rem; border: none; font-size: 1.1rem; outline: none;">
            <button type="submit" style="padding: 0 2rem; background: white; border: none; border-left: 1px solid #e2e8f0; cursor: pointer; color: #64748b; font-size: 1.2rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>

<!-- Detail Content -->
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 3rem 20px;">
    
    <div style="display: flex; flex-wrap: wrap; gap: 3rem;">
        
        <!-- Left: Cover -->
        <div style="width: 300px; flex-shrink: 0;">
            <div style="background: #e2e8f0; padding: 2rem; border-radius: 8px; display: flex; justify-content: center; align-items: center; min-height: 400px;">
                @if($book->cover_image)
                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; max-width: 250px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); border-radius: 4px;">
                @else
                    <i class="fa-solid fa-book" style="font-size: 8rem; color: #94a3b8;"></i>
                @endif
            </div>
        </div>

        <!-- Right: Info -->
        <div style="flex: 1; min-width: 300px;">
            <div style="margin-bottom: 2rem;">
                <span style="display: inline-block; color: #16a34a; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;"><i class="fa-solid fa-bookmark"></i> Buku</span>
                <h1 style="margin: 0 0 0.5rem; color: #0f172a; font-size: 2rem; font-weight: 600;">{{ $book->title }}</h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">
                    — <span style="color: #3b82f6;">{{ $book->author ?? 'Pengarang Tidak Diketahui' }}</span> - Nama Orang;
                </p>
                <div style="width: 100%; height: 1px; background: #e2e8f0; margin-bottom: 1.5rem;"></div>
                
                <p style="color: #475569; font-size: 0.95rem; line-height: 1.6;">
                    {{ $book->description ?? 'Tidak ada deskripsi tersedia untuk buku ini.' }}
                </p>
            </div>

            <!-- Ketersediaan -->
            <div style="margin-bottom: 3rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1rem; font-weight: 600;">{{ __('catalog.availability') }}</h3>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    @if($book->is_available)
                        <span style="background: #dcfce7; color: #166534; padding: 0.4rem 1.2rem; border-radius: 4px; font-size: 0.95rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">{{ __('catalog.available') }}</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 0.4rem 1.2rem; border-radius: 4px; font-size: 0.95rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">{{ __('catalog.borrowed') }}</span>
                    @endif
                </div>
            </div>

            <!-- Informasi Detail -->
            <div style="margin-bottom: 3rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1rem; font-weight: 600;">{{ __('catalog.detailed_info') }}</h3>
                <table style="width: 100%; font-size: 0.9rem; color: #475569; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 0.4rem 0; width: 30%; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.series_title') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.call_number') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ substr(strtoupper($book->title), 0, 3) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.publisher') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->publisher ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.publication_year') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->publication_year ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.physical_desc') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.language') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ __('catalog.indonesian') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.isbn') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.classification') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.content_type') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.media_type') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.carrier_type') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.edition') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.subject') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">
                            <a href="{{ route('katalog.search', ['keyword' => $book->category->name ?? '']) }}" style="color: #3b82f6; text-decoration: none; text-transform: uppercase;">{{ $book->category->name ?? '-' }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.specific_detail_info') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">-</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; font-weight: 600; color: #1e293b; vertical-align: top;">{{ __('catalog.statement_of_responsibility') }}</td>
                        <td style="padding: 0.4rem 0; vertical-align: top;">{{ $book->author ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Versi lain/terkait -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 0.5rem; font-weight: 600;">{{ __('catalog.other_versions') }}</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; font-style: italic;">{{ __('catalog.no_other_versions') }}</p>
            </div>

            <!-- Lampiran Berkas -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 0.5rem; font-weight: 600;">{{ __('catalog.file_attachments') }}</h3>
                <p style="color: #94a3b8; font-size: 0.9rem; font-style: italic;">{{ __('catalog.no_attachments') }}</p>
            </div>

            <!-- Comments Section -->
            <div style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <h3 style="font-size: 1.5rem; color: #1e293b; margin-bottom: 1.5rem;"><i class="fa-regular fa-comments"></i> {{ __('catalog.comments') }}</h3>
                
                @if(session('success'))
                    <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div style="margin-bottom: 2rem;">
                    @forelse($book->comments as $comment)
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <strong style="color: #334155;">{{ $comment->name }}</strong>
                                <span style="color: #94a3b8; font-size: 0.85rem;">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p style="color: #475569; margin: 0; line-height: 1.5;">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p style="color: #94a3b8; font-style: italic;">{{ __('catalog.no_comments') }}</p>
                    @endforelse
                </div>
                
                <div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <h4 style="margin-top: 0; color: #334155; margin-bottom: 1rem;">{{ __('catalog.write_comment') }}</h4>
                    <form action="{{ route('katalog.comments.store', $book->id) }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 1rem;">
                            <input type="text" name="name" placeholder="Nama Anda" required style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none; font-family: 'Outfit', sans-serif;">
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <textarea name="body" rows="4" placeholder="{{ __('catalog.write_comment') }}..." required style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; outline: none; font-family: 'Outfit', sans-serif; resize: vertical;"></textarea>
                        </div>
                        <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 4px; cursor: pointer; font-weight: 500; transition: background 0.2s;">
                            {{ __('catalog.submit_comment') }}
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
