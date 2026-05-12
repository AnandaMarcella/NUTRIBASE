@extends('layouts.landing')
@section('title','Beranda')
@section('content')

<!-- Hero -->
<section style="background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%);min-height:85vh;display:flex;align-items:center;">
    <div class="container text-white text-center py-5">
        <span class="badge bg-primary bg-opacity-25 text-primary border border-primary mb-3 px-3 py-2" style="border-radius:20px;">
            #1 Rental Mobil Terpercaya
        </span>
        <h1 class="display-3 fw-bold mb-4" style="line-height:1.2">
            Sewa Mobil <span style="color:#60a5fa">Mudah</span> &<br>Terpercaya
        </h1>
        <p class="lead mb-5 text-light" style="max-width:600px;margin:0 auto">
            Nikmati perjalanan Anda dengan armada mobil berkualitas, harga transparan, dan pelayanan profesional.
        </p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3" style="border-radius:12px">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('tentang') }}" class="btn btn-outline-light btn-lg px-5 py-3" style="border-radius:12px">
                Pelajari Lebih
            </a>
        </div>

        <!-- Stats -->
        <div class="row g-4 mt-5 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="p-3" style="background:rgba(255,255,255,.08);border-radius:12px">
                    <h3 class="fw-bold text-primary mb-0">500+</h3>
                    <small class="text-light">Pelanggan Puas</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3" style="background:rgba(255,255,255,.08);border-radius:12px">
                    <h3 class="fw-bold text-primary mb-0">50+</h3>
                    <small class="text-light">Armada Mobil</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3" style="background:rgba(255,255,255,.08);border-radius:12px">
                    <h3 class="fw-bold text-primary mb-0">5 Thn</h3>
                    <small class="text-light">Pengalaman</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3" style="background:rgba(255,255,255,.08);border-radius:12px">
                    <h3 class="fw-bold text-primary mb-0">24/7</h3>
                    <small class="text-light">Siap Melayani</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cara Pesan -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Cara Pesan</h2>
            <p class="text-muted">Proses mudah dalam 4 langkah sederhana</p>
        </div>
        <div class="row g-4 text-center">
            @foreach([['bi-person-plus','1. Daftar','Buat akun sebagai customer dengan mengisi data diri Anda.'],['bi-search','2. Pilih Mobil','Pilih mobil sesuai kebutuhan dan tentukan tanggal sewa.'],['bi-credit-card','3. Bayar','Transfer ke rekening kami dan konfirmasi pembayaran.'],['bi-check-circle','4. Nikmati','Ambil mobil dan nikmati perjalanan Anda!']] as [$icon,$title,$desc])
            <div class="col-md-3">
                <div class="p-4">
                    <div class="mb-3" style="width:64px;height:64px;border-radius:16px;background:#eff6ff;display:flex;align-items:center;justify-content:center;margin:0 auto">
                        <i class="bi {{ $icon }} text-primary fs-4"></i>
                    </div>
                    <h6 class="fw-bold">{{ $title }}</h6>
                    <p class="text-muted small">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Keunggulan -->
<section class="py-5" style="background:#f8fafc">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Rental Ananda?</h2>
        </div>
        <div class="row g-4">
            @foreach([['bi-shield-check','Terpercaya','Armada terawat dengan asuransi lengkap untuk keamanan Anda.','text-success'],['bi-cash-coin','Harga Transparan','Tidak ada biaya tersembunyi. Harga yang tertera adalah harga yang Anda bayar.','text-warning'],['bi-headset','Layanan 24/7','Tim kami siap membantu Anda kapanpun dibutuhkan.','text-info'],['bi-geo-alt','Fleksibel','Pilih sendiri tanggal mulai dan selesai sesuai rencana perjalanan.','text-danger']] as [$icon,$title,$desc,$color])
            <div class="col-md-3">
                <div class="card h-100 p-4 text-center">
                    <i class="bi {{ $icon }} {{ $color }} fs-1 mb-3"></i>
                    <h6 class="fw-bold">{{ $title }}</h6>
                    <p class="text-muted small mb-0">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background:linear-gradient(135deg,#1a56db,#0f172a)">
    <div class="container text-white">
        <h2 class="fw-bold mb-3">Siap Memulai Perjalanan?</h2>
        <p class="mb-4 text-light">Daftar sekarang dan dapatkan pengalaman sewa mobil terbaik.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5" style="border-radius:12px;color:#1a56db;font-weight:600">
            Daftar Gratis Sekarang
        </a>
    </div>
</section>

@endsection
