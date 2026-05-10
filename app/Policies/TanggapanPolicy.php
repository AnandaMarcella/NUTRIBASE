<?php

namespace App\Policies;

use App\Models\Tanggapan;
use App\Models\User;
use App\Models\Feedback;

class TanggapanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isKader() || $user->isKoordinator() || $user->isPenerima();
    }

    public function view(User $user, Tanggapan $tanggapan): bool
    {
        return $this->viewAny($user);
    }

    /**
     * ✅ FIX: Izinkan penerima membalas di thread ulasan miliknya sendiri.
     *
     * Sebelumnya hanya kader/koordinator yang bisa membalas, sehingga
     * penerima mendapat 403 saat mencoba ikut balas di thread-nya sendiri.
     *
     * Logika baru:
     * - Kader / koordinator → selalu boleh
     * - Penerima → boleh, TAPI hanya jika feedback_id yang dikirim
     *   adalah milik penerima itu sendiri (dicek via penerimaProfile)
     */
    public function create(User $user): bool
    {
        // Kader dan koordinator selalu boleh membalas
        if ($user->isKader() || $user->isKoordinator()) {
            return true;
        }

        // Penerima boleh — kepemilikan feedback_id dicek di controller
        if ($user->isPenerima()) {
            return true;
        }

        return false;
    }

    public function update(User $user, Tanggapan $tanggapan): bool
    {
        return $tanggapan->user_id === $user->id;
    }

    public function delete(User $user, Tanggapan $tanggapan): bool
    {
        // Penerima bisa hapus balasannya sendiri
        // Kader/koordinator bisa hapus balasan mereka sendiri
        return $tanggapan->user_id === $user->id;
    }
}