@extends('layouts.landing')
@section('title','Kontak')
@section('content')
<section class="py-5" style="background:linear-gradient(135deg,#0f172a,#1e3a5f);min-height:35vh;display:flex;align-items:center">
    <div class="container text-white text-center">
        <h1 class="fw-bold display-5">Hubungi Kami</h1>
        <p class="text-light lead">Kami siap membantu Anda</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-5">
                <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                @foreach([['bi-telephone-fill','Telepon','0812-3456-7890','text-primary'],['bi-whatsapp','WhatsApp','0812-3456-7890','text-success'],['bi-envelope-fill','Email','info@rentalananda.com','text-danger'],['bi-geo-alt-fill','Alamat','Jl. Raya Pantura No. 1, Indramayu, Jawa Barat 45213','text-warning'],['bi-clock-fill','Jam Operasional','Senin - Minggu: 07.00 - 21.00 WIB','text-info']] as [$icon,$label,$val,$color])
                <div class="d-flex gap-3 mb-4">
                    <div style="width:44px;height:44px;border-radius:10px;background:#f0f4f8;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi {{ $icon }} {{ $color }}"></i>
                    </div>
                    <div><div class="fw-semibold small text-muted">{{ $label }}</div><div class="fw-bold">{{ $val }}</div></div>
                </div>
                @endforeach
            </div>
            <div class="col-md-7">
                <div class="card p-4 shadow-sm">
                    <h5 class="fw-bold mb-4">Kirim Pesan</h5>
                    <div class="alert alert-info small"><i class="bi bi-info-circle me-2"></i>Untuk pemesanan, silakan <a href="{{ route('register') }}" class="fw-bold">daftar</a> atau <a href="{{ route('login') }}" class="fw-bold">login</a> terlebih dahulu.</div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" placeholder="email@contoh.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pesan</label>
                        <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                    </div>
                    <button class="btn btn-primary w-100"><i class="bi bi-send me-2"></i>Kirim Pesan</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
