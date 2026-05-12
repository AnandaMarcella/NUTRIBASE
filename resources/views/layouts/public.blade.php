<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriBase')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,300;1,9..40,400&family=Lora:ital,wght@0,500;0,600;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        leaf: '#16A34A',
                        leafLight: '#22C55E',
                        leafPale: '#DCFCE7',
                        ink: '#0A1A0F',
                        mist: '#F0FDF4',
                        sage: '#6B8F72',
                    }
                }
            }
        }
    </script>

    {{-- Global styles --}}
    <link rel="stylesheet" href="{{ asset('css/app-public.css') }}">

    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body>

<nav class="nb-nav" id="navbar">
    <div class="nb-nav-inner">
        {{-- Logo: icon + text, NO pill/box/border --}}
        <a href="{{ route('home') }}" class="nb-logo">
            <img src="{{ asset('favicon.ico') }}" alt="NutriBase Logo" class="nb-logo-img">
            <span class="nb-logo-text">Nutri<span>Base</span></span>
        </a>

        {{-- Desktop Links --}}
        <div class="nb-nav-links">
            <a href="{{ route('home') }}" class="nb-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('tentang') }}" class="nb-nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('kontak') }}" class="nb-nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            <a href="{{ route('login') }}" class="nb-cta">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </a>
        </div>

        {{-- Mobile Button --}}
        <button class="nb-hamburger" id="menu-toggle" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="nb-mobile-menu" id="mobile-menu">
        <a href="{{ route('home') }}" class="nb-mobile-link">Beranda</a>
        <a href="{{ route('tentang') }}" class="nb-mobile-link">Tentang</a>
        <a href="{{ route('kontak') }}" class="nb-mobile-link">Kontak</a>
        <a href="{{ route('login') }}" class="nb-mobile-link" style="color:var(--leaf);font-weight:700;">Masuk →</a>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="nb-footer">
    <div class="nb-footer-inner">
        <div class="nb-footer-grid">
            <div class="nb-footer-brand">
                <h2>Nutri<span>Base</span></h2>
                <p>Sistem pengelolaan program makanan bergizi yang modern, efisien, dan transparan untuk Indonesia.</p>
            </div>
            <div class="nb-footer-nav">
                <h4>Halaman</h4>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('tentang') }}">Tentang</a>
                <a href="{{ route('kontak') }}">Kontak</a>
            </div>
        </div>
        <div class="nb-footer-bottom">© {{ date('Y') }} NutriBase — Platform MBG Indonesia</div>
    </div>
</footer>

<script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 30);
    });

    const toggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const bars = toggle.querySelectorAll('span');

    toggle.addEventListener('click', () => {
        const open = mobileMenu.classList.toggle('open');
        if (open) {
            bars[0].style.transform = 'translateY(7px) rotate(45deg)';
            bars[1].style.opacity = '0';
            bars[2].style.transform = 'translateY(-7px) rotate(-45deg)';
        } else {
            bars.forEach(b => { b.style.transform = ''; b.style.opacity = ''; });
        }
    });
</script>
</body>
</html>
