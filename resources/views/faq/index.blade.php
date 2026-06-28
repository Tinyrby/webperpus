@extends('layouts.main')

@section('main-class', 'no-hero')

@section('content')
<div class="faq-container">
    <div class="faq-sidebar">
        <a href="{{ route('home') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
        <div class="faq-list">
            @forelse($faqs as $index => $faq)
                <button class="faq-item-btn {{ $index === 0 ? 'active' : '' }}" 
                        data-question="{{ $faq->question }}" 
                        data-answer="{{ $faq->answer }}">
                    {{ $faq->question }}
                </button>
            @empty
                <p style="color: var(--text-muted); font-style: italic;">Belum ada FAQ yang tersedia.</p>
            @endforelse
        </div>
    </div>
    
    <div class="faq-content">
        <h2 id="active-question" class="faq-active-title">
            {{ $faqs->first()->question ?? 'Belum ada FAQ' }}
        </h2>
        <div id="active-answer" class="faq-active-answer">
            {!! $faqs->first()->answer ?? 'Silakan pilih pertanyaan dari menu di sebelah kiri.' !!}
        </div>
        
        @if($faqs->isNotEmpty())
            <div class="faq-feedback">
                <span class="feedback-btn" onclick="giveFeedback('helpful')">
                    <i class="fa-regular fa-thumbs-up"></i> Membantu
                </span>
                <span class="feedback-divider">|</span>
                <span class="feedback-btn" onclick="giveFeedback('not-helpful')">
                    <i class="fa-regular fa-thumbs-down"></i> Tidak Membantu
                </span>
            </div>
        @endif
    </div>
</div>

<style>
    .faq-container {
        display: flex;
        max-width: 1200px;
        margin: 4rem auto;
        padding: 0 2rem;
        gap: 3rem;
        min-height: 450px;
    }

    .faq-sidebar {
        flex: 1;
        max-width: 320px;
        border-right: 1px solid #e2e8f0;
        padding-right: 2rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-light, #3b82f6);
        font-weight: 500;
        margin-bottom: 2rem;
        font-size: 0.95rem;
        transition: var(--transition, all 0.3s ease);
    }

    .back-link:hover {
        color: var(--primary-dark, #1e3a8a);
        transform: translateX(-3px);
    }

    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .faq-item-btn {
        background: none;
        border: none;
        text-align: left;
        padding: 1rem 0;
        font-size: 0.95rem;
        color: var(--text-muted, #64748b);
        font-family: inherit;
        cursor: pointer;
        border-bottom: 1px solid #f1f5f9;
        transition: var(--transition, all 0.3s ease);
        line-height: 1.5;
        width: 100%;
    }

    .faq-item-btn:hover {
        color: var(--primary-light, #3b82f6);
        padding-left: 5px;
    }

    .faq-item-btn.active {
        color: var(--text-main, #0f172a);
        font-weight: 600;
        border-bottom-color: var(--primary-light, #3b82f6);
    }

    .faq-content {
        flex: 2.5;
        padding-left: 1rem;
    }

    .faq-active-title {
        font-size: 1.8rem;
        color: var(--text-main, #0f172a);
        font-weight: 600;
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .faq-active-answer {
        font-size: 1.05rem;
        color: var(--text-muted, #64748b);
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .faq-feedback {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
        color: var(--text-muted, #64748b);
        font-size: 0.9rem;
    }

    .feedback-btn {
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: var(--transition, all 0.3s ease);
    }

    .feedback-btn:hover {
        color: var(--primary-light, #3b82f6);
    }

    .feedback-divider {
        color: #e2e8f0;
    }

    @media (max-width: 768px) {
        .faq-container {
            flex-direction: column;
            gap: 2rem;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .faq-sidebar {
            max-width: 100%;
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
            padding-right: 0;
            padding-bottom: 1.5rem;
        }
        
        .faq-content {
            padding-left: 0;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.faq-item-btn');
        const activeQuestion = document.getElementById('active-question');
        const activeAnswer = document.getElementById('active-answer');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Hapus kelas aktif dari semua tombol
                buttons.forEach(btn => btn.classList.remove('active'));

                // Tambahkan kelas aktif pada tombol yang diklik
                this.classList.add('active');

                // Update konten di sebelah kanan secara dinamis
                activeQuestion.textContent = this.getAttribute('data-question');
                activeAnswer.innerHTML = this.getAttribute('data-answer');
            });
        });
    });

    function giveFeedback(type) {
        // Tampilkan notifikasi umpan balik sederhana yang elegan
        alert('Terima kasih atas masukan Anda!');
    }
</script>
@endsection
