<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --sidebar-bg: #1a2535; --sidebar-hover: #243447; --accent: #3d8ef8; }
        body { display:flex; min-height:100vh; background:#f0f4f8; font-family:'Segoe UI',sans-serif; }
        .sidebar { width:240px; background:var(--sidebar-bg); color:#fff; min-height:100vh; padding-top:0; flex-shrink:0; display:flex; flex-direction:column; }
        .sidebar-brand { padding:22px 20px 18px; border-bottom:1px solid #2e3e50; background:#111e2e; }
        .sidebar-brand .brand-title { font-size:1rem; font-weight:700; color:#fff; }
        .sidebar-brand .brand-sub { font-size:.72rem; color:#90a4ae; margin-top:2px; }
        .sidebar-section { font-size:.65rem; font-weight:600; text-transform:uppercase; color:#607d8b; padding:16px 20px 6px; letter-spacing:.08em; }
        .sidebar a { display:flex; align-items:center; gap:10px; color:#b0bec5; padding:10px 20px; text-decoration:none; font-size:.875rem; transition:.15s; border-left:3px solid transparent; }
        .sidebar a:hover, .sidebar a.active { color:#fff; background:var(--sidebar-hover); border-left:3px solid var(--accent); }
        .sidebar-footer { margin-top:auto; border-top:1px solid #2e3e50; }
        .main-content { flex:1; padding:28px; overflow-x:hidden; }
        .topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .topbar h4 { margin:0; font-weight:700; font-size:1.25rem; color:#1a2535; }
        .card { border:none; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.08); }
        .stat-card { border-radius:12px; padding:20px; color:#fff; position:relative; overflow:hidden; }
        .stat-card::after { content:''; position:absolute; right:-15px; top:-15px; width:80px; height:80px; border-radius:50%; background:rgba(255,255,255,.1); }
        .table th { font-size:.8rem; font-weight:600; text-transform:uppercase; color:#607d8b; border:none; background:#f8fafc; }
        .table td { font-size:.875rem; vertical-align:middle; }
        .btn { border-radius:8px; font-size:.875rem; }
        .notif-dot { width:8px; height:8px; background:#ef4444; border-radius:50%; display:inline-block; margin-left:4px; vertical-align:middle; }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title"><i class="bi bi-car-front-fill text-primary"></i> Rental Ananda</div>
        <div class="brand-sub">
            {{ auth()->user()->name }} &bull;
            <span style="color:#3d8ef8">{{ ucfirst(auth()->user()->role) }}</span>
        </div>
    </div>

    <div class="sidebar-section">Menu</div>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    @if(auth()->user()->isAdmin())
        <div class="sidebar-section">Kelola</div>
        <a href="{{ route('admin.pemesanan.index') }}" class="{{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Kelola Pemesanan
            @php $pendingBayar = \App\Models\Pembayaran::where('status','menunggu')->count(); @endphp
            @if($pendingBayar > 0) <span class="notif-dot ms-auto"></span> @endif
        </a>
        <a href="{{ route('mobil.index') }}" class="{{ request()->routeIs('mobil.*') ? 'active' : '' }}">
            <i class="bi bi-car-front"></i> Kelola Mobil
        </a>
        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Kelola User
        </a>
        <a href="{{ route('feedback.admin') }}" class="{{ request()->routeIs('feedback.admin') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i> Tanggapi Feedback
            @php $pendingFb = \App\Models\Feedback::whereNull('balasan')->count(); @endphp
            @if($pendingFb > 0) <span class="notif-dot ms-auto"></span> @endif
        </a>
    @endif

    @if(auth()->user()->isOwner())
        <div class="sidebar-section">Manajemen</div>
        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Laporan
        </a>
        <a href="{{ route('feedback.owner') }}" class="{{ request()->routeIs('feedback.owner') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i> Tanggapi Feedback
        </a>
    @endif

    @if(auth()->user()->isCustomer())
        <div class="sidebar-section">Layanan</div>
        <a href="{{ route('pesan.index') }}" class="{{ request()->routeIs('pesan.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-plus"></i> Pesan Mobil
        </a>
        <a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i> Pembayaran
        </a>
        <a href="{{ route('histori.index') }}" class="{{ request()->routeIs('histori.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Histori
        </a>
        <a href="{{ route('feedback.index') }}" class="{{ request()->routeIs('feedback.index') ? 'active' : '' }}">
            <i class="bi bi-star"></i> Feedback
        </a>
    @endif

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link w-100 text-start d-flex align-items-center gap-2"
                style="color:#b0bec5;padding:12px 20px;text-decoration:none;font-size:.875rem;border:none;background:none;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
