@extends('layouts.public')
@section('title', 'Tentang — NutriBase')

@section('content')

<style>
    .page-section {
        position: relative;
        overflow: hidden;
        padding: 80px 0 120px;
        background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 45%, #bbf7d0 100%);
    }

    /* Blobs */
    .pg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
    }

    .pg-blob-1 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(74,222,128,0.3) 0%, transparent 70%);
        top: -150px; right: -100px;
        animation: pgBlob1 9s ease-in-out infinite;
    }

    .pg-blob-2 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(22,163,74,0.15) 0%, transparent 70%);
        bottom: 100px; left: -80px;
        animation: pgBlob2 11s ease-in-out infinite;
    }

    @keyframes pgBlob1 {
        0%, 100% { transform: translate(0,0); }
        50% { transform: translate(-30px, 20px); }
    }

    @keyframes pgBlob2 {
        0%, 100% { transform: translate(0,0); }
        50% { transform: translate(25px, -20px); }
    }

    .page-inner {
        max-width: 960px;
        margin: 0 auto;
        padding: 0 24px;
        position: relative;
        z-index: 1;
    }

    /* ── PAGE HEADER ── */
    .page-header { margin-bottom: 64px; }

    .page-header h1 {
        font-size: clamp(2.2rem, 5vw, 3.4rem);
        font-weight: 800;
        color: var(--ink);
        line-height: 1.1;
        letter-spacing: -0.05em;
        margin-bottom: 18px;
        margin-top: 16px;
    }

    .page-header h1 em {
        font-family: 'Lora', serif;
        font-style: italic;
        background: linear-gradient(135deg, var(--leaf), #15803D);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-header p {
        font-size: 16px;
        color: #2D5A38;
        line-height: 1.8;
        max-width: 540px;
    }

    /* ── CONTENT BLOCKS ── */
    .content-block {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(12px);
        border: 1.5px solid rgba(22,163,74,0.12);
        border-radius: 22px;
        padding: 40px 44px;
        margin-bottom: 20px;
        transition: box-shadow .35s ease, border-color .35s ease, transform .35s ease;
        position: relative;
        overflow: hidden;
    }

    .content-block::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(180deg, var(--leaf), var(--leaf-vivid));
        border-radius: 2px 0 0 2px;
        transform: scaleY(0);
        transform-origin: top;
        transition: transform .4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .content-block:hover {
        box-shadow: 0 16px 48px rgba(22,163,74,0.1);
        border-color: rgba(22,163,74,0.22);
        transform: translateY(-3px);
    }

    .content-block:hover::before { transform: scaleY(1); }

    .block-label {
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--leaf);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .block-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, rgba(22,163,74,0.2), transparent);
    }

    .content-block h2 {
        font-size: 19px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 16px;
        letter-spacing: -0.03em;
    }

    .content-block p {
        font-size: 14.5px;
        line-height: 1.85;
        color: #2D5A38;
        margin-bottom: 12px;
    }

    .content-block p:last-child { margin-bottom: 0; }

    /* ── GOALS ── */
    .goals-list { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }

    .goal-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 18px;
        background: var(--mist);
        border-radius: 14px;
        border: 1px solid transparent;
        transition: all .25s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: default;
    }

    .goal-item:hover {
        background: rgba(22,163,74,0.06);
        border-color: rgba(22,163,74,0.15);
        transform: translateX(4px);
    }

    .goal-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(22,163,74,0.1), rgba(74,222,128,0.15));
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
        transition: transform .25s ease;
    }

    .goal-item:hover .goal-icon { transform: scale(1.1) rotate(-5deg); }
    .goal-icon i { color: var(--leaf); font-size: 14px; }

    .goal-text {
        font-size: 14px;
        line-height: 1.7;
        color: #1F4D2A;
        padding-top: 6px;
        font-weight: 500;
    }

    /* ── ROLES ── */
    .roles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 4px;
    }

    .role-card {
        border-radius: 16px;
        padding: 24px 20px;
        border: 1.5px solid rgba(22,163,74,0.1);
        background: var(--mist);
        transition: all .3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }

    .role-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--leaf), var(--leaf-vivid));
        transform: scaleX(0);
        transition: transform .3s ease;
    }

    .role-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(22,163,74,0.15);
        border-color: rgba(22,163,74,0.22);
        background: white;
    }

    .role-card:hover::after { transform: scaleX(1); }

    .role-icon {
        width: 44px; height: 44px;
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        transition: transform .3s ease;
    }

    .role-card:hover .role-icon { transform: scale(1.1); }
    .role-icon i { color: white; font-size: 19px; }

    .role-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .role-desc { font-size: 12.5px; line-height: 1.78; color: #4A6A52; }

    /* ── CTA ── */
    .page-cta {
        margin-top: 52px;
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    /* ── REVEAL ── */
    .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s cubic-bezier(0.16, 1, 0.3, 1), transform .6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 700px) {
        .roles-grid { grid-template-columns: 1fr; }
        .content-block { padding: 28px 24px; }
    }
</style>

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
                    ['icon'=>'bi-bullseye','text'=>'Meningkatkan efisiensi dan akurasi proses distribusi bantuan makanan.'],
                    ['icon'=>'bi-eye-fill','text'=>'Memastikan transparansi dan akuntabilitas pengelolaan program MBG.'],
                    ['icon'=>'bi-graph-up','text'=>'Mendukung pengambilan keputusan berbasis data oleh koordinator.'],
                    ['icon'=>'bi-people-fill','text'=>'Mempermudah akses informasi bagi seluruh pemangku kepentingan program.'],
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
                    ['icon'=>'bi-person-badge-fill','bg'=>'linear-gradient(135deg,#16A34A,#15803D)',
                     'name'=>'Kader',
                     'desc'=>'Mengelola data penerima, distribusi, menu, jadwal, dan pengguna sistem sehari-hari.'],
                    ['icon'=>'bi-person-workspace','bg'=>'linear-gradient(135deg,#15803D,#166534)',
                     'name'=>'Koordinator',
                     'desc'=>'Memantau laporan, evaluasi kinerja, dan pengawasan program secara keseluruhan.'],
                    ['icon'=>'bi-person-heart','bg'=>'linear-gradient(135deg,#22C55E,#16A34A)',
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
                <i class="bi bi-whatsapp" href="{{ route('kontak') }}" class="nb-nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}"></i> Hubungi Kami
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