<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Mobil - Rental Ananda</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { font-family:'Segoe UI',sans-serif; padding:24px; }
    @media print { .no-print { display:none } }
</style>
</head>
<body>
<div class="no-print mb-3"><button onclick="window.print()" class="btn btn-primary btn-sm"><i class="bi bi-printer me-2"></i>Cetak</button></div>
<div class="text-center mb-4">
    <h4 class="fw-bold">RENTAL ANANDA</h4>
    <p class="text-muted small">Jl. Raya No. 1 Indramayu | Telp: 0812-3456-7890</p>
    <h5>Daftar Armada Mobil</h5>
    <hr>
</div>
<table class="table table-bordered table-sm">
    <thead class="table-dark"><tr><th>No</th><th>Nama Mobil</th><th>Buatan</th><th>Tahun</th><th>Harga Sewa/Hari</th><th>Status</th></tr></thead>
    <tbody>
    @foreach($mobils as $i => $m)
    <tr><td>{{ $i+1 }}</td><td>{{ $m->nama_mobil }}</td><td>{{ $m->buatan }}</td><td>{{ $m->tahun }}</td><td>Rp {{ number_format($m->harga_sewa,0,',','.') }}</td><td>{{ ucfirst($m->status) }}</td></tr>
    @endforeach
    </tbody>
</table>
<p class="small text-muted mt-3">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"></script>
</body>
</html>
