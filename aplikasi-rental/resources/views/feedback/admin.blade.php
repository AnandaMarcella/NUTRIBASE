@extends('layouts.app')
@section('title','Kelola Feedback')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-chat-dots me-2 text-primary"></i>Tanggapi Feedback Customer</h4>
    <span class="badge bg-danger">{{ $feedbacks->whereNull('balasan')->count() }} belum dibalas</span>
</div>

@forelse($feedbacks as $f)
<div class="card mb-3 {{ !$f->balasan ? 'border-warning' : '' }}">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="fw-bold mb-1">{{ $f->judul }}</h6>
                <div class="small text-muted">
                    <i class="bi bi-person me-1"></i>{{ $f->user->name ?? '-' }} &bull;
                    {{ $f->created_at->format('d M Y H:i') }}
                    @if($f->pemesanan) &bull; <code>{{ $f->pemesanan->no_pemesanan }}</code>@endif
                </div>
            </div>
            <div>
                <div class="text-warning mb-1">
                    @for($i=1;$i<=5;$i++) <i class="bi bi-star{{ $i<=$f->rating ? '-fill' : '' }}"></i> @endfor
                </div>
                @if(!$f->balasan)<span class="badge bg-warning text-dark">Belum Dibalas</span>
                @else<span class="badge bg-success">Sudah Dibalas</span>@endif
            </div>
        </div>
        <p class="text-muted mb-3">{{ $f->isi }}</p>

        @if($f->balasan)
        <div class="p-3 mb-3" style="background:#f0fdf4;border-radius:10px;border-left:3px solid #22c55e">
            <div class="small fw-bold text-success mb-1"><i class="bi bi-reply me-1"></i>Balasan Anda:</div>
            <p class="small mb-0">{{ $f->balasan }}</p>
        </div>
        @endif

        @if(!$f->balasan)
        <form action="{{ route('feedback.balas', $f->id) }}" method="POST">
            @csrf
            <div class="d-flex gap-2">
                <textarea name="balasan" class="form-control form-control-sm" rows="2" placeholder="Tulis balasan..." required></textarea>
                <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-send"></i></button>
            </div>
        </form>
        @endif
    </div>
</div>
@empty
<div class="card"><div class="card-body text-center py-5">
    <i class="bi bi-chat-dots" style="font-size:3rem;color:#e2e8f0"></i>
    <h6 class="text-muted mt-3">Belum ada feedback</h6>
</div></div>
@endforelse
@endsection
