@extends('layouts.app')
@section('title','Edit Mobil')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-pencil me-2 text-primary"></i>Edit Mobil</h4>
    <a href="{{ route('mobil.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
</div>
<div class="card" style="max-width:600px"><div class="card-body p-4">
    @if($errors->any())<div class="alert alert-danger small">{{ $errors->first() }}</div>@endif
    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label fw-semibold small">Nama Mobil</label><input type="text" name="nama_mobil" class="form-control" value="{{ $mobil->nama_mobil }}" required></div>
            <div class="col-md-6"><label class="form-label fw-semibold small">Buatan</label><input type="text" name="buatan" class="form-control" value="{{ $mobil->buatan }}" required></div>
            <div class="col-md-6"><label class="form-label fw-semibold small">Tahun</label><input type="number" name="tahun" class="form-control" value="{{ $mobil->tahun }}" min="2000" max="2030" required></div>
            <div class="col-md-6"><label class="form-label fw-semibold small">Harga Sewa/Hari (Rp)</label><input type="number" name="harga_sewa" class="form-control" value="{{ $mobil->harga_sewa }}" required></div>
            <div class="col-md-6"><label class="form-label fw-semibold small">Status</label>
                <select name="status" class="form-select">
                    <option value="tersedia" {{ $mobil->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ $mobil->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
            </div>
            <div class="col-12"><label class="form-label fw-semibold small">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3">{{ $mobil->deskripsi }}</textarea></div>
            <div class="col-12"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-2"></i>Update Mobil</button></div>
        </div>
    </form>
</div></div>
@endsection
