<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Online')</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #334155;
        }
        
        /* Catalog Navbar */
        .catalog-navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            z-index: 100;
            box-sizing: border-box;
        }
        .catalog-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            flex: 1;
        }
        .catalog-brand img {
            height: 35px;
        }
        .catalog-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2rem;
            align-items: center;
            justify-content: center;
            flex: 2;
        }
        .catalog-menu a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            transition: color 0.2s;
        }
        .catalog-menu > li {
            padding: 1rem 0;
        }
        .catalog-menu a:hover {
            color: #cbd5e1;
        }

        /* Dropdown styles */
        .catalog-menu .dropdown {
            position: relative;
        }
        .catalog-menu .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: -1rem;
            background: white;
            min-width: 350px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            padding: 0.5rem 0;
            list-style: none;
            z-index: 9999;
            margin: 0;
        }
        .catalog-menu .dropdown:hover .dropdown-menu {
            display: block;
        }
        .catalog-menu .dropdown-menu li {
            width: 100%;
        }
        .catalog-menu .dropdown-menu a {
            color: #334155;
            text-shadow: none;
            padding: 0.75rem 1.5rem;
            display: block;
            font-size: 0.95rem;
            font-weight: 400;
            white-space: normal;
        }
        .catalog-menu .dropdown-menu a:hover {
            background-color: #f8fafc;
            color: #0f172a;
        }
        
        .catalog-lang {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            justify-content: flex-end;
        }
        .catalog-lang img {
            height: 20px;
            border-radius: 2px;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
            transition: opacity 0.2s;
        }
        .catalog-lang img:hover {
            opacity: 0.8;
        }
        
        /* Main content */
        .catalog-main {
            min-height: 100vh;
        }

        /* Pagination */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.25rem;
        }
        .pagination li {
            display: inline-block;
        }
        .pagination li a, .pagination li span {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            color: #3b82f6;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .pagination li a:hover {
            background: #f8fafc;
        }
        .pagination li.active span {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
            font-weight: 600;
        }
        .pagination li.disabled span {
            color: #94a3b8;
            background: #f1f5f9;
            border-color: #e2e8f0;
        }

        /* Footer */
        .footer {
            background-color: #1e293b;
            color: #94a3b8;
            position: relative;
            padding: 4rem 5% 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-brand {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 0;
        }

        .footer-desc {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            margin-top: 0;
        }

        .footer-socials {
            display: flex;
            gap: 1rem;
        }

        .footer-socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer-socials a:hover {
            background: #3b82f6;
            transform: translateY(-3px);
        }

        .footer-title {
            color: #ffffff;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            margin-top: 0;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li a {
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .footer-links li a:hover {
            color: #ffffff;
            padding-left: 5px;
        }

        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="catalog-navbar">
        <a href="{{ route('katalog.search') }}" class="catalog-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UNG">
            Perpustakaan UNG
        </a>
        <ul class="catalog-menu">
            <li><a href="{{ route('katalog.search') }}">{{ __('nav.home') }}</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">{{ __('nav.guidelines') }} <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; margin-left: 3px;"></i></a>
                <ul class="dropdown-menu">
                    @if(isset($globalGuidelines) && $globalGuidelines->count() > 0)
                        @foreach($globalGuidelines as $guide)
                            <li><a href="{{ route('katalog.guidelines', $guide->slug) }}">{{ app()->getLocale() == 'en' && $guide->title_en ? $guide->title_en : $guide->title_id }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <li><a href="{{ route('katalog.information') }}">{{ __('nav.information') }}</a></li>
            <li><a href="{{ route('katalog.help') }}">{{ __('nav.help') }}</a></li>
        </ul>
        <div class="catalog-lang">
            <a href="{{ route('lang', 'en') }}"><img src="https://flagcdn.com/w40/gb.png" alt="English" title="English"></a>
            <a href="{{ route('lang', 'id') }}"><img src="https://flagcdn.com/w40/id.png" alt="Bahasa Indonesia" title="Bahasa Indonesia"></a>
        </div>
    </nav>

    <main class="catalog-main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3 class="footer-brand">{{ __('catalog.footer_brand') }}</h3>
                <p class="footer-desc">{{ __('catalog.footer_desc') }}</p>
                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">{{ __('catalog.e_resources') }}</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('katalog.search') }}">{{ __('catalog.online_catalog') }}</a></li>
                    <li><a href="#">{{ __('catalog.e_journal') }}</a></li>
                    <li><a href="#">{{ __('catalog.digital_repo') }}</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">{{ __('catalog.online_services') }}</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('cek-pinjaman') }}">{{ __('catalog.check_loan') }}</a></li>
                    <li><a href="{{ route('usulan-buku.index') }}">{{ __('catalog.propose_book') }}</a></li>
                    <li><a href="{{ route('saran-masukan.index') }}">{{ __('catalog.feedback') }}</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-title">{{ __('catalog.about_us') }}</h4>
                <ul class="footer-links">
                    <li><a href="#">{{ __('catalog.library_profile') }}</a></li>
                    <li><a href="#">{{ __('catalog.vision_mission') }}</a></li>
                    <li><a href="#">{{ __('catalog.org_structure') }}</a></li>
                    <li><a href="#">{{ __('catalog.opening_hours') }}</a></li>
                </ul>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
