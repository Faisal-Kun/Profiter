<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | USER LOGIN
        |--------------------------------------------------------------------------
        */

        $userId = auth()->id();


        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */

        $produks = Produk::where('user_id', $userId)
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH JENIS PRODUK
        |--------------------------------------------------------------------------
        */

        $totalProduk = Produk::where('user_id', $userId)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAPATAN
        |--------------------------------------------------------------------------
        */

        $pendapatan = Penjualan::where('user_id', $userId)
            ->sum('total_penjualan');


        /*
        |--------------------------------------------------------------------------
        | TOTAL KEUNTUNGAN
        |--------------------------------------------------------------------------
        */

        $keuntungan = Penjualan::where('user_id', $userId)
            ->sum('keuntungan');


        /*
        |--------------------------------------------------------------------------
        | TOTAL PRODUK TERJUAL
        |--------------------------------------------------------------------------
        */

        $terjual = Penjualan::where('user_id', $userId)
            ->sum('jumlah_terjual');


        /*
        |--------------------------------------------------------------------------
        | MODAL PRODUK
        |--------------------------------------------------------------------------
        */

        $modal = Produk::where('user_id', $userId)
            ->sum(DB::raw('stok * hpp'));


        /*
        |--------------------------------------------------------------------------
        | GRAFIK PENJUALAN
        |--------------------------------------------------------------------------
        |
        | Grafik sekarang berdasarkan:
        |
        | Tanggal + Produk + Jumlah Terjual
        |
        | Contoh:
        |
        | 10 Sep | Ayam Crispy | 5
        | 10 Sep | Es Teh      | 3
        | 11 Sep | Ayam Crispy | 7
        |
        |--------------------------------------------------------------------------
        */

        $penjualanGrafik = Penjualan::where('user_id', $userId)
            ->with('produk')
            ->orderBy('tanggal')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LABEL TANGGAL
        |--------------------------------------------------------------------------
        */

        $labels = $penjualanGrafik
            ->map(function ($penjualan) {

                return \Carbon\Carbon::parse(
                    $penjualan->tanggal
                )->format('d M');

            })
            ->unique()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | PRODUK YANG ADA DI PENJUALAN
        |--------------------------------------------------------------------------
        */

        $namaProduk = $penjualanGrafik
            ->filter(function ($penjualan) {

                return $penjualan->produk !== null;

            })
            ->map(function ($penjualan) {

                return $penjualan->produk->nama;

            })
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK PER PRODUK
        |--------------------------------------------------------------------------
        */

        $dataGrafik = [];


        foreach ($namaProduk as $nama) {

            $dataGrafik[$nama] = [];


            foreach ($labels as $label) {

                $jumlahTerjual = $penjualanGrafik
                    ->filter(function ($penjualan) use (
                        $nama,
                        $label
                    ) {

                        if (!$penjualan->produk) {
                            return false;
                        }


                        $tanggal = \Carbon\Carbon::parse(
                            $penjualan->tanggal
                        )->format('d M');


                        return
                            $penjualan->produk->nama === $nama
                            &&
                            $tanggal === $label;

                    })
                    ->sum('jumlah_terjual');


                $dataGrafik[$nama][] =
                    $jumlahTerjual;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'produks',
            'totalProduk',
            'pendapatan',
            'keuntungan',
            'terjual',
            'modal',
            'labels',
            'dataGrafik'
        ));
    }
}