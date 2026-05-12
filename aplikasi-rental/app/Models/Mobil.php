<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobil extends Model
{
    protected $table = 't_mobil';
    protected $fillable = ['nama_mobil', 'buatan', 'tahun', 'harga_sewa', 'status', 'gambar', 'deskripsi'];

    public function pemesanan(): HasMany { return $this->hasMany(Pemesanan::class, 'mobil_id'); }
}
