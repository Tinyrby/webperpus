@extends('layouts.catalog')

@section('title', 'Katalog Online - Perpustakaan UNG')

@section('content')
<!-- Hero Catalog Section -->
@php
    $catalogBg = \App\Models\Setting::where('key', 'catalog_bg_image')->first();
    $bgUrl = ($catalogBg && $catalogBg->value) ? Storage::url($catalogBg->value) : 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
@endphp
<section class="catalog-hero" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ $bgUrl }}') center/cover no-repeat; padding: {{ isset($searchResults) ? '120px 20px 40px' : '150px 20px 80px' }}; text-align: center; position: relative;">
    <div style="max-width: 800px; margin: 0 auto; position: relative; z-index: 10;">
        @if(!isset($searchResults))
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 2rem; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ __('nav.catalog_search') }}</h1>
        @endif
        <form action="{{ route('katalog.search') }}" method="GET" style="display: flex; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-radius: 8px; overflow: hidden; {{ isset($searchResults) ? 'margin-top: 2rem;' : '' }}">
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="{{ __('nav.search_placeholder') }}" style="flex: 1; padding: 1.2rem 1.5rem; border: none; font-size: 1.1rem; outline: none;">
            <button type="submit" style="padding: 0 2rem; background: white; border: none; border-left: 1px solid #e2e8f0; cursor: pointer; color: #64748b; font-size: 1.2rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>

<!-- Main Catalog Content -->
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 3rem 20px;">
    
    @if($searchResults)
        <!-- Hasil Pencarian Layout Horizontal -->
        <div style="margin-bottom: 4rem; display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start;">
            
            <!-- Kolom Kiri: Daftar Buku -->
            <div style="flex: 3; min-width: 300px;">
                @if(request('search_type') == 'category')
                    <h2 style="font-size: 1.5rem; color: #334155; margin: 0 0 2rem 0; font-weight: 600; text-transform: capitalize; line-height: 1.2;">{{ __('catalog.category') }} {{ $keyword }}</h2>
                @else
                    <h2 style="font-size: 1.5rem; color: #334155; margin: 0 0 2rem 0; font-weight: 600; line-height: 1.2;">{{ __('catalog.search_results') }} "{{ $keyword }}"</h2>
                @endif
                
                @if($searchResults->count() > 0)
                    <!-- Pagination Top -->
                    @if($searchResults->hasPages())
                    <div style="display: flex; justify-content: center; background: #f1f5f9; padding: 0.5rem; border-radius: 9999px; width: fit-content; margin: 0 auto 2rem;">
                        {{ $searchResults->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @foreach($searchResults as $book)
                            <div class="search-result-card" style="display: flex; flex-direction: column; border: 1px solid #e2e8f0; border-radius: 8px; background: white; padding: 1.5rem; position: relative; transition: box-shadow 0.2s;">
                                
                                <div style="display: flex; w-full;">
                                <!-- Cover -->
                                <div style="width: 120px; margin-right: 1.5rem; flex-shrink: 0;">
                                    @if($book->cover_image)
                                        <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; border-radius: 4px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                                    @else
                                        <div style="width: 100%; aspect-ratio: 2/3; background: #e2e8f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #94a3b8; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                                            <i class="fa-solid fa-book" style="font-size: 2.5rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div style="flex: 1;">
                                    <h3 style="margin: 0 0 0.8rem; color: #0f172a; font-size: 1.3rem; font-weight: 500;">{{ $book->title }}</h3>
                                    <a href="#" style="display: inline-block; border: 1px solid #cbd5e1; border-radius: 9999px; padding: 0.3rem 1.2rem; color: #64748b; text-decoration: none; font-size: 0.85rem; margin-bottom: 1rem; transition: border-color 0.2s;">{{ $book->author ?? __('catalog.unknown_author') }}</a>
                                    <p style="color: #475569; font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem;">
                                        {{ $book->description ? Str::limit($book->description, 180) : __('catalog.default_desc') }}
                                    </p>
                                </div>
                                
                                <!-- Ketersediaan -->
                                <div style="width: 140px; border-left: 1px solid #e2e8f0; padding-left: 1.5rem; margin-left: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <span style="font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">{{ __('catalog.availability') }}</span>
                                    @if($book->is_available)
                                        <span style="font-size: 1.1rem; font-weight: 600; color: #38bdf8; margin: 1rem 0 1.5rem;">{{ __('catalog.available') }}</span>
                                    @else
                                        <span style="font-size: 1.1rem; font-weight: 600; color: #fbbf24; margin: 1rem 0 1.5rem;">{{ __('catalog.borrowed') }}</span>
                                    @endif
                                    <a href="{{ route('katalog.show', $book->id) }}" style="display: block; width: 100%; text-align: center; border: 1px solid #3b82f6; color: #3b82f6; padding: 0.5rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem; margin-bottom: 0.5rem; transition: background 0.2s;" onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='transparent'">{{ __('catalog.show_details') }}</a>
                                    <a href="javascript:void(0)" onclick="showCitation('{{ addslashes($book->author) }}', '{{ addslashes($book->publisher) }}')" style="display: block; width: 100%; text-align: center; border: 1px solid #cbd5e1; color: #64748b; padding: 0.5rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">{{ __('catalog.citation') }}</a>
                                </div>
                            </div>
                            <!-- Expandable Details -->
                            <div id="detail-{{ $book->id }}" style="display: none; padding-top: 1rem; margin-top: 1rem; border-top: 1px dashed #e2e8f0;">
                                <table style="width: 100%; font-size: 0.9rem; color: #475569; border-collapse: collapse;">
                                    <tr>
                                        <td style="padding: 0.3rem 0; width: 30%; font-weight: 600; color: #1e293b;">{{ __('catalog.edition') }}</td>
                                        <td style="padding: 0.3rem 0;">-</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem 0; font-weight: 600; color: #1e293b;">{{ __('catalog.isbn') }}</td>
                                        <td style="padding: 0.3rem 0;">{{ $book->isbn ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem 0; font-weight: 600; color: #1e293b;">{{ __('catalog.physical_desc') }}</td>
                                        <td style="padding: 0.3rem 0;">-</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem 0; font-weight: 600; color: #1e293b;">{{ __('catalog.series_title') }}</td>
                                        <td style="padding: 0.3rem 0;">-</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem 0; font-weight: 600; color: #1e293b;">No. Panggil</td>
                                        <td style="padding: 0.3rem 0;">-</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- Toggle Arrow -->
                            <div style="text-align: center; color: #3b82f6; cursor: pointer; margin-top: 1rem;" onclick="toggleDetail({{ $book->id }}, this)">
                                <i class="fa-solid fa-angles-down"></i>
                            </div>
                            
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination Bottom -->
                    <div style="margin-top: 2rem; display: flex; justify-content: center;">
                        {{ $searchResults->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem; background: white; border-radius: 8px; border: 1px dashed #cbd5e1;">
                        <i class="fa-solid fa-book-open-reader" style="font-size: 3rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                        <h3 style="color: #475569; margin-bottom: 0.5rem;">Tidak Ditemukan</h3>
                        <p style="color: #64748b;">Maaf, tidak ada koleksi yang cocok dengan kata kunci tersebut.</p>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Sidebar -->
            <div style="flex: 1; min-width: 250px;">
                <!-- Saran -->
                <div style="background: transparent;">
                    <h3 style="font-size: 1.1rem; color: #1e293b; margin: 0 0 2rem 0; font-weight: 600; line-height: 1.2;">Saran</h3>
                    @foreach(\App\Models\Book::inRandomOrder()->limit(4)->get() as $saran)
                        <div style="display: flex; gap: 1rem; margin-bottom: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.8rem; background: white; transition: border-color 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#3b82f6'" onmouseout="this.style.borderColor='#e2e8f0'">
                            <div style="width: 50px; flex-shrink: 0;">
                                @if($saran->cover_image)
                                    <img src="{{ Storage::url($saran->cover_image) }}" alt="{{ $saran->title }}" style="width: 100%; border-radius: 4px;">
                                @else
                                    <div style="width: 100%; aspect-ratio: 2/3; background: #e2e8f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 0.8rem;">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                @endif
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="font-size: 0.85rem; color: #334155; margin: 0 0 0.3rem; line-height: 1.4;">{{ Str::limit($saran->title, 40) }}</h4>
                                <span style="font-size: 0.75rem; color: #94a3b8; font-style: italic;">{{ Str::limit($saran->author ?? 'Anonim', 20) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <!-- Tampilan Default (Bukan Pencarian) -->
        @php
            $categoryIcons = [
                1 => '🖥️🌐', 2 => '🧠💭', 3 => '🕌⛪', 4 => '📜🏅', 5 => '🗣️🌐', 
                6 => '📐🔬', 7 => '💻📈', 8 => '🎨🎭', 9 => '🍎📚', 10 => '⏱️🌍'
            ];
            $mainCategoryIds = [9, 4, 7, 8];
        @endphp

        <!-- Subjects / Subjek Menarik -->
        <div style="margin-bottom: 4rem; text-align: center;">
            <h3 style="font-size: 1.2rem; color: #64748b; font-weight: 400; margin-bottom: 2rem;">{{ __('catalog.select_subject') }}</h3>
            
            <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
                @foreach($categories->whereIn('id', $mainCategoryIds) as $cat)
                <a href="{{ route('katalog.search', ['keyword' => $cat->name, 'search_type' => 'category']) }}" class="subject-card">
                    <div class="subject-icon">{{ $categoryIcons[$cat->id] ?? '📚✨' }}</div>
                    <div class="subject-text">{{ $cat->name }}</div>
                </a>
                @endforeach
                
                <!-- Lainnya -->
                <a href="javascript:void(0)" class="subject-card" onclick="document.getElementById('subjectModal').style.display='flex'">
                    <div class="subject-icon">
                        <i class="fa-solid fa-ellipsis" style="font-size: 2.5rem; color: #64748b;"></i>
                    </div>
                    <div class="subject-text">{{ __('catalog.see_more') }}</div>
                </a>
            </div>
        </div>

        <!-- Subject Modal -->
        <div id="subjectModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; padding: 20px; box-sizing: border-box;">
            <div style="background: white; border-radius: 8px; width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 2rem; border-bottom: 1px solid #e2e8f0;">
                    <h3 style="margin: 0; font-size: 1.25rem; color: #334155; font-weight: 600;">{{ __('catalog.select_subject') }}</h3>
                    <button onclick="document.getElementById('subjectModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer;">&times;</button>
                </div>
                <div style="padding: 2rem;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1.5rem; justify-items: center;">
                        @foreach($categories as $cat)
                        <a href="{{ route('katalog.search', ['keyword' => $cat->name, 'search_type' => 'category']) }}" class="subject-card">
                            <div class="subject-icon">{{ $categoryIcons[$cat->id] ?? '📚✨' }}</div>
                            <div class="subject-text">{{ $cat->name }}</div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div style="padding: 1rem 2rem; border-top: 1px solid #e2e8f0; text-align: right; font-size: 0.8rem; color: #94a3b8;">
                    Icons made by Freepik from www.flaticon.com
                </div>
            </div>
        </div>



        <!-- Populer -->
        <div style="margin-bottom: 4rem;">
            <h2 style="font-size: 1.5rem; color: #1e293b; font-weight: 600; margin-bottom: 0.5rem;">{{ __('catalog.popular_title') }}</h2>
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">{{ __('catalog.popular_desc') }}</p>
            
            <!-- Tags -->
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem;">
                @foreach($categories->shuffle()->take(5) as $tagCat)
                    <a href="{{ route('katalog.search', ['keyword' => $tagCat->name, 'search_type' => 'category']) }}" class="catalog-tag" style="text-decoration: none; display: inline-block;">{{ $tagCat->name }}</a>
                @endforeach
            </div>

            <!-- Books Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1.5rem;">
                @foreach($popularBooks as $book)
                    @include('catalog.partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </div>

        <!-- Baru & Diperbarui -->
        <div style="margin-bottom: 4rem;">
            <h2 style="font-size: 1.5rem; color: #1e293b; font-weight: 600; margin-bottom: 0.5rem;">{{ __('catalog.new_title') }}</h2>
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">{{ __('catalog.new_desc') }}</p>
            
            <!-- Tags -->
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem;">
                @foreach($categories->shuffle()->take(5) as $tagCat)
                    <a href="{{ route('katalog.search', ['keyword' => $tagCat->name, 'search_type' => 'category']) }}" class="catalog-tag" style="text-decoration: none; display: inline-block;">{{ $tagCat->name }}</a>
                @endforeach
            </div>

            <!-- Books Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1.5rem;">
                @foreach($newBooks as $book)
                    @include('catalog.partials.book-card', ['book' => $book])
                @endforeach
            </div>
        </div>

        <!-- Penikmat Koleksi Tahun Ini -->
        <div style="margin-bottom: 4rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
            <h2 style="font-size: 1.5rem; color: #1e293b; font-weight: 600; margin-bottom: 0.5rem;">Penikmat Koleksi tahun ini</h2>
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 2rem;">Pengunjung terbaik kami ada di sini. Nama dan foto di bawah ini muncul di sini. Apakah Anda juga ingin berkunjung dan membaca?</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                @forelse($topMembers as $member)
                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.5rem; text-align: center; background: white;">
                        <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <i class="fa-solid fa-user" style="font-size: 2.5rem; color: #94a3b8;"></i>
                        </div>
                        <h4 style="font-weight: 600; color: #334155; margin-bottom: 0.2rem; text-transform: uppercase;">{{ $member->name }}</h4>
                        <p style="color: #94a3b8; font-size: 0.85rem; margin-bottom: 1rem;">MAHASISWA</p>
                        <p style="color: #64748b; font-size: 0.9rem;"><strong>{{ rand(10, 50) }}</strong> Loans &nbsp;|&nbsp; <strong>{{ rand(5, 30) }}</strong> Title</p>
                    </div>
                @empty
                    <p style="color: #64748b;">Belum ada data peminjam.</p>
                @endforelse
            </div>
        </div>
    @endif
</div>

<!-- Citation Modal -->
<div id="citationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; padding: 20px; box-sizing: border-box;">
    <div style="background: white; border-radius: 8px; width: 100%; max-width: 400px; position: relative; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 2rem; border-bottom: 1px solid #e2e8f0;">
            <h3 style="margin: 0; font-size: 1.25rem; color: #334155; font-weight: 600;">Sitasi</h3>
            <button onclick="document.getElementById('citationModal').style.display='none'" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer;">&times;</button>
        </div>
        <div style="padding: 2.5rem 2rem; text-align: center;">
            <p id="citationText" style="font-size: 1.5rem; color: #1e293b; font-weight: 500; font-family: monospace; background: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid #e2e8f0;"></p>
        </div>
        <div style="padding: 1rem 2rem; border-top: 1px solid #e2e8f0; text-align: center;">
            <button onclick="document.getElementById('citationModal').style.display='none'" style="background: #3b82f6; color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 4px; cursor: pointer; font-weight: 600;">Tutup</button>
        </div>
    </div>
</div>

<style>
    .subject-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 140px;
        height: 140px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-decoration: none;
        background: white;
        transition: all 0.2s;
    }
    .subject-card:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .subject-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .subject-text {
        font-size: 0.8rem;
        color: #64748b;
        text-align: center;
        padding: 0 10px;
    }
    .catalog-tag {
        padding: 0.4rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 9999px;
        font-size: 0.8rem;
        color: #64748b;
        text-decoration: none;
        background: white;
    }
    .catalog-tag:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
</style>

<script>
    // Close modals when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('subjectModal');
        var citModal = document.getElementById('citationModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == citModal) {
            citModal.style.display = "none";
        }
    }

    function showCitation(author, publisher) {
        let name = '';
        if (author && author.trim() !== '') {
            let parts = author.trim().split(' ');
            name = parts[parts.length - 1];
        } else if (publisher && publisher.trim() !== '') {
            let parts = publisher.trim().split(' ');
            name = parts[parts.length - 1];
        } else {
            name = 'Tidak Diketahui';
        }
        
        document.getElementById('citationText').innerText = '(' + name + ')';
        document.getElementById('citationModal').style.display = 'flex';
    }

    function toggleDetail(bookId, element) {
        var detailDiv = document.getElementById('detail-' + bookId);
        var icon = element.querySelector('i');
        
        if (detailDiv.style.display === 'none' || detailDiv.style.display === '') {
            detailDiv.style.display = 'block';
            icon.classList.remove('fa-angles-down');
            icon.classList.add('fa-angles-up');
        } else {
            detailDiv.style.display = 'none';
            icon.classList.remove('fa-angles-up');
            icon.classList.add('fa-angles-down');
        }
    }
</script>
@endsection
