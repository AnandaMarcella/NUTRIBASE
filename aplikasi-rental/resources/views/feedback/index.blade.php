@extends('layouts.app')
@section('title','Feedback')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-star me-2 text-primary"></i>Feedback Saya</h4>
    @if($bolehFeedback)
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFeedback">
            <i class="bi bi-plus-lg me-2"></i>Beri Feedback
        </button>
    @else
        <button class="btn btn-secondary" disabled>
            <i class="bi bi-lock me-2"></i>Beri Feedback
        </button>
    @endif
</div>

@if(!$bolehFeedback)
<div class="alert alert-warning d-flex align-items-center gap-3 mb-4">
    <i class="bi bi-exclamation-triangle fs-4"></i>
    <div>
        <div class="fw-semibold">Belum bisa memberi feedback</div>
        <div class="small">Feedback hanya bisa diberikan setelah Anda memiliki <b>pemesanan yang selesai</b>. Selesaikan pemesanan terlebih dahulu.</div>
    </div>
</div>
@endif

@forelse($feedbacks as $f)
<div class="card mb-3">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="fw-bold mb-1">{{ $f->judul }}</h6>
                @if($f->pemesanan)
                    <small class="text-muted"><i class="bi bi-car-front me-1"></i>{{ $f->pemesanan->mobil->nama_mobil ?? '' }} &bull; <code>{{ $f->pemesanan->no_pemesanan }}</code></small>
                @endif
            </div>
            <div class="text-warning">
                @for($i=1;$i<=5;$i++) <i class="bi bi-star{{ $i<=$f->rating ? '-fill' : '' }}"></i> @endfor
            </div>
        </div>
        <p class="text-muted small mb-3">{{ $f->isi }}</p>
        <div class="small text-muted mb-2"><i class="bi bi-clock me-1"></i>{{ $f->created_at->format('d M Y H:i') }}</div>
        @if($f->balasan)
        <div class="p-3" style="background:#f0fdf4;border-radius:10px;border-left:3px solid #22c55e">
            <div class="small fw-bold text-success mb-1"><i class="bi bi-reply me-1"></i>Balasan Admin:</div>
            <p class="small mb-1">{{ $f->balasan }}</p>
            <div class="small text-muted">{{ $f->dibalas_at ? \Carbon\Carbon::parse($f->dibalas_at)->format('d M Y H:i') : '' }}</div>
        </div>
        @else
        <div class="small text-muted p-2" style="background:#f8fafc;border-radius:8px">
            <i class="bi bi-hourglass me-1"></i>Menunggu balasan admin...
        </div>
        @endif
    </div>
</div>
@empty
<div class="card"><div class="card-body text-center py-5">
    <i class="bi bi-star" style="font-size:3rem;color:#e2e8f0"></i>
    <h6 class="text-muted mt-3">Belum ada feedback</h6>
</div></div>
@endforelse

@if($bolehFeedback)
<!-- Modal Tambah Feedback -->
<div class="modal fade" id="addFeedback" tabindex="-1"><div class="modal-dialog"><div class="modal-content border-0" style="border-radius:16px">
    <div class="modal-header border-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-star me-2 text-warning"></i>Beri Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        @if($errors->any())
            <div class="alert alert-danger small py-2">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            @if(count($pemesanans) > 0)
            <div class="mb-3">
                <label class="form-label fw-semibold small">Pemesanan yang Selesai</label>
                <select name="pemesanan_id" class="form-select">
                    <option value="">-- Feedback Umum --</option>
                    @foreach($pemesanans as $pm)
                    <option value="{{ $pm->id }}">{{ $pm->no_pemesanan }} - {{ $pm->mobil->nama_mobil ?? '' }}</option>
                    @endforeach
                </select>
                <div class="form-text">Pilih pemesanan terkait, atau kosongkan untuk feedback umum.</div>
            </div>
            @endif
            <div class="mb-3">
                <label class="form-label fw-semibold small">Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="Ringkasan feedback Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Rating</label>
                <select name="rating" class="form-select">
                    <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                    <option value="4">⭐⭐⭐⭐ Baik</option>
                    <option value="3">⭐⭐⭐ Cukup</option>
                    <option value="2">⭐⭐ Kurang</option>
                    <option value="1">⭐ Sangat Kurang</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small">Isi Feedback</label>
                <textarea name="isi" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda menggunakan layanan kami..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send me-2"></i>Kirim Feedback</button>
        </form>
    </div>
</div></div></div>
@endif

@endsection
