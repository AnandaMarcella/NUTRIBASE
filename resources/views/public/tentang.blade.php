@extends('layouts.public')
@section('title', 'Tentang — NutriBase')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
@endpush

@section('content')

<section class="page-section">
    <div class="pg-blob pg-blob-1"></div>
    <div class="pg-blob pg-blob-2"></div>

    <div class="page-inner">

        {{-- Header --}}
        <div class="page-header anim-enter anim-enter-1">
            <div class="nb-badge">
                <span class="nb-badge-dot"></span> Tentang Kami
            </div>
            <h1>Tentang <em>NutriBase</em></h1>
            <p>
                NutriBase adalah sistem informasi berbasis web yang dirancang khusus untuk mendukung pengelolaan program <strong style="color:var(--leaf);font-weight:700;">Makanan Bergizi Gratis (MBG)</strong> secara menyeluruh dan terstruktur.
            </p>
        </div>

        {{-- Latar Belakang --}}
        <div class="content-block reveal anim-enter-2">
            <div class="block-label">Latar Belakang</div>
            <p>
                Program Makanan Bergizi Gratis merupakan inisiatif pemerintah yang bertujuan meningkatkan gizi masyarakat, khususnya untuk anak-anak dan keluarga kurang mampu. Namun, pengelolaan distribusi yang tidak terstruktur seringkali menyebabkan ketidakakuratan data dan kurangnya transparansi.
            </p>
            <p>
                NutriBase hadir sebagai solusi digital untuk menjawab tantangan tersebut — mendigitalisasi proses pendataan, distribusi, monitoring, dan pelaporan dalam satu platform yang mudah digunakan oleh seluruh pemangku kepentingan.
            </p>
        </div>

        {{-- Tujuan --}}
        <div class="content-block reveal" style="transition-delay:.1s;">
            <div class="block-label">Tujuan Sistem</div>
            <div class="goals-list">
                @php
                $goals = [
                    ['icon'=>'bi-bullseye',    'text'=>'Meningkatkan efisiensi dan akurasi proses distribusi bantuan makanan.'],
                    ['icon'=>'bi-eye-fill',    'text'=>'Memastikan transparansi dan akuntabilitas pengelolaan program MBG.'],
                    ['icon'=>'bi-graph-up',    'text'=>'Mendukung pengambilan keputusan berbasis data oleh koordinator.'],
                    ['icon'=>'bi-people-fill', 'text'=>'Mempermudah akses informasi bagi seluruh pemangku kepentingan program.'],
                ];
                @endphp
                @foreach($goals as $g)
                <div class="goal-item">
                    <div class="goal-icon">
                        <i class="bi {{ $g['icon'] }}"></i>
                    </div>
                    <p class="goal-text">{{ $g['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Peran --}}
        <div class="content-block reveal" style="transition-delay:.2s;">
            <div class="block-label">Peran Pengguna</div>
            <div class="roles-grid">
                @php
                $roles = [
                    ['icon'=>'bi-person-badge-fill', 'bg'=>'linear-gradient(135deg,#16A34A,#15803D)',
                     'name'=>'Kader',
                     'desc'=>'Mengelola data penerima, distribusi, menu, jadwal, dan pengguna sistem sehari-hari.'],
                    ['icon'=>'bi-person-workspace',  'bg'=>'linear-gradient(135deg,#15803D,#166534)',
                     'name'=>'Koordinator',
                     'desc'=>'Memantau laporan, evaluasi kinerja, dan pengawasan program secara keseluruhan.'],
                    ['icon'=>'bi-person-heart',      'bg'=>'linear-gradient(135deg,#22C55E,#16A34A)',
                     'name'=>'Penerima',
                     'desc'=>'Melihat riwayat bantuan yang diterima dan memberikan ulasan kualitas distribusi.'],
                ];
                @endphp
                @foreach($roles as $r)
                <div class="role-card">
                    <div class="role-icon" style="background:{{ $r['bg'] }};">
                        <i class="bi {{ $r['icon'] }}"></i>
                    </div>
                    <div class="role-name">{{ $r['name'] }}</div>
                    <div class="role-desc">{{ $r['desc'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="page-cta reveal" style="transition-delay:.3s;">
            <a href="{{ route('login') }}" class="nb-btn nb-btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
            </a>
            <a href="{{ route('kontak') }}" class="nb-btn nb-btn-ghost">
                <i class="bi bi-whatsapp"></i> Hubungi Kami
            </a>
        </div>

    </div>
</section>

<script>
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => observer.observe(el));
</script>

@endsection
