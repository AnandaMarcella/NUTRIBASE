@extends('layouts.app')
@section('title','Kelola Pemesanan')
@section('content')

<div class="topbar">
    <h4><i class="bi bi-calendar-check me-2 text-primary"></i>Kelola Pemesanan</h4>
    <span class="badge bg-primary">{{ $pemesanans->count() }} Total</span>
</div>

{{-- Filter Status --}}
<div class="card mb-4">
    <div class="card-body p-3">
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.pemesanan.index') }}"
               class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-secondary' }}">
                Semua
            </a>
            @foreach(['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] as $s => $c)
            <a href="{{ route('admin.pemesanan.index', ['status'=>$s]) }}"
               class="btn btn-sm {{ request('status')==$s ? 'btn-'.$c : 'btn-outline-'.$c }}">
                {{ ucfirst($s) }}
                <span class="badge bg-white text-dark ms-1">
                    {{ $pemesanans->where('status',$s)->count() }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
</div>

@forelse($pemesanans as $p)
<div class="card mb-3">
    <div class="card-body p-4">
        <div class="row g-3">

            {{-- Info Utama --}}
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width:44px;height:44px;border-radius:12px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-car-front text-primary fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $p->mobil->nama_mobil ?? '-' }}</div>
                        <code class="small text-muted">{{ $p->no_pemesanan }}</code>
                    </div>
                </div>
                <div class="small text-muted">
                    <i class="bi bi-person me-1"></i>{{ $p->user->name ?? '-' }}<br>
                    <i class="bi bi-envelope me-1"></i>{{ $p->user->email ?? '-' }}
                </div>
            </div>

            {{-- Tanggal & Harga --}}
            <div class="col-md-3">
                <div class="small text-muted mb-1">Periode Sewa</div>
                <div class="small fw-semibold">
                    {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}<br>
                    s/d {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                </div>
                <div class="small text-muted mt-1">{{ $p->durasi_hari }} hari</div>
                <div class="fw-bold text-success mt-1">Rp {{ number_format($p->total_harga,0,',','.') }}</div>
            </div>

            {{-- Status Pemesanan --}}
            <div class="col-md-2">
                <div class="small text-muted mb-2">Status Pemesanan</div>
                @php $sc=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                <span class="badge bg-{{ $sc[$p->status] ?? 'secondary' }} mb-2 d-block" style="width:fit-content">
                    {{ ucfirst($p->status) }}
                </span>

                {{-- Status Pembayaran --}}
                <div class="small text-muted mb-1">Status Bayar</div>
                @if($p->pembayaran)
                    @php $bc=['menunggu'=>'warning','dikonfirmasi'=>'success','ditolak'=>'danger'] @endphp
                    <span class="badge bg-{{ $bc[$p->pembayaran->status] ?? 'secondary' }}" style="width:fit-content">
                        {{ ucfirst($p->pembayaran->status) }}
                    </span>
                    <div class="small text-muted mt-1">{{ str_replace('_',' ',ucwords($p->pembayaran->metode,'_')) }}</div>
                @else
                    <span class="badge bg-secondary" style="width:fit-content">Belum Bayar</span>
                @endif
            </div>

            {{-- Aksi --}}
            <div class="col-md-3">
                <div class="small text-muted fw-bold mb-2">Aksi Admin</div>

                {{-- Konfirmasi Pembayaran (kalau ada pembayaran menunggu) --}}
                @if($p->pembayaran && $p->pembayaran->status === 'menunggu')
                <div class="mb-2 p-2" style="background:#fffbeb;border-radius:8px;border:1px solid #fcd34d">
                    <div class="small fw-semibold text-warning mb-2"><i class="bi bi-exclamation-triangle me-1"></i>Ada bukti transfer</div>
                    <form action="{{ route('admin.pembayaran.konfirmasi', $p->pembayaran->id) }}" method="POST" class="d-flex gap-1">
                        @csrf
                        <button name="status_bayar" value="dikonfirmasi" class="btn btn-success btn-sm flex-fill"
                            onclick="return confirm('Konfirmasi pembayaran ini?')">
                            <i class="bi bi-check-lg"></i> Terima
                        </button>
                        <button name="status_bayar" value="ditolak" class="btn btn-danger btn-sm flex-fill"
                            onclick="return confirm('Tolak pembayaran ini?')">
                            <i class="bi bi-x-lg"></i> Tolak
                        </button>
                    </form>
                </div>
                @endif

                {{-- Update Status Pemesanan --}}
                <form action="{{ route('admin.pemesanan.status', $p->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select form-select-sm mb-2">
                        @foreach(['pending','dikonfirmasi','selesai','dibatalkan'] as $s)
                        <option value="{{ $s }}" {{ $p->status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm w-100"
                        onclick="return confirm('Ubah status pemesanan ini?')">
                        <i class="bi bi-arrow-repeat me-1"></i>Update Status
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@empty
<div class="card"><div class="card-body text-center py-5">
    <i class="bi bi-calendar-x" style="font-size:3rem;color:#e2e8f0"></i>
    <h6 class="text-muted mt-3">Tidak ada pemesanan</h6>
</div></div>
@endforelse

@endsection
