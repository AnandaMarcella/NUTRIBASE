<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $table = 't_users';
    protected $fillable = ['name', 'email', 'password', 'role', 'no_hp', 'alamat'];
    protected $hidden = ['password'];

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }
    public function isOwner(): bool { return $this->role === 'owner'; }

    public function pemesanan(): HasMany { return $this->hasMany(Pemesanan::class, 'user_id'); }
    public function feedback(): HasMany { return $this->hasMany(Feedback::class, 'user_id'); }
}
