@extends('layouts.catalog')

@section('title', 'Bantuan - Katalog Online')

@section('content')
<!-- Search Header -->
@php
    $catalogBg = \App\Models\Setting::where('key', 'catalog_bg_image')->first();
    $bgUrl = ($catalogBg && $catalogBg->value) ? Storage::url($catalogBg->value) : 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
@endphp
<div style="background-image: url('{{ $bgUrl }}'); background-size: cover; background-position: center; padding: 120px 20px 40px; position: relative; text-align: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
    <div style="max-width: 800px; margin: 0 auto; position: relative; z-index: 10;">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 2rem; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ __('catalog.help') }}</h1>
        <form action="{{ route('katalog.search') }}" method="GET" style="display: flex; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <input type="text" name="keyword" placeholder="{{ __('nav.search_placeholder') }}" style="flex: 1; padding: 1.2rem 1.5rem; border: none; font-size: 1.1rem; outline: none; font-family: 'Outfit', sans-serif;" value="{{ request('keyword') }}">
            <button type="submit" style="background: white; border: none; padding: 0 1.5rem; cursor: pointer; color: #64748b; font-size: 1.2rem;">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>
</div>

<div style="max-width: 900px; margin: 3rem auto; padding: 0 2rem; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding-bottom: 4rem;">
    <h2 style="font-size: 2rem; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 2rem; padding-top: 2rem;">{{ __('catalog.help') }}</h2>

    <div style="margin-bottom: 2rem;">
        <h3 style="font-size: 1.5rem; color: #334155; margin-bottom: 0.5rem;">{{ __('catalog.simple_search') }}</h3>
        <p style="margin: 0 0 1rem; color: #475569; font-size: 1rem; line-height: 1.6;">{{ __('catalog.simple_search_desc') }}</p>
        <h3 style="font-size: 1.5rem; color: #334155; margin-bottom: 0.5rem; margin-top: 2rem;">{{ __('catalog.specific_search') }}</h3>
        <p style="margin: 0 0 0.5rem; color: #475569; font-size: 1rem; line-height: 1.6;">{{ __('catalog.specific_search_desc') }}</p>
    </div>
</div>
@endsection
