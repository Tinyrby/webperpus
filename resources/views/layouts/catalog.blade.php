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
        .catalog-menu a:hover {
            color: #cbd5e1;
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

        /* Footer */
        .catalog-footer {
            background-color: #f1f5f9;
            padding: 2rem;
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
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
            <li><a href="{{ route('katalog.search') }}">Beranda</a></li>
            <li><a href="#">Informasi</a></li>
            <li><a href="#">Berita</a></li>
            <li><a href="#">Bantuan</a></li>
            <li><a href="#">Pustakawan</a></li>
            <li><a href="#">Area Anggota</a></li>
        </ul>
        <div class="catalog-lang">
            <img src="https://flagcdn.com/w40/gb.png" alt="English" title="English">
            <img src="https://flagcdn.com/w40/id.png" alt="Bahasa Indonesia" title="Bahasa Indonesia">
        </div>
    </nav>

    <main class="catalog-main">
        @yield('content')
    </main>

    <footer class="catalog-footer">
        &copy; {{ date('Y') }} Perpustakaan Universitas Negeri Gorontalo. All rights reserved.
    </footer>

    @yield('scripts')
</body>
</html>
