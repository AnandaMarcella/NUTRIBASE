<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $pemesanans = Pemesanan::with(['user','mobil'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->latest()->get();

        $totalPendapatan = $pemesanans->where('status','selesai')->sum('total_harga');
        $totalPemesanan  = $pemesanans->count();
        $selesai         = $pemesanans->where('status','selesai')->count();
        $pending         = $pemesanans->where('status','pending')->count();

        // Mobil terpopuler
        $mobilPopuler = Pemesanan::selectRaw('mobil_id, COUNT(*) as total')
            ->groupBy('mobil_id')->orderByDesc('total')
            ->with('mobil')->take(5)->get();

        return view('laporan.index', compact('pemesanans','totalPendapatan','totalPemesanan','selesai','pending','mobilPopuler','bulan','tahun'));
    }
}
