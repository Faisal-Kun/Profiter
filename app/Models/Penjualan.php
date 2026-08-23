<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [

        'tanggal',

        'produk_id',

        'jumlah_terjual',

        'harga_jual',

        'total_penjualan',

        'hpp',

        'keuntungan',

        'catatan',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI PRODUK
    |--------------------------------------------------------------------------
    */

    public function produk()
    {
        return $this->belongsTo(
            Produk::class
        );
    }
}
