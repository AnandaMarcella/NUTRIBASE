@extends('layouts.app')
@section('title','Dashboard')
@section('content')

@if($user->isAdmin())
<div class="topbar">
    <h4><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard Admin</h4>
    <span class="badge bg-primary badge-role">Administrator</span>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#1a56db,#1e3a8a)">
        <div class="small opacity-75 mb-1">Total Mobil</div>
        <div class="h2 fw-bold mb-0">{{ $data['totalMobil'] }}</div>
        <i class="bi bi-car-front" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#059669,#065f46)">
        <div class="small opacity-75 mb-1">Total Customer</div>
        <div class="h2 fw-bold mb-0">{{ $data['totalUser'] }}</div>
        <i class="bi bi-people" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#d97706,#92400e)">
        <div class="small opacity-75 mb-1">Total Pemesanan</div>
        <div class="h2 fw-bold mb-0">{{ $data['totalPemesanan'] }}</div>
        <i class="bi bi-calendar-check" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#dc2626,#7f1d1d)">
        <div class="small opacity-75 mb-1">Feedback Belum Dibalas</div>
        <div class="h2 fw-bold mb-0">{{ $data['pendingFeedback'] }}</div>
        <i class="bi bi-chat-dots" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
</div>
<div class="card"><div class="card-body">
    <h6 class="fw-bold mb-3">Pemesanan Terbaru</h6>
    <div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead><tr><th>No. Pemesanan</th><th>Customer</th><th>Mobil</th><th>Tanggal</th><th>Status</th></tr></thead>
        <tbody>
        @forelse($data['pemesananTerbaru'] as $p)
        <tr>
            <td><code class="text-primary">{{ $p->no_pemesanan }}</code></td>
            <td>{{ $p->user->name ?? '-' }}</td>
            <td>{{ $p->mobil->nama_mobil ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</td>
            <td>
                @php $colors=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                <span class="badge bg-{{ $colors[$p->status] ?? 'secondary' }}">{{ ucfirst($p->status) }}</span>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pemesanan</td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
</div></div>

@elseif($user->isOwner())
<div class="topbar">
    <h4><i class="bi bi-speedometer2 me-2 text-success"></i>Dashboard Owner</h4>
    <span class="badge bg-success badge-role">Owner</span>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#059669,#065f46)">
        <div class="small opacity-75 mb-1">Total Pendapatan</div>
        <div class="h3 fw-bold mb-0">Rp {{ number_format($data['totalPendapatan'],0,',','.') }}</div>
        <i class="bi bi-cash-stack" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#1a56db,#1e3a8a)">
        <div class="small opacity-75 mb-1">Total Pemesanan</div>
        <div class="h2 fw-bold mb-0">{{ $data['totalPemesanan'] }}</div>
        <i class="bi bi-calendar3" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#d97706,#92400e)">
        <div class="small opacity-75 mb-1">Pemesanan Bulan Ini</div>
        <div class="h2 fw-bold mb-0">{{ $data['pemesananBulanIni'] }}</div>
        <i class="bi bi-graph-up" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
</div>
<div class="row g-3">
    <div class="col-md-4"><div class="card p-4 text-center"><div class="h3 fw-bold text-success mb-0">{{ $data['selesai'] ?? 0 }}</div><small class="text-muted">Pemesanan Selesai</small></div></div>
    <div class="col-md-4"><div class="card p-4 text-center"><div class="h3 fw-bold text-primary mb-0">{{ $data['mobilTersedia'] }}</div><small class="text-muted">Mobil Tersedia</small></div></div>
    <div class="col-md-4"><div class="card p-4 text-center"><div class="h3 fw-bold text-danger mb-0">{{ $data['pendingFeedback'] }}</div><small class="text-muted">Feedback Belum Dibalas</small></div></div>
</div>

@else
<div class="topbar">
    <h4><i class="bi bi-speedometer2 me-2 text-warning"></i>Dashboard</h4>
    <span class="badge bg-warning text-dark badge-role">Customer</span>
</div>
<div class="alert" style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px">
    <h6 class="fw-bold mb-1"><i class="bi bi-hand-wave me-2"></i>Halo, {{ $user->name }}!</h6>
    <p class="mb-0 text-muted small">Selamat datang di Rental Ananda. Mulai pesan mobil untuk perjalanan Anda.</p>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#1a56db,#1e3a8a)">
        <div class="small opacity-75 mb-1">Total Pemesanan</div>
        <div class="h2 fw-bold mb-0">{{ $data['totalPemesanan'] }}</div>
        <i class="bi bi-calendar-check" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#d97706,#92400e)">
        <div class="small opacity-75 mb-1">Sedang Aktif</div>
        <div class="h2 fw-bold mb-0">{{ $data['aktif'] }}</div>
        <i class="bi bi-clock" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-4"><div class="stat-card" style="background:linear-gradient(135deg,#059669,#065f46)">
        <div class="small opacity-75 mb-1">Selesai</div>
        <div class="h2 fw-bold mb-0">{{ $data['selesai'] }}</div>
        <i class="bi bi-check2-circle" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4"><a href="{{ route('pesan.index') }}" class="card text-decoration-none h-100">
        <div class="card-body text-center p-4"><div class="mb-3" style="width:56px;height:56px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto"><i class="bi bi-calendar-plus text-primary fs-4"></i></div><h6 class="fw-bold mb-1 text-dark">Pesan Mobil</h6><p class="text-muted small mb-0">Pilih mobil favoritmu</p></div>
    </a></div>
    <div class="col-md-4"><a href="{{ route('pembayaran.index') }}" class="card text-decoration-none h-100">
        <div class="card-body text-center p-4"><div class="mb-3" style="width:56px;height:56px;background:#f0fdf4;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto"><i class="bi bi-credit-card text-success fs-4"></i></div><h6 class="fw-bold mb-1 text-dark">Bayar</h6><p class="text-muted small mb-0">Konfirmasi pembayaran</p></div>
    </a></div>
    <div class="col-md-4"><a href="{{ route('histori.index') }}" class="card text-decoration-none h-100">
        <div class="card-body text-center p-4"><div class="mb-3" style="width:56px;height:56px;background:#fffbeb;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto"><i class="bi bi-clock-history text-warning fs-4"></i></div><h6 class="fw-bold mb-1 text-dark">Histori</h6><p class="text-muted small mb-0">Riwayat pemesanan</p></div>
    </a></div>
</div>
@if(count($data['pemesananTerbaru']) > 0)
<div class="card"><div class="card-body">
    <h6 class="fw-bold mb-3">Pemesanan Terbaru</h6>
    @foreach($data['pemesananTerbaru'] as $p)
    <div class="d-flex align-items-center gap-3 mb-3 p-3" style="background:#f8fafc;border-radius:10px">
        <div style="width:44px;height:44px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center">
            <i class="bi bi-car-front text-primary"></i>
        </div>
        <div class="flex-grow-1">
            <div class="fw-semibold small">{{ $p->mobil->nama_mobil ?? '-' }}</div>
            <div class="text-muted" style="font-size:.75rem">{{ $p->no_pemesanan }}</div>
        </div>
        @php $colors=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
        <span class="badge bg-{{ $colors[$p->status] ?? 'secondary' }}">{{ ucfirst($p->status) }}</span>
    </div>
    @endforeach
</div></div>
@endif
@endif

@endsection
