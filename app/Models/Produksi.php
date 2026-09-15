<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Produksi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'produk_id',
        'jumlah_produksi',
        'catatan',
    ];

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'produk_id'
        );
    }
}