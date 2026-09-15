<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BahanProduk;
use App\Models\BiayaTambahan;
use App\Models\Produksi;
use App\Models\Penjualan;

class Produk extends Model
{
protected $fillable = [
    'user_id',
    'nama',
    'gambar',
    'kategori',
    'harga_jual',
    'jumlah_produksi',
    'stok',
    'total_bahan',
    'total_biaya_tambahan',
    'total_modal',
    'hpp',
];

    public function bahan()
    {
        return $this->hasMany(BahanProduk::class);
    }

    public function biayaTambahan()
    {
        return $this->hasMany(BiayaTambahan::class);
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'produk_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'produk_id');
    }
}