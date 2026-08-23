<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PRODUKSI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $produksis = Produksi::with('produk')
            ->latest()
            ->get();

        return view('produksi.index', compact('produksis'));
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $produks = Produk::orderBy('nama')->get();

        return view('produksi.tambah', compact('produks'));
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' =>
                'required|date',

            'produk_id' =>
                'required|exists:produks,id',

            'jumlah_produksi' =>
                'required|numeric|min:1',

            'catatan' =>
                'nullable|string',
        ]);


        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | AMBIL PRODUK
            |--------------------------------------------------------------------------
            */

            $produk = Produk::findOrFail(
                $request->produk_id
            );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PRODUKSI
            |--------------------------------------------------------------------------
            */

            Produksi::create([

                'tanggal' =>
                    $request->tanggal,

                'produk_id' =>
                    $request->produk_id,

                'jumlah_produksi' =>
                    $request->jumlah_produksi,

                'catatan' =>
                    $request->catatan,

            ]);


            /*
            |--------------------------------------------------------------------------
            | TAMBAH STOK
            |--------------------------------------------------------------------------
            */

            $produk->increment(
                'stok',
                $request->jumlah_produksi
            );

        });


        return redirect('/produksi')
            ->with(
                'success',
                'Produksi berhasil ditambahkan dan stok diperbarui!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $produksi = Produksi::with('produk')
            ->findOrFail($id);

        return view(
            'produksi.detail',
            compact('produksi')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $produksi =
            Produksi::findOrFail($id);

        $produks =
            Produk::orderBy('nama')->get();

        return view(
            'produksi.edit',
            compact(
                'produksi',
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

        $produksi =
            Produksi::findOrFail($id);


        $request->validate([
            'tanggal' =>
                'required|date',

            'produk_id' =>
                'required|exists:produks,id',

            'jumlah_produksi' =>
                'required|numeric|min:1',

            'catatan' =>
                'nullable|string',
        ]);


        DB::transaction(function () use (
            $request,
            $produksi
        ) {

            /*
            |--------------------------------------------------------------------------
            | DATA LAMA
            |--------------------------------------------------------------------------
            */

            $produkLama =
                Produk::findOrFail(
                    $produksi->produk_id
                );


            $jumlahLama =
                $produksi->jumlah_produksi;


            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STOK LAMA
            |--------------------------------------------------------------------------
            */

            $produkLama->decrement(
                'stok',
                $jumlahLama
            );


            /*
            |--------------------------------------------------------------------------
            | PRODUK BARU
            |--------------------------------------------------------------------------
            */

            $produkBaru =
                Produk::findOrFail(
                    $request->produk_id
                );


            /*
            |--------------------------------------------------------------------------
            | TAMBAH STOK BARU
            |--------------------------------------------------------------------------
            */

            $produkBaru->increment(
                'stok',
                $request->jumlah_produksi
            );


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA PRODUKSI
            |--------------------------------------------------------------------------
            */

            $produksi->update([

                'tanggal' =>
                    $request->tanggal,

                'produk_id' =>
                    $request->produk_id,

                'jumlah_produksi' =>
                    $request->jumlah_produksi,

                'catatan' =>
                    $request->catatan,

            ]);

        });


        return redirect('/produksi')
            ->with(
                'success',
                'Produksi berhasil diperbarui dan stok disesuaikan!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $produksi =
            Produksi::findOrFail($id);


        DB::transaction(function () use ($produksi) {

            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STOK
            |--------------------------------------------------------------------------
            */

            $produk =
                Produk::findOrFail(
                    $produksi->produk_id
                );


            $produk->decrement(
                'stok',
                $produksi->jumlah_produksi
            );


            /*
            |--------------------------------------------------------------------------
            | HAPUS RIWAYAT PRODUKSI
            |--------------------------------------------------------------------------
            */

            $produksi->delete();

        });


        return redirect('/produksi')
            ->with(
                'success',
                'Produksi berhasil dihapus dan stok disesuaikan!'
            );
    }
}