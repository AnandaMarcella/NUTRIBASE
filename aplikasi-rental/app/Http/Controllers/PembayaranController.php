<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['mobil','pembayaran'])
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending','dikonfirmasi'])
            ->get();
        return view('pembayaran.index', compact('pemesanans'));
    }

    public function show($pemesananId)
    {
        $pemesanan = Pemesanan::with(['mobil','pembayaran'])
            ->where('user_id', Auth::id())
            ->findOrFail($pemesananId);
        return view('pembayaran.show', compact('pemesanan'));
    }

    public function konfirmasi(Request $request, $pemesananId)
    {
        $request->validate([
            'metode' => 'required|in:transfer_bca,transfer_bni,transfer_mandiri',
        ]);
        $pemesanan = Pemesanan::where('user_id', Auth::id())->findOrFail($pemesananId);

        Pembayaran::updateOrCreate(
            ['pemesanan_id' => $pemesanan->id],
            ['jumlah_bayar' => $pemesanan->total_harga, 'metode' => $request->metode, 'status' => 'menunggu']
        );

        return redirect()->route('pembayaran.detail', $pemesananId)->with('success', 'Konfirmasi pembayaran berhasil dikirim. Silakan transfer ke rekening yang tertera.');
    }
}
