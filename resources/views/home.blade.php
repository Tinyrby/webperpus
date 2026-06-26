@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="hero" @if(isset($heroImage) && $heroImage->value) style="background: linear-gradient(to right, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.4)), url('{{ asset('storage/' . $heroImage->value) }}') center/cover no-repeat;" @endif>
        <div class="hero-content">
            <h1 class="hero-title">Perpustakaan UNG</h1>
            <p class="hero-subtitle">Perpustakaan yang inovatif dan unggul dalam informasi dan edukasi</p>
            
            <div class="hero-buttons">
                <button class="btn-pill active" data-type="katalog">Akses Katalog</button>
                <button class="btn-pill" data-type="jurnal">Jurnal UNG</button>
                <button class="btn-pill" data-type="repo">Repository UNG</button>
                <button class="btn-pill" data-type="onesearch">One Search</button>
                <button class="btn-pill" data-type="sciencedirect">ScienceDirect</button>
                <button class="btn-pill" data-type="oxford">Oxford Academic</button>
                <button class="btn-pill" data-type="doaj">DOAJ</button>
                <button class="btn-pill" data-type="cek-pinjaman">Cek Pinjaman</button>
            </div>

            <form id="hero-search-form" action="#" method="GET" class="search-container" style="display: flex; margin: 0; padding: 0; background: none; box-shadow: none;">
                <div class="search-container" style="flex: 1; width: 100%;">
                    <input type="text" name="q" id="hero-search-input" class="search-input" placeholder="Cari di Katalog Perpustakaan...">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section">
        <h2 class="section-title">Apa yang bisa kami bantu?</h2>
        <p class="section-subtitle">Layanan digital dan sumber daya informasi pilihan</p>
        
        <div class="services-grid">
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                <span>e-Resources</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-atom"></i></div>
                <span>ScienceDirect</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-laptop-code"></i></div>
                <span>Katalog Online</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-newspaper"></i></div>
                <span>e-Journal</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-server"></i></div>
                <span>Digital Repository</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-file-pdf"></i></div>
                <span>e-Skripsi</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-headset"></i></div>
                <span>Layanan Daring</span>
            </div>
            <div class="service-item">
                <div class="service-icon"><i class="fa-solid fa-images"></i></div>
                <span>Galeri</span>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="section" style="background-color: var(--white);">
        <h2 class="section-title" style="color: var(--primary-light); font-size: 1.5rem; letter-spacing: 2px;">FASILITAS</h2>
        <p class="section-subtitle">Apa saja fasilitas yang ada di perpustakaan UNG?</p>

        <div class="facilities-grid">
            @forelse($facilities as $facility)
            <div class="facility-card">
                <div class="img-wrapper">
                    @if($facility->image_path)
                    <img src="{{ asset('storage/' . $facility->image_path) }}" class="facility-img" alt="{{ $facility->name }}">
                    @else
                    <div style="height: 220px; background: #eee; display: flex; align-items:center; justify-content:center;">No Image</div>
                    @endif
                </div>
                <div class="facility-name">{{ $facility->name }}</div>
            </div>
            @empty
            <p style="text-align: center; color: var(--text-muted); width: 100%; grid-column: 1 / -1;">Belum ada data fasilitas. Silakan tambahkan melalui halaman Admin.</p>
            @endforelse
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.hero-buttons .btn-pill');
        const form = document.getElementById('hero-search-form');
        const input = document.getElementById('hero-search-input');
        
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all
                buttons.forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked
                this.classList.add('active');
                
                // Update form based on type
                const type = this.getAttribute('data-type');
                
                if (type === 'cek-pinjaman') {
                    input.placeholder = 'Masukkan NIM...';
                    input.name = 'nim';
                    form.action = "{{ route('cek-pinjaman') }}";
                } else {
                    input.placeholder = 'Cari di Katalog Perpustakaan...';
                    input.name = 'keyword';
                    form.action = "#"; // Replace with route('katalog') when implemented
                }
                
                input.focus();
            });
        });
    });
</script>
@endsection
