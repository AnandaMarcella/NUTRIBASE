@extends('layouts.landing')
@section('title','Tentang Kami')
@section('content')
<section class="py-5" style="background:linear-gradient(135deg,#0f172a,#1e3a5f);min-height:35vh;display:flex;align-items:center">
    <div class="container text-white text-center">
        <h1 class="fw-bold display-5">Tentang Kami</h1>
        <p class="text-light lead">Mengenal Rental Ananda lebih dekat</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Siapa Kami?</h2>
                <p class="text-muted">Rental Ananda adalah perusahaan jasa sewa mobil yang berdiri sejak 2019 di Indramayu, Jawa Barat. Kami berkomitmen memberikan layanan transportasi terbaik dengan armada mobil berkualitas dan terawat.</p>
                <p class="text-muted">Dengan pengalaman lebih dari 5 tahun, kami telah melayani ribuan pelanggan dari berbagai kalangan, mulai dari wisatawan, pebisnis, hingga keluarga yang membutuhkan transportasi handal.</p>
                <div class="row g-3 mt-2">
                    @foreach([['500+','Pelanggan'],['50+','Armada Mobil'],['5+','Tahun Pengalaman']] as [$val,$label])
                    <div class="col-4 text-center p-3" style="background:#eff6ff;border-radius:12px">
                        <h4 class="fw-bold text-primary mb-0">{{ $val }}</h4>
                        <small class="text-muted">{{ $label }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h5 class="fw-bold mb-3"><i class="bi bi-bullseye text-primary me-2"></i>Visi Kami</h5>
                    <p class="text-muted mb-4">Menjadi perusahaan rental mobil terdepan di Jawa Barat yang dipercaya masyarakat.</p>
                    <h5 class="fw-bold mb-3"><i class="bi bi-rocket text-success me-2"></i>Misi Kami</h5>
                    <ul class="text-muted list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>Menyediakan armada berkualitas dan terawat</li>
                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>Memberikan pelayanan profesional 24/7</li>
                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>Harga transparan dan kompetitif</li>
                        <li><i class="bi bi-check2 text-success me-2"></i>Keamanan dan kenyamanan pelanggan utama</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
