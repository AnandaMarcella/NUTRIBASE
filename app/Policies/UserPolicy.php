<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Hanya user yang is_super = true yang boleh melihat daftar pengguna.
     * Tidak bergantung pada username atau role — aman meski username diganti.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuper();
    }

    public function view(User $user, User $model): bool
    {
        return $user->isSuper() || $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->isSuper();
    }

    public function update(User $user, User $model): bool
    {
        return $user->isSuper() || $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->isSuper() && $user->id !== $model->id;
    }
}
