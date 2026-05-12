<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Rental Ananda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%); min-height:100vh; display:flex; align-items:center; justify-content:center; padding:30px 0; }
        .auth-card { width:460px; border-radius:20px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.3); }
        .form-control { border-radius:10px; padding:11px 16px; border:1.5px solid #e2e8f0; }
        .form-control:focus { border-color:#1a56db; box-shadow:0 0 0 3px rgba(26,86,219,.1); }
        .btn-primary { background:#1a56db; border:none; border-radius:10px; padding:12px; font-weight:600; }
        .brand-logo { width:56px; height:56px; background:#1a56db; border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; }
    </style>
</head>
<body>
<div class="card auth-card p-5">
    <div class="text-center mb-4">
        <div class="brand-logo"><i class="bi bi-person-plus-fill text-white fs-3"></i></div>
        <h4 class="fw-bold mb-1">Buat Akun</h4>
        <p class="text-muted small">Daftar sebagai pelanggan Rental Ananda</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3 small py-2"><i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@contoh.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">No. HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Alamat lengkap" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold small">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold small">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="bi bi-person-check me-2"></i>Daftar Sekarang
        </button>
    </form>
    <div class="text-center">
        <span class="text-muted small">Sudah punya akun? </span>
        <a href="{{ route('login') }}" class="text-primary fw-semibold small text-decoration-none">Masuk di sini</a>
    </div>
    <div class="text-center mt-2">
        <a href="{{ route('landing') }}" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Kembali ke beranda</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
