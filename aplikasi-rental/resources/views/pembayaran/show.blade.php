@extends('layouts.app')
@section('title','Detail Pembayaran')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-credit-card me-2 text-primary"></i>Detail Pembayaran</h4>
    <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <!-- Info Pemesanan -->
        <div class="card mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-receipt me-2 text-primary"></i>Detail Pemesanan</h6>
                <table class="table table-sm mb-0">
                    <tr><td class="text-muted">No. Pemesanan</td><td><code class="text-primary fw-bold">{{ $pemesanan->no_pemesanan }}</code></td></tr>
                    <tr><td class="text-muted">Mobil</td><td class="fw-semibold">{{ $pemesanan->mobil->nama_mobil ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tanggal Mulai</td><td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') }}</td></tr>
                    <tr><td class="text-muted">Tanggal Selesai</td><td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') }}</td></tr>
                    <tr><td class="text-muted">Durasi</td><td>{{ $pemesanan->durasi_hari }} hari</td></tr>
                    <tr><td class="text-muted">Total Bayar</td><td class="fw-bold text-success fs-5">Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</td></tr>
                    <tr><td class="text-muted">Status</td><td>
                        @php $sc=['pending'=>'warning','dikonfirmasi'=>'info','selesai'=>'success','dibatalkan'=>'danger'] @endphp
                        <span class="badge bg-{{ $sc[$pemesanan->status] ?? 'secondary' }}">{{ ucfirst($pemesanan->status) }}</span>
                    </td></tr>
                </table>
            </div>
        </div>

        @if(!$pemesanan->pembayaran)
        <!-- Form Konfirmasi -->
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-send me-2 text-success"></i>Konfirmasi Pembayaran</h6>
                <div class="alert alert-warning small mb-3"><i class="bi bi-exclamation-triangle me-2"></i>Silakan transfer ke rekening yang tersedia, lalu pilih metode dan klik konfirmasi.</div>
                <form action="{{ route('pembayaran.konfirmasi', $pemesanan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Pilih Metode Transfer</label>
                        <select name="metode" class="form-select">
                            <option value="transfer_bca">Transfer BCA</option>
                            <option value="transfer_bni">Transfer BNI</option>
                            <option value="transfer_mandiri">Transfer Mandiri</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-check-circle me-2"></i>Saya Sudah Transfer</button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-check2-circle me-2 text-success"></i>Status Pembayaran</h6>
                @php $bc=['menunggu'=>'warning','dikonfirmasi'=>'success','ditolak'=>'danger'] @endphp
                <div class="alert alert-{{ $bc[$pemesanan->pembayaran->status] ?? 'secondary' }}">
                    <strong>Status: {{ ucfirst($pemesanan->pembayaran->status) }}</strong><br>
                    <small>Metode: {{ str_replace('_',' ',ucwords($pemesanan->pembayaran->metode,'_')) }}</small>
                </div>
                @if($pemesanan->pembayaran->status === 'menunggu')
                    <p class="text-muted small">Pembayaran Anda sedang diverifikasi oleh admin. Mohon tunggu.</p>
                @elseif($pemesanan->pembayaran->status === 'dikonfirmasi')
                    <p class="text-success small"><i class="bi bi-check-circle me-1"></i>Pembayaran berhasil dikonfirmasi!</p>
                @else
                    <p class="text-danger small"><i class="bi bi-x-circle me-1"></i>Pembayaran ditolak. Silakan hubungi admin.</p>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-5">
        <!-- Rekening Info -->
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-bank me-2 text-primary"></i>Rekening Tujuan</h6>
                @foreach([['BCA','1234567890','Rental Ananda','primary'],['BNI','0987654321','Rental Ananda','warning'],['Mandiri','1122334455','Rental Ananda','success']] as [$bank,$no,$nama,$color])
                <div class="p-3 mb-3 border rounded-3">
                    <div class="fw-bold text-{{ $color }} mb-1"><i class="bi bi-bank me-2"></i>Bank {{ $bank }}</div>
                    <div style="font-size:.8rem;color:#6b7280">No. Rekening</div>
                    <div class="fw-bold fs-5">{{ $no }}</div>
                    <div class="text-muted small">a.n. {{ $nama }}</div>
                </div>
                @endforeach
                <div class="alert alert-info small mt-3 mb-0">
                    <i class="bi bi-info-circle me-2"></i>Transfer tepat <b>Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</b> lalu konfirmasi di form sebelah.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
