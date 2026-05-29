@extends('layouts.public')
@section('title', 'Kontak — NutriBase')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400;1,700&family=Fraunces:ital,wght@0,400;0,700;0,900;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app-public.css') }}">
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
           </div>

        <div class="contact-grid">

         


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

                    <a href="https://wa.me/6281280260755" target="_blank" class="wa-btn">
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
