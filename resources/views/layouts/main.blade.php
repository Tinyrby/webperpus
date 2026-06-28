<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan UNG - Universitas Negeri Gorontalo</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
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
            padding-top: 100px; /* offset for fixed navbar */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-brand">
            <!-- Logo dan Nama Website dalam satu link -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UNG" class="brand-logo">
                <div class="brand-text">
                    <span class="brand-name">Perpustakaan UNG</span>
                    <span class="brand-sub">Universitas Negeri Gorontalo</span>
                </div>
            </a>
        </div>
        <div class="nav-center-wrapper">
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-dropdown">
                    <a href="#">Layanan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a>
                    <div class="mega-menu">
                        <div class="mega-column">
                            <h4 class="mega-title">LAYANAN DARING</h4>
                            <ul class="mega-list">
                                <li><a href="{{ route('cek-pinjaman') }}"><i class="fa-solid fa-file-invoice"></i> Cek Pinjaman</a></li>
                                <li><a href="{{ route('usulan-buku.index') }}"><i class="fa-solid fa-book-medical"></i> Usulan Buku Baru</a></li>
                                <li><a href="{{ route('saran-masukan.index') }}"><i class="fa-solid fa-comment-dots"></i> Saran dan Masukan</a></li>
                            </ul>
                        </div>
                        <div class="mega-column">
                            <h4 class="mega-title">FASILITAS</h4>
                            <ul class="mega-list">
                                @forelse($globalFacilities ?? [] as $facility)
                                <li><a href="{{ route('katalog.facilities', $facility->slug ?? $facility->id) }}">{{ $facility->name }}</a></li>
                                @empty
                                <li><a href="#" style="color: var(--text-muted); font-style: italic;">Belum ada fasilitas</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-dropdown">
                    <a href="#">Panduan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a>
                    <div class="mega-menu">
                        <ul class="mega-list">
                            @if(isset($globalGuidelines) && $globalGuidelines->count() > 0)
                                @foreach($globalGuidelines as $guide)
                                    <li><a href="{{ route('katalog.guidelines', $guide->slug) }}"><i class="fa-solid fa-book-open"></i> {{ app()->getLocale() == 'en' && $guide->title_en ? $guide->title_en : $guide->title_id }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="nav-dropdown">
                    <a href="#">E-Resources <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a>
                    <div class="mega-menu">
                        <ul class="mega-list">
                            <li><a href="{{ route('katalog.search') }}"><i class="fa-solid fa-magnifying-glass"></i> Katalog Online</a></li>
                            <li><a href="https://ejurnal.ung.ac.id/index.php" target="_blank"><i class="fa-solid fa-newspaper"></i> e-Journal</a></li>
                            <li><a href="https://repository.ung.ac.id/" target="_blank"><i class="fa-solid fa-server"></i> Digital Repository</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-dropdown">
                    <a href="#">Tentang Kami <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a>
                    <div class="mega-menu">
                        <ul class="mega-list">
                            @php
                                $aboutMenus = \App\Models\AboutPage::where('is_active', true)->orderBy('order', 'asc')->get();
                            @endphp
                            @foreach($aboutMenus as $menu)
                                <li><a href="{{ route('tentang-kami', $menu->slug) }}"><i class="fa-solid fa-circle-info"></i> {{ app()->getLocale() == 'en' && $menu->title_en ? $menu->title_en : $menu->title_id }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-dropdown">
                    <a href="#">Bantuan <i class="fa-solid fa-chevron-down" style="font-size:0.7em;"></i></a>
                    <div class="mega-menu">
                        <ul class="mega-list">
                            <li><a href="{{ route('katalog.faq') }}"><i class="fa-solid fa-circle-question"></i> FAQ</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="nav-actions">
                <div class="nav-divider"></div>
                <div class="lang-flags">
                    <a href="{{ route('lang', 'id') }}"><img src="https://flagcdn.com/w40/id.png" alt="Indonesian"></a>
                    <a href="{{ route('lang', 'en') }}"><img src="https://flagcdn.com/w40/gb.png" alt="English"></a>
                </div>
                <a href="{{ route('katalog.search') }}" class="nav-search-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
        
        <div class="nav-right">
            <img src="{{ asset('images/akreditasi.png') }}" alt="Terakreditasi A" class="nav-akreditasi">
        </div>
    </nav>

    <main class="main-content @yield('main-class')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="custom-shape-divider-top">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

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
                    <li><a href="https://ejurnal.ung.ac.id/index.php" target="_blank">e-Journal</a></li>
                    <li><a href="https://repository.ung.ac.id/" target="_blank">Digital Repository</a></li>
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
        
        <div class="footer-bottom-divider"></div>
        
        <div class="footer-bottom">
            <div class="footer-copyright">
                Copyright &copy; Perpustakaan UNG {{ date('Y') }}
            </div>
            <div class="footer-stats-policy">
                <div class="policy-links">Privacy Policy Terms & Conditions</div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
