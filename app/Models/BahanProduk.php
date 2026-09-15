<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanProduk extends Model
{
    protected $table = 'bahan_produks';

    protected $fillable = [
        'produk_id',
        'nama',
        'jumlah',
        'satuan',
        'isi_kemasan',
        'harga_satuan',
        'total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}