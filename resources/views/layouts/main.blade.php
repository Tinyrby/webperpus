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
    
    <style>
        /* To prevent content from hiding under fixed navbar when there is no hero section */
        .main-content {
            min-height: calc(100vh - 72px - 300px); /* rough estimate for footer */
        }
        .main-content.no-hero {
            padding-top: 106px; /* offset for fixed navbar */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="main-navbar">
        <div class="nav-brand">
            <div class="nav-logo-wrapper">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UNG" class="nav-logo-img">
            </div>
            <a href="{{ route('home') }}" class="nav-brand-text">
                <span class="nav-brand-main">Perpustakaan</span>
                <span class="nav-brand-sub">Universitas Negeri Gorontalo</span>
            </a>
        </div>

        <div class="nav-center-wrapper">
            <ul class="nav-menu" id="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="nav-link">Layanan <i class="fa-solid fa-chevron-down nav-chevron"></i></a>
                    <div class="mega-menu">
                        <div class="mega-column">
                            <h4 class="mega-title">LAYANAN DARING</h4>
                            <ul class="mega-list">
                                <li><a href="{{ route('cek-pinjaman') }}"><i class="fa-solid fa-book-open-reader"></i> Cek Pinjaman</a></li>
                                <li><a href="{{ route('usulan-buku.index') }}"><i class="fa-solid fa-plus-circle"></i> Usulan Buku Baru</a></li>
                                <li><a href="{{ route('saran-masukan.index') }}"><i class="fa-solid fa-comment-dots"></i> Saran dan Masukan</a></li>
                            </ul>
                        </div>
                        <div class="mega-column">
                            <h4 class="mega-title">FASILITAS</h4>
                            <ul class="mega-list">
                                @forelse($facilities ?? [] as $facility)
                                <li><a href="#"><i class="fa-solid fa-circle-dot"></i> {{ $facility->name }}</a></li>
                                @empty
                                <li><a href="#" style="color: var(--text-muted); font-style: italic;">Belum ada fasilitas</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#">Panduan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">E-Resources <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">Tentang Kami <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
                <li><a href="#">Bantuan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a></li>
            </ul>

            <div class="nav-actions">
                <div class="lang-flags">
                    <button class="lang-btn active" title="Bahasa Indonesia">
                        <img src="https://flagcdn.com/w40/id.png" alt="Indonesian">
                    </button>
                    <button class="lang-btn" title="English">
                        <img src="https://flagcdn.com/w40/gb.png" alt="English">
                    </button>
                </div>
                <button class="nav-search-icon" title="Cari" aria-label="Buka pencarian">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        <div class="nav-right">
            <img src="{{ asset('images/akreditasi.png') }}" alt="Terakreditasi A" class="nav-akreditasi">
        </div>

        <!-- Hamburger for mobile -->
        <button class="nav-hamburger" id="nav-hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <main class="main-content @yield('main-class')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3 class="footer-brand">Perpustakaan UNG</h3>
                <p class="footer-desc">Perpustakaan yang inovatif dan unggul dalam informasi dan edukasi</p>
                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">E-RESOURCES</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('katalog.search') }}">Katalog Online</a></li>
                    <li><a href="#">e-Journal</a></li>
                    <li><a href="#">Digital Repository</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">LAYANAN DARING</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('cek-pinjaman') }}">Cek Pinjaman</a></li>
                    <li><a href="{{ route('usulan-buku.index') }}">Usulan Buku Baru</a></li>
                    <li><a href="{{ route('saran-masukan.index') }}">Saran dan Masukan</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">TENTANG KAMI</h4>
                <ul class="footer-links">
                    <li><a href="#">Profile Perpustakaan</a></li>
                    <li><a href="#">Visi & Misi</a></li>
                    <li><a href="#">Struktur Organisasi</a></li>
                    <li><a href="#">Jam Buka</a></li>
                </ul>
            </div>
        </div>
    </footer>

    @yield('scripts')

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('main-navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Hamburger toggle
        const hamburger = document.getElementById('nav-hamburger');
        const navMenu = document.querySelector('.nav-center-wrapper');
        if (hamburger && navMenu) {
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('open');
                navMenu.classList.toggle('open');
            });
        }
    </script>
</body>
</html>
