<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        return view('pemesanan.index', compact('mobils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobil_id'        => 'required|exists:t_mobil,id',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);
        $durasi = now()->parse($request->tanggal_mulai)->diffInDays($request->tanggal_selesai);
        $total  = $durasi * $mobil->harga_sewa;
        $no     = 'RNT-' . strtoupper(uniqid());

        Pemesanan::create([
            'user_id'         => Auth::id(),
            'mobil_id'        => $request->mobil_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'durasi_hari'     => $durasi,
            'total_harga'     => $total,
            'status'          => 'pending',
            'no_pemesanan'    => $no,
        ]);

        return redirect()->route('histori.index')->with('success', 'Pemesanan berhasil! No. Pemesanan: '.$no);
    }
}
