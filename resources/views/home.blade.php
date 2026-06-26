<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan UNG - Universitas Negeri Gorontalo</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">
            <!-- Using UNG Logo from local storage -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo UNG" style="height: 40px;">
            Perpustakaan UNG
        </div>
        <div class="nav-center-wrapper">
            <ul class="nav-menu">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Layanan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">Panduan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">E-Resources <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">Tentang Kami <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">Bantuan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
            </ul>
            <div class="lang-flags">
                <img src="https://flagcdn.com/w40/id.png" alt="Indonesian">
                <img src="https://flagcdn.com/w40/gb.png" alt="English">
            </div>
        </div>
        
        <div class="nav-right" style="display: flex; align-items: center; position: relative; width: 70px;">
            <!-- Simpan gambar yang baru saja Anda unggah ke dalam folder: c:\laragon\www\WebPerpus\public\images\akreditasi.png -->
            <img src="{{ asset('images/akreditasi.png') }}" alt="Terakreditasi A" style="position: absolute; right: 0; top: -35px; height: 95px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15)); z-index: 1001;">
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" @if(isset($heroImage) && $heroImage->value) style="background: linear-gradient(to right, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.4)), url('{{ asset('storage/' . $heroImage->value) }}') center/cover no-repeat;" @endif>
        <div class="hero-content">
            <h1 class="hero-title">Perpustakaan UNG</h1>
            <p class="hero-subtitle">Perpustakaan yang inovatif dan unggul dalam informasi dan edukasi</p>
            
            <div class="hero-buttons">
                <button class="btn-pill active">Akses Katalog</button>
                <button class="btn-pill">Jurnal UNG</button>
                <button class="btn-pill">Repository UNG</button>
                <button class="btn-pill">One Search</button>
                <button class="btn-pill">ScienceDirect</button>
                <button class="btn-pill">Oxford Academic</button>
                <button class="btn-pill">DOAJ</button>
                <button class="btn-pill">Cek Pinjaman</button>
            </div>

            <div class="search-container">
                <input type="text" class="search-input" placeholder="Cari di Katalog Perpustakaan...">
                <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
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

</body>
</html>
