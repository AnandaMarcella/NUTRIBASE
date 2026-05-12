<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 't_feedback';
    protected $fillable = ['user_id', 'pemesanan_id', 'judul', 'isi', 'rating', 'balasan', 'dibalas_oleh', 'dibalas_at'];

    public function user(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
    public function pemesanan(): BelongsTo { return $this->belongsTo(Pemesanan::class, 'pemesanan_id'); }
    public function dibalasoleh(): BelongsTo { return $this->belongsTo(User::class, 'dibalas_oleh'); }
}
