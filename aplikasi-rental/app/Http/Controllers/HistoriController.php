<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['mobil','pembayaran'])
            ->where('user_id', Auth::id())
            ->latest()->get();
        return view('histori.index', compact('pemesanans'));
    }
}
