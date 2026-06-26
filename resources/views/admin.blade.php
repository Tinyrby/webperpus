@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-building"></i></div>
        <div class="stat-info">
            <h3>Total Fasilitas</h3>
            <p>{{ \App\Models\Facility::count() }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;"><i class="fa-solid fa-image"></i></div>
        <div class="stat-info">
            <h3>Hero Image</h3>
            <p>{{ \App\Models\Setting::where('key', 'hero_image')->exists() ? 'Disesuaikan' : 'Default' }}</p>
        </div>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3 style="font-weight: 600; color: var(--primary-dark);">Selamat Datang di Pengelolaan Konten</h3>
    </div>
    <p style="color: var(--text-muted); margin-bottom: 1rem;">
        Gunakan menu di sebelah kiri untuk mengelola konten halaman utama:
    </p>
    <ul style="list-style: disc; margin-left: 1.5rem; color: var(--text-muted); line-height: 2;">
        <li><strong>Fasilitas:</strong> Menambah, mengubah, dan menghapus gambar fasilitas.</li>
        <li><strong>Pengaturan Web:</strong> Mengubah gambar latar belakang (Hero Image) halaman utama.</li>
    </ul>
</div>
@endsection
