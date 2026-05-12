<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $data = [
                'totalMobil'    => Mobil::count(),
                'totalUser'     => User::where('role','customer')->count(),
                'totalPemesanan'=> Pemesanan::count(),
                'pendingBayar'  => Pemesanan::where('status','pending')->count(),
                'pendingFeedback'=> Feedback::whereNull('balasan')->count(),
                'pemesananTerbaru' => Pemesanan::with(['user','mobil'])->latest()->take(5)->get(),
            ];
        } elseif ($user->isOwner()) {
            $data = [
                'totalPendapatan'   => Pemesanan::where('status','selesai')->sum('total_harga'),
                'totalPemesanan'    => Pemesanan::count(),
                'pemesananSelesai'  => Pemesanan::where('status','selesai')->count(),
                'totalMobil'        => Mobil::count(),
                'mobilTersedia'     => Mobil::where('status','tersedia')->count(),
                'pendingFeedback'   => Feedback::whereNull('balasan')->count(),
                'pemesananBulanIni' => Pemesanan::whereMonth('created_at', now()->month)->count(),
            ];
        } else {
            // customer
            $data = [
                'totalPemesanan' => Pemesanan::where('user_id', $user->id)->count(),
                'aktif'          => Pemesanan::where('user_id', $user->id)->whereIn('status',['pending','dikonfirmasi'])->count(),
                'selesai'        => Pemesanan::where('user_id', $user->id)->where('status','selesai')->count(),
                'pemesananTerbaru' => Pemesanan::with('mobil')->where('user_id',$user->id)->latest()->take(3)->get(),
            ];
        }

        return view('dashboard', compact('data', 'user'));
    }
}
