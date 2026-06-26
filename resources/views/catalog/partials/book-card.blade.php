<div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: white; transition: transform 0.2s, box-shadow 0.2s; height: 100%; display: flex; flex-direction: column; cursor: pointer;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
    <div style="position: relative; padding-top: 140%; background: #f8fafc;">
        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        @else
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; color: #94a3b8; border-bottom: 1px solid #e2e8f0;">
                <i class="fa-solid fa-book" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <span style="font-size: 0.8rem;">BOOK COVER</span>
            </div>
        @endif
        
        <!-- Badge Type -->
        <span style="position: absolute; bottom: 10px; left: 10px; background: rgba(255,255,255,0.9); padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; color: #475569; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><i class="fa-solid fa-book-open"></i> TEXT</span>
    </div>
    
    <div style="padding: 1rem; display: flex; flex-direction: column; flex: 1;">
        <h4 style="margin: 0 0 0.5rem; font-size: 0.95rem; font-weight: 600; color: #1e293b; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $book->title }}
        </h4>
        <p style="margin: 0; font-size: 0.85rem; color: #64748b; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $book->author ?? 'Pengarang Tidak Diketahui' }}<br>
            {{ $book->publisher ?? 'Penerbit Tidak Diketahui' }}
        </p>
    </div>
</div>
