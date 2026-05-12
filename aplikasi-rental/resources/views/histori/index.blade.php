@extends('layouts.app')
@section('title','Histori Pemesanan')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-clock-history me-2 text-primary"></i>Histori Pemesanan</h4>
</div>

@forelse($pemesanans as $p)
<div class="card mb-3">
    <div class="card-body p-4">
        <div class="row align-items-center g-3">
            <div class="col-md-1 text-center">
                <div style="width:44px;height:44px;border-radius:12px;background:#eff6ff;display:flex;align-items:center;justify-content:center;margin:0 auto">
                    <i class="bi bi-car-front text-primary"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fw-bold">{{ $p->mobil->nama_mobil ?? '-' }}</div>
                <code class="small text-muted">{{ $p->no_pemesanan }}</code>
            </div>
            <div class="col-md-3">
                <div class="small text-muted">Periode Sewa</div>
                <div class="small fw-semibold">
                    {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }} &ndash;
                    {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                </div>
                <div class="small text-muted">{{ $p->durasi_hari }} hari</div>
            </div>
            <div class="col-md-2">
                <div class="fw-bold text-success">Rp {{ number_format($p->total_harga,0,',','.') }}</div>
                @php $bc=['menunggu'=>'warning text-dark','dikonfirmasi'=>'success','ditolak'=>'danger'] @endphp
                @if($p->pembayaran)
                <span class="badge bg-{{ $bc[$p->pembayaran->status] ?? 'secondary' }} mt-1" style="font-size:.7rem">
                    Bayar: {{ ucfirst($p->pembayaran->status) }}
                </span>
                @endif
            </div>
            <div class="col-md-2 text-end">
                @php $sc=['pending'=>'warning text-dark','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                <span class="badge bg-{{ $sc[$p->status] ?? 'secondary' }} d-block mb-2">{{ ucfirst($p->status) }}</span>
                @if(!$p->pembayaran && in_array($p->status, ['pending','dikonfirmasi']))
                <a href="{{ route('pembayaran.detail', $p->id) }}" class="btn btn-sm btn-outline-primary">Bayar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<div class="card"><div class="card-body text-center py-5">
    <i class="bi bi-clock-history" style="font-size:3rem;color:#e2e8f0"></i>
    <h6 class="text-muted mt-3">Belum ada riwayat pemesanan</h6>
    <a href="{{ route('pesan.index') }}" class="btn btn-primary mt-2 btn-sm">Pesan Mobil Sekarang</a>
</div></div>
@endforelse
@endsection
