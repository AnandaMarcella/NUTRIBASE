<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PemesananAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil', 'pembayaran'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $pemesanans = $query->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,selesai,dibatalkan',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => $request->status]);

        // Kalau selesai, update status mobil jadi tersedia lagi
        if ($request->status === 'selesai' || $request->status === 'dibatalkan') {
            $pemesanan->mobil->update(['status' => 'tersedia']);
        } elseif ($request->status === 'dikonfirmasi') {
            $pemesanan->mobil->update(['status' => 'disewa']);
        }

        return back()->with('success', 'Status pemesanan berhasil diubah ke: ' . ucfirst($request->status));
    }

    public function konfirmasiBayar(Request $request, $id)
    {
        $request->validate([
            'status_bayar' => 'required|in:dikonfirmasi,ditolak',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => $request->status_bayar]);

        // Kalau pembayaran dikonfirmasi, otomatis status pemesanan jadi dikonfirmasi
        if ($request->status_bayar === 'dikonfirmasi') {
            $pembayaran->pemesanan->update(['status' => 'dikonfirmasi']);
            $pembayaran->pemesanan->mobil->update(['status' => 'disewa']);
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
