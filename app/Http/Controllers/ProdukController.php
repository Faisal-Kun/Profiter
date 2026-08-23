<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\BahanProduk;
use App\Models\BiayaTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PRODUK
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $produks = Produk::withSum('produksi', 'jumlah_produksi')
            ->withSum('penjualan', 'jumlah_terjual')
            ->latest()
            ->get();

        foreach ($produks as $produk) {

            $totalProduksi =
                $produk->produksi_sum_jumlah_produksi ?? 0;

            $totalTerjual =
                $produk->penjualan_sum_jumlah_terjual ?? 0;

            $produk->stok =
                $totalProduksi - $totalTerjual;
        }

        return view(
            'produk.index',
            compact('produks')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN TAMBAH PRODUK
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('produk.tambah');
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PRODUK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA UTAMA
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'nama' =>
                'required',

            'kategori' =>
                'required',

            'harga_jual' =>
                'required|numeric|min:0',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',


            /*
            |--------------------------------------------------------------------------
            | BAHAN
            |--------------------------------------------------------------------------
            */

            'bahan_nama' =>
                'required|array|min:1',

            'bahan_nama.*' =>
                'required',

            'bahan_jumlah.*' =>
                'required|numeric|min:0',

            'bahan_satuan.*' =>
                'required',

            'bahan_isi.*' =>
                'required|numeric|min:0.01',

            'bahan_harga.*' =>
                'required|numeric|min:0',


            /*
            |--------------------------------------------------------------------------
            | BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            |
            | Tidak menggunakan required.
            | Jadi biaya tambahan boleh kosong.
            |
            */

            'biaya_nama' =>
                'nullable|array',

            'biaya_nama.*' =>
                'nullable',

            'biaya_jumlah.*' =>
                'nullable|numeric|min:0',

            'biaya_satuan.*' =>
                'nullable',

            'biaya_harga.*' =>
                'nullable|numeric|min:0',

        ]);


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($request) {

            $totalBahan = 0;
            $totalBiaya = 0;


            /*
            |--------------------------------------------------------------------------
            | HITUNG TOTAL BAHAN
            |--------------------------------------------------------------------------
            |
            | Rumus:
            |
            | Harga Kemasan / Isi Kemasan × Jumlah Digunakan
            |
            */

            if ($request->bahan_nama) {

                foreach (
                    $request->bahan_nama as $key => $nama
                ) {

                    $jumlah =
                        (float) ($request->bahan_jumlah[$key] ?? 0);

                    $isi =
                        (float) ($request->bahan_isi[$key] ?? 0);

                    $harga =
                        (float) ($request->bahan_harga[$key] ?? 0);


                    $total = 0;

                    if ($isi > 0) {

                        $total =
                            ($harga / $isi) * $jumlah;
                    }


                    $totalBahan += $total;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | HITUNG BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            |
            | Biaya tambahan boleh kosong.
            |
            | Hanya dihitung jika nama, jumlah, dan harga
            | tersedia.
            |
            */

            if (
                $request->has('biaya_nama') &&
                is_array($request->biaya_nama)
            ) {

                foreach (
                    $request->biaya_nama as $key => $nama
                ) {

                    /*
                    | Jika nama biaya kosong,
                    | lewati baris tersebut.
                    */

                    if (
                        empty(trim($nama ?? ''))
                    ) {

                        continue;
                    }


                    $jumlah =
                        (float) ($request->biaya_jumlah[$key] ?? 0);

                    $harga =
                        (float) ($request->biaya_harga[$key] ?? 0);


                    $total =
                        $jumlah * $harga;


                    $totalBiaya += $total;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL MODAL
            |--------------------------------------------------------------------------
            */

            $totalModal =
                $totalBahan + $totalBiaya;


            /*
            |--------------------------------------------------------------------------
            | HPP
            |--------------------------------------------------------------------------
            |
            | Karena jumlah produksi sudah dihapus dari form,
            | HPP sekarang dianggap sama dengan total modal.
            |
            */

            $hpp =
                $totalModal;


            /*
            |--------------------------------------------------------------------------
            | UPLOAD GAMBAR
            |--------------------------------------------------------------------------
            */

            $gambar = null;

            if ($request->hasFile('gambar')) {

                $gambar =
                    $request
                        ->file('gambar')
                        ->store(
                            'produk',
                            'public'
                        );
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PRODUK
            |--------------------------------------------------------------------------
            */

            $produk = Produk::create([

                'nama' =>
                    $request->nama,

                'gambar' =>
                    $gambar,

                'kategori' =>
                    $request->kategori,

                'harga_jual' =>
                    $request->harga_jual,

                'total_bahan' =>
                    $totalBahan,

                'total_biaya_tambahan' =>
                    $totalBiaya,

                'total_modal' =>
                    $totalModal,

                'hpp' =>
                    $hpp,

            ]);


            /*
            |--------------------------------------------------------------------------
            | SIMPAN BAHAN
            |--------------------------------------------------------------------------
            */

            if ($request->bahan_nama) {

                foreach (
                    $request->bahan_nama as $key => $nama
                ) {

                    $jumlah =
                        (float) ($request->bahan_jumlah[$key] ?? 0);

                    $isi =
                        (float) ($request->bahan_isi[$key] ?? 0);

                    $harga =
                        (float) ($request->bahan_harga[$key] ?? 0);


                    $total = 0;

                    if ($isi > 0) {

                        $total =
                            ($harga / $isi) * $jumlah;
                    }


                    BahanProduk::create([

                        'produk_id' =>
                            $produk->id,

                        'nama' =>
                            $nama,

                        'jumlah' =>
                            $jumlah,

                        'satuan' =>
                            $request->bahan_satuan[$key]
                            ?? '',

                        'harga_satuan' =>
                            $harga,

                        'total' =>
                            $total,

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            */

            if (
                $request->has('biaya_nama') &&
                is_array($request->biaya_nama)
            ) {

                foreach (
                    $request->biaya_nama as $key => $nama
                ) {

                    /*
                    | Kalau nama biaya kosong,
                    | jangan simpan baris ini.
                    */

                    if (
                        empty(trim($nama ?? ''))
                    ) {

                        continue;
                    }


                    $jumlah =
                        (float) ($request->biaya_jumlah[$key] ?? 0);

                    $harga =
                        (float) ($request->biaya_harga[$key] ?? 0);


                    $total =
                        $jumlah * $harga;


                    BiayaTambahan::create([

                        'produk_id' =>
                            $produk->id,

                        'nama' =>
                            $nama,

                        'jumlah' =>
                            $jumlah,

                        'satuan' =>
                            $request->biaya_satuan[$key]
                            ?? '',

                        'harga_satuan' =>
                            $harga,

                        'total' =>
                            $total,

                    ]);
                }
            }

        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect('/produk')
            ->with(
                'success',
                'Produk berhasil ditambahkan!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL PRODUK
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $produk = Produk::with([
            'bahan',
            'biayaTambahan'
        ])
            ->withSum(
                'produksi',
                'jumlah_produksi'
            )
            ->withSum(
                'penjualan',
                'jumlah_terjual'
            )
            ->findOrFail($id);


        $totalProduksi =
            $produk->produksi_sum_jumlah_produksi ?? 0;

        $totalTerjual =
            $produk->penjualan_sum_jumlah_terjual ?? 0;


        $produk->stok =
            $totalProduksi - $totalTerjual;


        return view(
            'produk.detail',
            compact('produk')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $produk = Produk::with([
            'bahan',
            'biayaTambahan'
        ])
            ->findOrFail($id);


        return view(
            'produk.edit',
            compact('produk')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUK
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $produk =
            Produk::findOrFail($id);


        $request->validate([

            'nama' =>
                'required',

            'kategori' =>
                'required',

            'harga_jual' =>
                'required|numeric|min:0',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA UPDATE
        |--------------------------------------------------------------------------
        */

        $data = [

            'nama' =>
                $request->nama,

            'kategori' =>
                $request->kategori,

            'harga_jual' =>
                $request->harga_jual,

        ];


        /*
        |--------------------------------------------------------------------------
        | UPDATE GAMBAR
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            /*
            | Hapus gambar lama
            */

            if (
                $produk->gambar &&
                Storage::disk('public')
                    ->exists($produk->gambar)
            ) {

                Storage::disk('public')
                    ->delete($produk->gambar);
            }


            /*
            | Simpan gambar baru
            */

            $data['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'produk',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUK
        |--------------------------------------------------------------------------
        */

        $produk->update($data);


        return redirect(
            '/produk/detail/' . $produk->id
        )->with(
            'success',
            'Produk berhasil diperbarui!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $produk =
            Produk::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | HAPUS GAMBAR
        |--------------------------------------------------------------------------
        */

        if (
            $produk->gambar &&
            Storage::disk('public')
                ->exists($produk->gambar)
        ) {

            Storage::disk('public')
                ->delete($produk->gambar);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS PRODUK
        |--------------------------------------------------------------------------
        */

        $produk->delete();


        return redirect('/produk')
            ->with(
                'success',
                'Produk berhasil dihapus!'
            );
    }
}