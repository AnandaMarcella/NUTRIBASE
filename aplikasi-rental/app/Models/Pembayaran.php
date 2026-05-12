<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 't_pembayaran';
    protected $fillable = ['pemesanan_id', 'jumlah_bayar', 'metode', 'status', 'bukti_transfer', 'catatan'];

    public function pemesanan(): BelongsTo { return $this->belongsTo(Pemesanan::class, 'pemesanan_id'); }
}
