@extends('layouts.app')
@section('title','Laporan')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-bar-chart-line me-2 text-success"></i>Laporan Bisnis</h4>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Bulan</label>
                <select name="bulan" class="form-select form-select-sm">
                    @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ $b == $bulan ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($b)->locale('id')->monthName }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold small">Tahun</label>
                <select name="tahun" class="form-select form-select-sm">
                    @foreach(range(2024, date('Y')+1) as $t)
                    <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#059669,#065f46)">
        <div class="small opacity-75 mb-1">Total Pendapatan</div>
        <div class="h4 fw-bold mb-0">Rp {{ number_format($totalPendapatan,0,',','.') }}</div>
        <i class="bi bi-cash-stack" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#1a56db,#1e3a8a)">
        <div class="small opacity-75 mb-1">Total Pemesanan</div>
        <div class="h2 fw-bold mb-0">{{ $totalPemesanan }}</div>
        <i class="bi bi-calendar3" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#d97706,#92400e)">
        <div class="small opacity-75 mb-1">Pemesanan Selesai</div>
        <div class="h2 fw-bold mb-0">{{ $selesai }}</div>
        <i class="bi bi-check-circle" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
    <div class="col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,#dc2626,#7f1d1d)">
        <div class="small opacity-75 mb-1">Masih Pending</div>
        <div class="h2 fw-bold mb-0">{{ $pending }}</div>
        <i class="bi bi-hourglass" style="position:absolute;right:16px;top:16px;font-size:1.8rem;opacity:.3"></i>
    </div></div>
</div>

<div class="row g-4">
    <!-- Mobil Terpopuler -->
    <div class="col-md-4">
        <div class="card h-100"><div class="card-body p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-trophy me-2 text-warning"></i>Mobil Terpopuler</h6>
            @forelse($mobilPopuler as $i => $mp)
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:28px;height:28px;border-radius:50%;background:{{ ['#fbbf24','#94a3b8','#d97706'][$i] ?? '#e2e8f0' }};display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff">{{ $i+1 }}</div>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">{{ $mp->mobil->nama_mobil ?? '-' }}</div>
                </div>
                <div class="badge bg-primary">{{ $mp->total }}x</div>
            </div>
            @empty
            <p class="text-muted small">Belum ada data</p>
            @endforelse
        </div></div>
    </div>

    <!-- Detail Pemesanan -->
    <div class="col-md-8">
        <div class="card"><div class="card-body p-0">
            <div class="p-4 border-bottom"><h6 class="fw-bold mb-0"><i class="bi bi-list-ul me-2 text-primary"></i>Detail Pemesanan Bulan Ini</h6></div>
            <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th class="px-4">No. Pemesanan</th><th>Customer</th><th>Mobil</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                @forelse($pemesanans as $p)
                <tr>
                    <td class="px-4"><code class="text-primary small">{{ $p->no_pemesanan }}</code></td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->mobil->nama_mobil ?? '-' }}</td>
                    <td class="fw-semibold text-success">Rp {{ number_format($p->total_harga,0,',','.') }}</td>
                    <td>
                        @php $sc=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                        <span class="badge bg-{{ $sc[$p->status] ?? 'secondary' }}">{{ ucfirst($p->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada data bulan ini</td></tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div></div>
    </div>
</div>
@endsection
