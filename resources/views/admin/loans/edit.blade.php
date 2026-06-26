@extends('layouts.admin')

@section('title', 'Edit Pinjaman')

@section('content')
<div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.loans.index') }}" style="color: #64748b; margin-right: 15px; text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <h2 style="margin: 0; color: #1e293b;">Edit Data Pinjaman</h2>
</div>

<div class="card" style="max-width: 600px;">
    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.loans.update', $loan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Anggota / Mahasiswa</label>
            <select name="member_id" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id', $loan->member_id) == $member->id ? 'selected' : '' }}>{{ $member->nim }} - {{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Buku</label>
            <select name="book_id" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id', $loan->book_id) == $book->id ? 'selected' : '' }}>{{ $book->title }} ({{ $book->author }})</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tanggal Pinjam</label>
                <input type="date" name="borrow_date" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('borrow_date', $loan->borrow_date) }}" required>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Tanggal Kembali</label>
                <input type="date" name="due_date" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" value="{{ old('due_date', $loan->due_date) }}" required>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #475569;">Status</label>
            <select name="status" class="form-control" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 4px;" required>
                <option value="Dipinjam" {{ old('status', $loan->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ old('status', $loan->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <div>
            <button type="submit" style="background-color: var(--primary-color); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; cursor: pointer;">Update Data</button>
        </div>
    </form>
</div>
@endsection
