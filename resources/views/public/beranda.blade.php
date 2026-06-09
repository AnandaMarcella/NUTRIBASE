@extends('layouts.public')
@section('title', 'Beranda — NutriBase')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,700;0,9..144,900;1,9..144,500;1,9..144,700;1,9..144,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app-public.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="lp-hero">
    <div class="lp-hero-bg"></div>
    <div class="lp-hero-ring"></div>

    <div class="lp-hero-inner">

        {{-- Left --}}
        <div>

            <h1 class="lp-hero-title">
                Makanan Bergizi,<br>
                <span class="green">Lebih Mudah</span><br>
                <span class="indent">Sampai.</span>
            </h1>

            <p class="lp-hero-desc">
                NutriBase membantu kader, koordinator, dan penerima program Makanan Bergizi Gratis bekerja dalam satu platform yang jelas, cepat, dan transparan.
            </p>

            <div class="lp-hero-ctas">
                <a href="{{ route('login') }}" class="btn-main">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
                </a>
                <a href="{{ route('tentang') }}" class="btn-ghost">
                    Pelajari Program <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Right --}}
        
        <div class="lp-hero-visual">
            <img src="{{ asset('nutribase_hero_illustration.png') }}" alt="Ilustrasi aplikasi NutriBase">
        </div>
        

    </div>
</section>


{{-- ── FEATURES ── --}}
<section class="lp-features">
    <div class="lp-section-inner">
        <div class="lp-section-head reveal">
            <div>
                <div class="lp-label"><span class="lp-label-dot"></span> Fitur Utama</div>
                <h2 class="lp-h2">Semua yang diperlukan,<br><em>sudah ada di sini.</em></h2>
            </div>
            <p class="lp-section-aside">Dirancang khusus untuk kebutuhan lapangan program MBG.</p>
        </div>

        <div class="feat-grid reveal">

            <div class="feat-card" style="transition-delay:.07s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-people-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Distribusi Real-time</h3>
                <p class="feat-p">Pantau dan catat setiap proses distribusi secara langsung. Status otomatis terupdate — penerima tidak perlu menunggu konfirmasi manual.</p>
            </div>

            <div class="feat-card" style="transition-delay:.07s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-people-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Data Penerima Terpusat</h3>
                <p class="feat-p">Kelola profil penerima lengkap termasuk kategori, NIK, lokasi, dan estimasi durasi bantuan dalam satu tempat.</p>
            </div>

            <div class="feat-card" style="transition-delay:.14s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-bar-chart-line-fill" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Laporan & Analitik</h3>
                <p class="feat-p">Dashboard koordinator dengan grafik realisasi, performa kader, dan ekspor laporan PDF siap presentasi.</p>
            </div>

            <div class="feat-card" style="transition-delay:.21s;">
                <div class="feat-icon-wrap" style="background:rgba(234,179,8,.1);">
                    <i class="bi bi-calendar3" style="color:#a16207;"></i>
                </div>
                <h3 class="feat-h3">Jadwal & Variasi Menu</h3>
                <p class="feat-p">Atur jadwal distribusi mingguan dan rotasi menu bergizi agar program berjalan terstruktur setiap saat.</p>
            </div>

            <div class="feat-card" style="transition-delay:.28s;">
                <div class="feat-icon-wrap" style="background:var(--g-xl);">
                    <i class="bi bi-shield-check" style="color:var(--g);"></i>
                </div>
                <h3 class="feat-h3">Akses Berbasis Peran</h3>
                <p class="feat-p">Kader, Koordinator, dan Penerima — masing-masing mendapat tampilan dan fitur yang sesuai tanggung jawabnya.</p>
            </div>

            <div class="feat-card" style="transition-delay:.35s;">
                <div class="feat-icon-wrap" style="background:rgba(239,68,68,.07);">
                    <i class="bi bi-star-fill" style="color:#dc2626;"></i>
                </div>
                <h3 class="feat-h3">Ulasan & Tanggapan</h3>
                <p class="feat-p">Penerima memberi ulasan, kader merespons. Loop feedback yang membantu program terus berkembang.</p>
            </div>

        </div>
    </div>
</section>

{{-- ── NUMBERS ── --}}
<section class="lp-numbers">
    <div class="numbers-grid reveal">
        <div class="num-cell">
            <span class="num-val">3<span class="num-suffix">+</span></span>
            <div class="num-label">Jenis Pengguna<br>dalam Satu Sistem</div>
        </div>
        <div class="num-cell">
            <span class="num-val">100<span class="num-suffix">%</span></span>
            <div class="num-label">Distribusi<br>Tertelusuri</div>
        </div>
        <div class="num-cell">
            <span class="num-val">0</span>
            <div class="num-label">Data Tercecer,<br>Semua Tercatat</div>
        </div>
        <div class="num-cell">
            <span class="num-val">∞</span>
            <div class="num-label">Riwayat Distribusi<br>Tersimpan</div>
        </div>
    </div>
</section>


{{-- ── CTA ── --}}
<section class="lp-cta-wrap">
    <div class="lp-cta-box reveal">
        <div>
            <div class="lp-cta-label"><span></span> Siap Mulai?</div>
            <h2>Program lebih rapi,<br><em>mulai hari ini.</em></h2>
            <p>Masuk ke NutriBase dan kelola distribusi program Makanan Bergizi Gratis dengan cara yang lebih modern dan transparan.</p>
        </div>
        <div class="lp-cta-action">
            <a href="{{ route('login') }}" class="btn-cta">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
            </a>
        </div>
    </div>
</section>

<script>
const reveals = document.querySelectorAll('.reveal');
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
reveals.forEach(el => io.observe(el));
</script>

@endsection
