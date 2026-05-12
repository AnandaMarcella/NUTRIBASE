@extends('layouts.public')
@section('title', 'Kontak — NutriBase')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
@endpush

@section('content')

<section class="contact-section">
    <div class="ct-blob ct-blob-1"></div>
    <div class="ct-blob ct-blob-2"></div>

    <div class="contact-inner">

        {{-- Header --}}
        <div class="contact-header anim-enter anim-enter-1">
            <div class="nb-badge">
                <span class="nb-badge-dot"></span> Hubungi Kami
            </div>
            <h1>Ada Pertanyaan atau<br><em>Ingin Bekerja Sama?</em></h1>
            <p>Kami siap membantu Anda. Silakan hubungi kami melalui saluran komunikasi di bawah ini.</p>
        </div>

        <div class="contact-grid">

            {{-- Info Kontak --}}
            <div class="info-container reveal">
                <div class="info-card">
                    <div class="info-item">
                        <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <p class="info-label">Lokasi Kantor</p>
                            <p class="info-value">Subang, Jawa Barat, Indonesia</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <p class="info-label">Jam Operasional</p>
                            <p class="info-value">Senin – Jumat, 08.00 – 17.00 WIB</p>
                        </div>
                    </div>
                </div>

                <div class="info-card info-card-highlight">
                    <div class="info-item" style="margin-bottom:0;"></div>
                </div>

                {{-- Mini stats --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;"></div>
            </div>

            {{-- WhatsApp Card --}}
            <div class="reveal" style="transition-delay: 0.15s;">
                <div class="wa-card">
                    <div class="wa-icon-wrapper">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h3>Kirim Pesan Langsung</h3>
                    <p>Klik tombol di bawah untuk memulai percakapan dengan tim dukungan NutriBase di WhatsApp.</p>

                    <a href="https://wa.me/qr/IWYYKL7WW422M1" target="_blank" class="wa-btn">
                        <i class="bi bi-whatsapp"></i>
                        Hubungi via WhatsApp
                    </a>

                    <div class="wa-divider">
                        <div class="wa-divider-line"></div>
                        <span>atau</span>
                        <div class="wa-divider-line"></div>
                    </div>

                    <a href="{{ route('login') }}" class="nb-btn nb-btn-ghost" style="width:100%; justify-content:center;">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => observer.observe(el));
</script>

@endsection
