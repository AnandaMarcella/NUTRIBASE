<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_if($user->role !== 'penerima', 403, 'Akses khusus penerima.');

        $penerima = $user->penerimaProfile;

        if (! $penerima) {
            return redirect()->route('penerima.create')
                ->with('error', 'Profil penerima belum lengkap. Silakan isi identitas tambahan dahulu.');
        }

        $query = Distribusi::with(['menu', 'kader', 'jadwal', 'feedback'])
            ->where('penerima_id', $penerima->id)
            ->latest('waktu_distribusi');

        if ($search = $request->input('search')) {
            // ✅ BUG 4 FIX: Kolom di tabel menu adalah 'nama_menu', bukan 'nama'.
            // Sebelumnya memakai 'nama' sehingga query SQL error / tidak menemukan kolom.
            $query->whereHas('menu', fn($q) => $q->where('nama_menu', 'like', "%{$search}%"));
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($from = $request->input('date_from')) {
            $query->whereDate('waktu_distribusi', '>=', $from);
        }

        if ($to = $request->input('date_to')) {
            $query->whereDate('waktu_distribusi', '<=', $to);
        }

        $riwayat = $query->paginate(10)->withQueryString();

        $base = Distribusi::where('penerima_id', $penerima->id);
        $stats = [
            'total'    => $base->count(),
            'diterima' => (clone $base)->where('status', 'diterima')->count(),
            'gagal'    => (clone $base)->where('status', 'gagal')->count(),
            'pending'  => (clone $base)->where('status', 'pending')->count(),
        ];

        return view('riwayat.index', compact('riwayat', 'stats'));
    }
}