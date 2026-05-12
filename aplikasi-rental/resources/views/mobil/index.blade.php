@extends('layouts.app')
@section('title','Kelola Mobil')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-car-front me-2 text-primary"></i>Kelola Mobil</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('mobil.print') }}" class="btn btn-outline-secondary" target="_blank"><i class="bi bi-printer me-2"></i>Cetak</a>
        <a href="{{ route('mobil.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Mobil</a>
    </div>
</div>
<div class="card"><div class="card-body p-0">
<div class="table-responsive">
<table class="table table-hover mb-0">
    <thead><tr><th class="px-4">No</th><th>Nama Mobil</th><th>Buatan</th><th>Tahun</th><th>Harga/Hari</th><th>Status</th><th class="px-4">Aksi</th></tr></thead>
    <tbody>
    @forelse($mobils as $i => $m)
    <tr>
        <td class="px-4">{{ $i+1 }}</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <div style="width:36px;height:36px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-car-front text-primary small"></i>
                </div>
                <div>
                    <div class="fw-semibold">{{ $m->nama_mobil }}</div>
                    <div class="text-muted" style="font-size:.75rem">{{ $m->deskripsi ? Str::limit($m->deskripsi, 40) : '-' }}</div>
                </div>
            </div>
        </td>
        <td>{{ $m->buatan }}</td>
        <td>{{ $m->tahun }}</td>
        <td class="fw-semibold text-success">Rp {{ number_format($m->harga_sewa,0,',','.') }}</td>
        <td><span class="badge bg-{{ $m->status == 'tersedia' ? 'success' : 'warning text-dark' }}">{{ ucfirst($m->status) }}</span></td>
        <td class="px-4">
            <div class="d-flex gap-1">
                <a href="{{ route('mobil.edit', $m->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('mobil.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr><td colspan="7" class="text-center text-muted py-5">Belum ada data mobil</td></tr>
    @endforelse
    </tbody>
</table>
</div>
</div></div>
@endsection
