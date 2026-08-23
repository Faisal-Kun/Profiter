<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaTambahan extends Model
{
    protected $table = 'biaya_tambahans';

    protected $fillable = [
        'produk_id',
        'nama',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}