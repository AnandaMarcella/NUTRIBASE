<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Ananda - @yield('title','Sewa Mobil Terpercaya')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --primary:#1a56db; --dark:#0f172a; }
        body { font-family:'Segoe UI',sans-serif; }
        .navbar { background:rgba(255,255,255,.97); box-shadow:0 2px 20px rgba(0,0,0,.08); }
        .navbar-brand { font-weight:800; font-size:1.3rem; color:var(--primary) !important; }
        .nav-link { font-weight:500; color:#374151 !important; transition:.2s; }
        .nav-link:hover, .nav-link.active { color:var(--primary) !important; }
        .btn-primary { background:var(--primary); border-color:var(--primary); border-radius:8px; }
        footer { background:var(--dark); color:#94a3b8; }
        footer a { color:#94a3b8; text-decoration:none; }
        footer a:hover { color:#fff; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <i class="bi bi-car-front-fill me-2"></i>Rental Ananda
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
        </div>
    </div>
</nav>

@yield('content')

<footer class="py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-3"><i class="bi bi-car-front-fill me-2 text-primary"></i>Rental Ananda</h6>
                <p class="small">Jasa sewa mobil terpercaya dengan armada terlengkap dan pelayanan terbaik.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-3">Navigasi</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('landing') }}">Beranda</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-3">Kontak</h6>
                <p class="small mb-1"><i class="bi bi-telephone me-2"></i>0812-3456-7890</p>
                <p class="small mb-1"><i class="bi bi-envelope me-2"></i>info@rentalananda.com</p>
                <p class="small"><i class="bi bi-geo-alt me-2"></i>Jl. Raya No. 1, Indramayu</p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center small mb-0">&copy; {{ date('Y') }} Rental Ananda. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
