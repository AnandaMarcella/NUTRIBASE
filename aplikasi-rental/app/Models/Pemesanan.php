<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemesanan extends Model
{
    protected $table = 't_pemesanan';
    protected $fillable = ['user_id', 'mobil_id', 'tanggal_mulai', 'tanggal_selesai', 'durasi_hari', 'total_harga', 'status', 'no_pemesanan'];

    public function user(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
    public function mobil(): BelongsTo { return $this->belongsTo(Mobil::class, 'mobil_id'); }
    public function pembayaran(): HasOne { return $this->hasOne(Pembayaran::class, 'pemesanan_id'); }
    public function feedback(): HasOne { return $this->hasOne(Feedback::class, 'pemesanan_id'); }
}
