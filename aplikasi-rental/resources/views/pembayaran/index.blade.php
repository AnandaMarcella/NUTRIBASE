@extends('layouts.app')
@section('title','Pembayaran')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-credit-card me-2 text-primary"></i>Pembayaran</h4>
</div>

@forelse($pemesanans as $p)
<div class="card mb-3">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:48px;height:48px;border-radius:12px;background:#eff6ff;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-car-front text-primary fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $p->mobil->nama_mobil ?? '-' }}</div>
                        <code class="small text-muted">{{ $p->no_pemesanan }}</code>
                        <div class="small text-muted mt-1">
                            {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }} &ndash;
                            {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                            ({{ $p->durasi_hari }} hari)
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="fw-bold text-success fs-5">Rp {{ number_format($p->total_harga,0,',','.') }}</div>
                @php $sc=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                <span class="badge bg-{{ $sc[$p->status] ?? 'secondary' }} mt-1">{{ ucfirst($p->status) }}</span>
                @if($p->pembayaran)
                    <div class="mt-1">
                        @php $bc=['menunggu'=>'warning','dikonfirmasi'=>'success','ditolak'=>'danger'] @endphp
                        <span class="badge bg-{{ $bc[$p->pembayaran->status] ?? 'secondary' }} text-dark">
                            Bayar: {{ ucfirst($p->pembayaran->status) }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ route('pembayaran.detail', $p->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-credit-card me-1"></i>Bayar / Detail
                </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="card"><div class="card-body text-center py-5">
    <i class="bi bi-credit-card" style="font-size:3rem;color:#e2e8f0"></i>
    <h6 class="text-muted mt-3">Tidak ada pemesanan yang perlu dibayar</h6>
    <a href="{{ route('pesan.index') }}" class="btn btn-primary mt-2">Pesan Mobil Sekarang</a>
</div></div>
@endforelse
@endsection
