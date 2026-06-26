<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Perpustakaan UNG</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-main); }
        .form-control { width: 100%; padding: 0.75rem 1rem; border: 1px solid rgba(0,0,0,0.1); border-radius: var(--radius-md); font-family: inherit; font-size: 1rem; outline: none; transition: var(--transition); }
        .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .btn { padding: 0.6rem 1.5rem; border: none; border-radius: var(--radius-md); font-weight: 600; cursor: pointer; transition: var(--transition); display: inline-block; }
        .btn-primary { background-color: var(--primary-color); color: white; }
        .btn-primary:hover { background-color: var(--primary-dark); }
        .btn-danger { background-color: #ef4444; color: white; }
        .btn-danger:hover { background-color: #dc2626; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.85rem; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; }
    </style>
</head>
<body class="admin-layout">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UNG" style="height: 40px;">
            Admin Perpus
        </div>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="{{ route('admin.facilities.index') }}" class="admin-nav-item {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}"><i class="fa-solid fa-building"></i> Fasilitas</a>
            <a href="{{ route('admin.members.index') }}" class="admin-nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Data Keanggotaan</a>
            <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Kategori / Subjek</a>
            <a href="{{ route('admin.books.index') }}" class="admin-nav-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Katalog Buku</a>
            <a href="{{ route('admin.loans.index') }}" class="admin-nav-item {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}"><i class="fa-solid fa-book-open-reader"></i> Data Pinjaman</a>
            <a href="{{ route('admin.book-suggestions.index') }}" class="admin-nav-item {{ request()->routeIs('admin.book-suggestions.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope-open-text"></i> Usulan Buku</a>
            <a href="{{ route('admin.feedbacks.index') }}" class="admin-nav-item {{ request()->routeIs('admin.feedbacks.*') ? 'active' : '' }}"><i class="fa-solid fa-comments"></i> Saran & Masukan</a>
            <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="fa-solid fa-gear"></i> Pengaturan Web</a>
            
            <div style="padding: 1rem 2rem; color: #9ca3af; font-size: 0.8rem; font-weight: 600; margin-top: 1rem;">LAINNYA</div>
            <a href="#" class="admin-nav-item"><i class="fa-solid fa-book"></i> Katalog Buku</a>
            <a href="#" class="admin-nav-item"><i class="fa-solid fa-users"></i> Keanggotaan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="admin-header-title">@yield('page_title', 'Dashboard')</div>
            
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="admin-user">
                    <div class="admin-user-avatar">AD</div>
                    <span>Admin Utama</span>
                </div>
                <a href="{{ url('/') }}" target="_blank" class="btn btn-sm" style="border: 1px solid var(--primary-color); color: var(--primary-color);">Lihat Web</a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="admin-content">
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>
