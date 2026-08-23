<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PENJUALAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $penjualans =
            Penjualan::with('produk')
                ->latest()
                ->get();

        return view(
            'penjualan.index',
            compact('penjualans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $produks =
            Produk::orderBy('nama')->get();

        return view(
            'penjualan.tambah',
            compact('produks')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENJUALAN
    |--------------------------------------------------------------------------
    */

   public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'produk_id' => 'required|exists:produks,id',
        'jumlah_terjual' => 'required|numeric|min:1',
        'catatan' => 'nullable|string',
    ]);

    $produk = Produk::findOrFail($request->produk_id);

    $jumlah = (int) $request->jumlah_terjual;

    /*
    |--------------------------------------------------------------------------
    | CEK STOK TERLEBIH DAHULU
    |--------------------------------------------------------------------------
    */

    if ($jumlah > $produk->stok) {

        return back()
            ->withInput()
            ->withErrors([
                'jumlah_terjual' =>
                    'Stok tidak mencukupi. Stok tersedia: '
                    . $produk->stok
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG PENJUALAN
    |--------------------------------------------------------------------------
    */

    $hargaJual = $produk->harga_jual;

    $hppProduk = $produk->hpp ?? 0;

    $totalPenjualan =
        $hargaJual * $jumlah;

    $totalHpp =
        $hppProduk * $jumlah;

    $keuntungan =
        $totalPenjualan - $totalHpp;


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENJUALAN
    |--------------------------------------------------------------------------
    */

    Penjualan::create([

        'tanggal' =>
            $request->tanggal,

        'produk_id' =>
            $produk->id,

        'jumlah_terjual' =>
            $jumlah,

        'harga_jual' =>
            $hargaJual,

        'total_penjualan' =>
            $totalPenjualan,

        'hpp' =>
            $totalHpp,

        'keuntungan' =>
            $keuntungan,

        'catatan' =>
            $request->catatan,

    ]);


    /*
    |--------------------------------------------------------------------------
    | KURANGI STOK
    |--------------------------------------------------------------------------
    */

    $produk->decrement(
        'stok',
        $jumlah
    );


    /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

    return redirect('/penjualan')
        ->with(
            'success',
            'Penjualan berhasil ditambahkan!'
        );
}    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $penjualan =
            Penjualan::with('produk')
                ->findOrFail($id);


        return view(
            'penjualan.detail',
            compact('penjualan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $penjualan =
            Penjualan::findOrFail($id);


        $produks =
            Produk::orderBy('nama')->get();


        return view(
            'penjualan.edit',
            compact(
                'penjualan',
                'produks'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $penjualan =
            Penjualan::findOrFail($id);


        $request->validate([
            'tanggal' =>
                'required|date',

            'produk_id' =>
                'required|exists:produks,id',

            'jumlah_terjual' =>
                'required|numeric|min:1',

            'catatan' =>
                'nullable|string',
        ]);


        DB::transaction(function () use (
            $request,
            $penjualan
        ) {

            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STOK PENJUALAN LAMA
            |--------------------------------------------------------------------------
            */

            $produkLama =
                Produk::lockForUpdate()
                    ->findOrFail(
                        $penjualan->produk_id
                    );


            $produkLama->increment(
                'stok',
                $penjualan->jumlah_terjual
            );


            /*
            |--------------------------------------------------------------------------
            | PRODUK BARU
            |--------------------------------------------------------------------------
            */

            $produkBaru =
                Produk::lockForUpdate()
                    ->findOrFail(
                        $request->produk_id
                    );


            /*
            |--------------------------------------------------------------------------
            | CEK STOK
            |--------------------------------------------------------------------------
            */

            if (
                $request->jumlah_terjual
                > $produkBaru->stok
            ) {

                throw new \Exception(
                    'Stok tidak mencukupi. Stok tersedia: '
                    . $produkBaru->stok
                );

            }


            /*
            |--------------------------------------------------------------------------
            | DATA PENJUALAN
            |--------------------------------------------------------------------------
            */

            $jumlah =
                $request->jumlah_terjual;


            $hargaJual =
                $produkBaru->harga_jual;


            $hppProduk =
                $produkBaru->hpp ?? 0;


            $totalPenjualan =
                $hargaJual * $jumlah;


            $totalHpp =
                $hppProduk * $jumlah;


            $keuntungan =
                $totalPenjualan - $totalHpp;


            /*
            |--------------------------------------------------------------------------
            | UPDATE PENJUALAN
            |--------------------------------------------------------------------------
            */

            $penjualan->update([

                'tanggal' =>
                    $request->tanggal,

                'produk_id' =>
                    $request->produk_id,

                'jumlah_terjual' =>
                    $jumlah,

                'harga_jual' =>
                    $hargaJual,

                'total_penjualan' =>
                    $totalPenjualan,

                'hpp' =>
                    $totalHpp,

                'keuntungan' =>
                    $keuntungan,

                'catatan' =>
                    $request->catatan,

            ]);


            /*
            |--------------------------------------------------------------------------
            | KURANGI STOK BARU
            |--------------------------------------------------------------------------
            */

            $produkBaru->decrement(
                'stok',
                $jumlah
            );

        });


        return redirect(
            '/penjualan/detail/' .
            $penjualan->id
        )->with(
            'success',
            'Penjualan berhasil diperbarui dan stok disesuaikan!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $penjualan =
            Penjualan::findOrFail($id);


        DB::transaction(function () use ($penjualan) {

            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STOK
            |--------------------------------------------------------------------------
            */

            $produk =
                Produk::lockForUpdate()
                    ->findOrFail(
                        $penjualan->produk_id
                    );


            $produk->increment(
                'stok',
                $penjualan->jumlah_terjual
            );


            /*
            |--------------------------------------------------------------------------
            | HAPUS PENJUALAN
            |--------------------------------------------------------------------------
            */

            $penjualan->delete();

        });


        return redirect('/penjualan')
            ->with(
                'success',
                'Penjualan berhasil dihapus dan stok dikembalikan!'
            );
    }
}