<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', Tanggapan::class);

        $validated = $request->validate([
            'feedback_id'   => ['required', 'exists:feedback,id'],
            'isi_tanggapan' => ['required', 'string', 'max:2000'],
            'gambar'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // ✅ FIX: Jika yang membalas adalah penerima, pastikan feedback_id
        // memang milik penerima tersebut — mencegah penerima lain ikut balas
        // di thread bukan miliknya.
        if ($request->user()->isPenerima()) {
            $penerima = $request->user()->penerimaProfile;

            $milikSendiri = Feedback::where('id', $validated['feedback_id'])
                ->where('penerima_id', optional($penerima)->id)
                ->exists();

            if (! $milikSendiri) {
                abort(403, 'Anda hanya dapat membalas ulasan milik Anda sendiri.');
            }
        }

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tanggapan', 'public');
        }

        Tanggapan::create($validated);

        return redirect()->route('feedback.show', $validated['feedback_id'])
            ->with('success', 'Balasan berhasil dikirim.');
    }

    public function update(Request $request, Tanggapan $tanggapan)
    {
        $this->authorize('update', $tanggapan);

        $validated = $request->validate([
            'isi_tanggapan' => ['required', 'string', 'max:2000'],
            'gambar'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($tanggapan->gambar) {
                \Storage::disk('public')->delete($tanggapan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('tanggapan', 'public');
        }

        $tanggapan->update($validated);

        return redirect()->route('feedback.show', $tanggapan->feedback_id)
            ->with('success', 'Balasan berhasil diperbarui.');
    }

    public function destroy(Tanggapan $tanggapan)
    {
        $this->authorize('delete', $tanggapan);

        if ($tanggapan->gambar) {
            \Storage::disk('public')->delete($tanggapan->gambar);
        }

        $feedbackId = $tanggapan->feedback_id;
        $tanggapan->delete();

        return redirect()->route('feedback.show', $feedbackId)
            ->with('success', 'Balasan berhasil dihapus.');
    }
}