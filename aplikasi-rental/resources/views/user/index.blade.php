@extends('layouts.app')
@section('title','Kelola User')
@section('content')
<div class="topbar">
    <h4><i class="bi bi-people me-2 text-primary"></i>Kelola User</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
        <i class="bi bi-person-plus me-2"></i>Tambah User
    </button>
</div>
<div class="card"><div class="card-body p-0">
    <div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead><tr><th class="px-4">No</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Role</th><th>Bergabung</th><th class="px-4">Aksi</th></tr></thead>
        <tbody>
        @forelse($users as $i => $u)
        <tr>
            <td class="px-4">{{ $i+1 }}</td>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div style="width:36px;height:36px;border-radius:50%;background:#eff6ff;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-person text-primary small"></i>
                    </div>
                    <div class="fw-semibold">{{ $u->name }}</div>
                </div>
            </td>
            <td class="text-muted">{{ $u->email }}</td>
            <td>{{ $u->no_hp ?? '-' }}</td>
            <td>
                @php $rc=['admin'=>'primary','owner'=>'success','customer'=>'warning'] @endphp
                <span class="badge bg-{{ $rc[$u->role] ?? 'secondary' }}">{{ ucfirst($u->role) }}</span>
            </td>
            <td class="text-muted small">{{ $u->created_at->format('d M Y') }}</td>
            <td class="px-4">
                @if($u->id != auth()->id())
                <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
                @else
                <span class="text-muted small">(Anda)</span>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-5">Belum ada user</td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
</div></div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUser" tabindex="-1"><div class="modal-dialog"><div class="modal-content border-0" style="border-radius:16px">
    <div class="modal-header border-0"><h5 class="modal-title fw-bold">Tambah User Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="form-label fw-semibold small">Nama Lengkap</label><input type="text" name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label fw-semibold small">Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label fw-semibold small">Password</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3"><label class="form-label fw-semibold small">Role</label>
                <select name="role" class="form-select"><option value="customer">Customer</option><option value="admin">Admin</option><option value="owner">Owner</option></select>
            </div>
            <div class="mb-3"><label class="form-label fw-semibold small">No. HP</label><input type="text" name="no_hp" class="form-control"></div>
            <div class="mb-3"><label class="form-label fw-semibold small">Alamat</label><input type="text" name="alamat" class="form-control"></div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-person-check me-2"></i>Simpan User</button>
        </form>
    </div>
</div></div></div>
@endsection
