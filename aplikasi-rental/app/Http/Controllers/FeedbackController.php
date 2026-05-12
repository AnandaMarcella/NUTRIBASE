<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['pemesanan.mobil'])
            ->where('user_id', Auth::id())
            ->latest()->get();

        // Hanya pemesanan SELESAI yang belum ada feedbacknya
        $pemesanans = Pemesanan::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback')
            ->with('mobil')
            ->get();

        $bolehFeedback = Pemesanan::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->exists();

        return view('feedback.index', compact('feedbacks', 'pemesanans', 'bolehFeedback'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:100',
            'isi'          => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'pemesanan_id' => 'nullable|exists:t_pemesanan,id',
        ]);

        // Validasi: harus punya minimal 1 pemesanan selesai
        $adaSelesai = Pemesanan::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->exists();

        if (!$adaSelesai) {
            return back()->withErrors(['isi' => 'Anda hanya bisa memberi feedback setelah memiliki pemesanan yang selesai.']);
        }

        // Validasi: pemesanan yang dipilih harus milik user & statusnya selesai
        if ($request->pemesanan_id) {
            $valid = Pemesanan::where('id', $request->pemesanan_id)
                ->where('user_id', Auth::id())
                ->where('status', 'selesai')
                ->exists();

            if (!$valid) {
                return back()->withErrors(['pemesanan_id' => 'Pemesanan tidak valid atau belum selesai.']);
            }
        }

        Feedback::create([
            'user_id'      => Auth::id(),
            'pemesanan_id' => $request->pemesanan_id,
            'judul'        => $request->judul,
            'isi'          => $request->isi,
            'rating'       => $request->rating,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dikirim!');
    }

    public function adminIndex()
    {
        $feedbacks = Feedback::with(['user', 'pemesanan.mobil', 'dibalasoleh'])->latest()->get();
        return view('feedback.admin', compact('feedbacks'));
    }

    public function balas(Request $request, $id)
    {
        $request->validate(['balasan' => 'required|string']);
        Feedback::findOrFail($id)->update([
            'balasan'      => $request->balasan,
            'dibalas_oleh' => Auth::id(),
            'dibalas_at'   => now(),
        ]);
        return back()->with('success', 'Balasan berhasil dikirim!');
    }
}
