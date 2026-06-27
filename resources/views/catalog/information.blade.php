@extends('layouts.catalog')

@section('title', __('catalog.library_info') . ' - Katalog Online')

@section('content')
<!-- Search Header -->
@php
    $catalogBg = \App\Models\Setting::where('key', 'catalog_bg_image')->first();
    $bgUrl = ($catalogBg && $catalogBg->value) ? Storage::url($catalogBg->value) : 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
@endphp
<div style="background-image: url('{{ $bgUrl }}'); background-size: cover; background-position: center; padding: 120px 20px 40px; position: relative; text-align: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
    <div style="max-width: 800px; margin: 0 auto; position: relative; z-index: 10;">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 2rem; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ __('catalog.library_info') }}</h1>
        <form action="{{ route('katalog.search') }}" method="GET" style="display: flex; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <input type="text" name="keyword" placeholder="{{ __('nav.search_placeholder') }}" style="flex: 1; padding: 1.2rem 1.5rem; border: none; font-size: 1.1rem; outline: none; font-family: 'Outfit', sans-serif;" value="{{ request('keyword') }}">
            <button type="submit" style="background: white; border: none; padding: 0 1.5rem; cursor: pointer; color: #64748b; font-size: 1.2rem;">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>
</div>

<div style="max-width: 900px; margin: 3rem auto; padding: 0 2rem; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding-bottom: 4rem;">
    <div style="padding-top: 2rem; margin-bottom: 2rem;">
        <h2 style="font-size: 2rem; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 2rem;">{{ __('catalog.library_info') }}</h2>

        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 2rem;">
            <h2 style="color: #1e293b; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #3b82f6; padding-bottom: 0.5rem; display: inline-block;"><i class="fa-solid fa-map-location-dot" style="color: #3b82f6; margin-right: 8px;"></i> {{ __('catalog.library_info') }}</h2>
            <div style="display: grid; gap: 1rem; color: #475569;">
                <div><strong style="color: #334155; display: inline-block; width: 100px;">{{ __('catalog.address') }}</strong> : Jl. Jenderal Sudirman No.6, Kota Gorontalo</div>
                <div><strong style="color: #334155; display: inline-block; width: 100px;">{{ __('catalog.postal_code') }}</strong> : 96128</div>
                <div><strong style="color: #334155; display: inline-block; width: 100px;">{{ __('catalog.phone') }}</strong> : (0435) 821125</div>
                <div><strong style="color: #334155; display: inline-block; width: 100px;">{{ __('catalog.fax') }}</strong> : (0435) 821752</div>
            </div>
        </div>

        <!-- Jam Buka -->
        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 2rem;">
            <h2 style="color: #1e293b; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #3b82f6; padding-bottom: 0.5rem; display: inline-block;"><i class="fa-regular fa-clock" style="color: #3b82f6; margin-right: 8px;"></i> {{ __('catalog.service_hours') }}</h2>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 1rem; color: #334155;">{{ __('catalog.mon_thu') }}</th>
                    <td style="padding: 1rem; color: #475569;">08.00 - 16.00 WITA</td>
                </tr>
                <tr style="border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
                    <th style="padding: 1rem; color: #334155;">{{ __('catalog.friday') }}</th>
                    <td style="padding: 1rem; color: #475569;">08.00 - 16.30 WITA</td>
                </tr>
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 1rem; color: #334155;">{{ __('catalog.break') }} (Jumat)</th>
                    <td style="padding: 1rem; color: #475569;">11.30 - 13.30 WITA</td>
                </tr>
                <tr>
                    <th style="padding: 1rem; color: #ef4444;">Sabtu - Minggu</th>
                    <td style="padding: 1rem; color: #ef4444; font-weight: 500;">{{ __('catalog.closed') }}</td>
                </tr>
            </table>
        </div>

        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; margin-bottom: 2rem;">
            <h2 style="color: #1e293b; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #10b981; padding-bottom: 0.5rem; display: inline-block;"><i class="fa-solid fa-layer-group" style="color: #10b981; margin-right: 8px;"></i> {{ __('catalog.collection_details') }}</h2>
            <p style="color: #475569; line-height: 1.6; margin-bottom: 1.5rem;">
                {{ __('catalog.collection_desc') }}
            </p>
            <ul style="color: #475569; line-height: 1.8; padding-left: 1.2rem;">
                <li><strong>{{ __('catalog.printed_book') }}</strong></li>
                <li><strong>{{ __('catalog.ebook') }}</strong></li>
                <li><strong>{{ __('catalog.journal') }}</strong></li>
                <li><strong>{{ __('catalog.reference') }}</strong> (Kamus, Ensiklopedia, Direktori)</li>
            </ul>
        </div>

        <!-- Syarat Keanggotaan -->
        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
            <h2 style="color: #1e293b; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #10b981; padding-bottom: 0.5rem; display: inline-block;"><i class="fa-solid fa-id-card" style="color: #10b981; margin-right: 8px;"></i> {{ __('catalog.membership') }}</h2>
            <ul style="color: #475569; line-height: 1.8; padding-left: 1.2rem; margin: 0;">
                <li>{{ __('catalog.membership_1') }}</li>
                <li>{{ __('catalog.membership_2') }}</li>
                <li>{{ __('catalog.membership_3') }}</li>
                <li>{{ __('catalog.membership_4') }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
