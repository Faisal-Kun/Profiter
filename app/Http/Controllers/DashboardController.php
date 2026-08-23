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
        | PRODUK
        |--------------------------------------------------------------------------
        */

        $produks = Produk::latest()->get();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH JENIS PRODUK
        |--------------------------------------------------------------------------
        */

        $totalProduk = Produk::count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAPATAN
        |--------------------------------------------------------------------------
        */

        $pendapatan = Penjualan::sum('total_penjualan');


        /*
        |--------------------------------------------------------------------------
        | TOTAL KEUNTUNGAN
        |--------------------------------------------------------------------------
        */

        $keuntungan = Penjualan::sum('keuntungan');


        /*
        |--------------------------------------------------------------------------
        | TOTAL PRODUK TERJUAL
        |--------------------------------------------------------------------------
        */

        $terjual = Penjualan::sum('jumlah_terjual');


        /*
        |--------------------------------------------------------------------------
        | MODAL PRODUK
        |--------------------------------------------------------------------------
        */

        $modal = Produk::sum(
            DB::raw('stok * hpp')
        );


        /*
        |--------------------------------------------------------------------------
        | GRAFIK PENJUALAN
        |--------------------------------------------------------------------------
        */

        $chart = Penjualan::select(
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('SUM(total_penjualan) as total')
        )
        ->groupBy(
            DB::raw('YEAR(tanggal)'),
            DB::raw('MONTH(tanggal)')
        )
        ->orderBy('tahun')
        ->orderBy('bulan')
        ->get();


        $labels = [];

        $data = [];


        foreach ($chart as $item) {

            $namaBulan = date(
                'M',
                mktime(
                    0,
                    0,
                    0,
                    $item->bulan,
                    1
                )
            );


            $labels[] =
                $namaBulan . ' ' . $item->tahun;


            $data[] =
                $item->total;
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
            'data'
        ));
    }
}
