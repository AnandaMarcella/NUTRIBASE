@extends('layouts.app')
@section('title','Pesan Mobil')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-calendar-plus me-2 text-primary"></i>Pesan Mobil</h4>
</div>

<div class="row g-4">
    @forelse($mobils as $m)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $m->nama_mobil }}</h6>
                        <span class="text-muted small">{{ $m->buatan }} &bull; {{ $m->tahun }}</span>
                    </div>
                    <span class="badge bg-success">Tersedia</span>
                </div>
                <div style="background:#eff6ff;border-radius:10px;padding:12px" class="mb-3">
                    <div style="font-size:.75rem;color:#6b7280">Harga Sewa per Hari</div>
                    <div class="fw-bold text-primary">Rp {{ number_format($m->harga_sewa,0,',','.') }}</div>
                </div>
                @if($m->deskripsi)
                <p class="text-muted small mb-3">{{ $m->deskripsi }}</p>
                @endif
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#pesan{{ $m->id }}">
                    <i class="bi bi-calendar-check me-2"></i>Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Pemesanan -->
    <div class="modal fade" id="pesan{{ $m->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content border-0" style="border-radius:16px">
        <div class="modal-header border-0">
            <h5 class="modal-title fw-bold"><i class="bi bi-car-front me-2 text-primary"></i>Pesan {{ $m->nama_mobil }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-info small mb-3"><i class="bi bi-info-circle me-2"></i>Harga: <b>Rp {{ number_format($m->harga_sewa,0,',','.') }}/hari</b></div>
            <form action="{{ route('pesan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="mobil_id" value="{{ $m->id }}">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" min="{{ date('Y-m-d') }}" required
                        onchange="hitungTotal(this, {{ $m->harga_sewa }}, '{{ $m->id }}')">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                        onchange="hitungTotal(this, {{ $m->harga_sewa }}, '{{ $m->id }}')">
                </div>
                <div class="p-3 mb-3" style="background:#f0fdf4;border-radius:10px" id="totalBox{{ $m->id }}" style="display:none">
                    <div class="small text-muted">Estimasi Total</div>
                    <div class="fw-bold text-success fs-5" id="totalText{{ $m->id }}">-</div>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-circle me-2"></i>Konfirmasi Pemesanan</button>
            </form>
        </div>
    </div></div></div>

    @empty
    <div class="col-12"><div class="text-center py-5">
        <i class="bi bi-car-front" style="font-size:3rem;color:#e2e8f0"></i>
        <h6 class="text-muted mt-3">Tidak ada mobil tersedia saat ini</h6>
    </div></div>
    @endforelse
</div>

@endsection
@section('scripts')
<script>
function hitungTotal(el, harga, id) {
    const form = el.closest('form');
    const mulai = form.querySelector('[name=tanggal_mulai]').value;
    const selesai = form.querySelector('[name=tanggal_selesai]').value;
    if (mulai && selesai) {
        const d = (new Date(selesai) - new Date(mulai)) / 86400000;
        if (d > 0) {
            document.getElementById('totalText'+id).textContent = 'Rp ' + (d * harga).toLocaleString('id-ID') + ' (' + d + ' hari)';
            document.getElementById('totalBox'+id).style.display = 'block';
        }
    }
}
</script>
@endsection
