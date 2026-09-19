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
        $produks = Produk::where('user_id', auth()->id())
            ->withSum('produksi', 'jumlah_produksi')
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
            | BAHAN / KOMPONEN
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

            // ISI KEMASAN OPSIONAL
            'bahan_isi.*' =>
                'nullable|numeric|min:1',

            'bahan_harga.*' =>
                'required|numeric|min:0',


            /*
            |--------------------------------------------------------------------------
            | BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
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
            | Jika Isi Kemasan diisi:
            |
            | Harga ÷ Isi Kemasan × Jumlah
            |
            | Jika Isi Kemasan kosong:
            |
            | Harga × Jumlah
            |
            */

            if ($request->bahan_nama) {

                foreach (
                    $request->bahan_nama as $key => $nama
                ) {

                    $jumlah =
                        (float) ($request->bahan_jumlah[$key] ?? 0);

                    $isi =
                        $request->bahan_isi[$key] ?? null;

                    $harga =
                        (float) ($request->bahan_harga[$key] ?? 0);


                    $total = 0;


                    if ($isi !== null && $isi !== '') {

                        $total =
                            ($harga / (float) $isi) * $jumlah;

                    } else {

                        $total =
                            $harga * $jumlah;
                    }


                    $totalBahan += $total;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | HITUNG BIAYA TAMBAHAN
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

                'user_id' =>
                    auth()->id(),

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
            | SIMPAN BAHAN / KOMPONEN
            |--------------------------------------------------------------------------
            */

            if ($request->bahan_nama) {

                foreach (
                    $request->bahan_nama as $key => $nama
                ) {

                    $jumlah =
                        (float) ($request->bahan_jumlah[$key] ?? 0);

                    /*
                    | Jangan cast ke float di sini.
                    | Supaya kosong tetap menjadi NULL.
                    */

                    $isi =
                        $request->bahan_isi[$key] ?? null;

                    $harga =
                        (float) ($request->bahan_harga[$key] ?? 0);


                    $total = 0;


                    if ($isi !== null && $isi !== '') {

                        $total =
                            ($harga / (float) $isi) * $jumlah;

                    } else {

                        $total =
                            $harga * $jumlah;
                    }


                    BahanProduk::create([

                        'produk_id' =>
                            $produk->id,

                        'nama' =>
                            $nama,

                        'jumlah' =>
                            $jumlah,

                        'satuan' =>
                            $request->bahan_satuan[$key] ?? '',

                        'isi_kemasan' =>
                            $isi,

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
                            $request->biaya_satuan[$key] ?? '',

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
        $produk = Produk::where('user_id', auth()->id())
            ->with([
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
        $produk = Produk::where('user_id', auth()->id())
            ->with([
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

    public function update(Request $request, $id)
    {
        $produk = Produk::where('user_id', auth()->id())
            ->findOrFail($id);


        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | PRODUK
            |--------------------------------------------------------------------------
            */

            'nama' =>
                'required',

            'kategori' =>
                'required',

            'harga_jual' =>
                'required|numeric|min:0',

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],


            /*
            |--------------------------------------------------------------------------
            | BAHAN / KOMPONEN
            |--------------------------------------------------------------------------
            */

            'bahan_id' =>
                'nullable|array',

            'bahan_nama' =>
                'required|array|min:1',

            'bahan_nama.*' =>
                'required',

            'bahan_jumlah' =>
                'required|array',

            'bahan_jumlah.*' =>
                'required|numeric|min:0',

            'bahan_satuan' =>
                'required|array',

            'bahan_satuan.*' =>
                'required',

            // ISI KEMASAN OPSIONAL
            'bahan_isi' =>
                'required|array',

            'bahan_isi.*' =>
                'nullable|numeric|min:1',

            'bahan_harga' =>
                'required|array',

            'bahan_harga.*' =>
                'required|numeric|min:0',


            /*
            |--------------------------------------------------------------------------
            | BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            */

            'biaya_id' =>
                'nullable|array',

            'biaya_nama' =>
                'nullable|array',

            'biaya_nama.*' =>
                'nullable',

            'biaya_jumlah' =>
                'nullable|array',

            'biaya_jumlah.*' =>
                'nullable|numeric|min:0',

            'biaya_satuan' =>
                'nullable|array',

            'biaya_satuan.*' =>
                'nullable',

            'biaya_harga' =>
                'nullable|array',

            'biaya_harga.*' =>
                'nullable|numeric|min:0',

        ]);


        DB::transaction(function () use ($request, $produk) {

            /*
            |--------------------------------------------------------------------------
            | HITUNG TOTAL BAHAN
            |--------------------------------------------------------------------------
            */

            $totalBahan = 0;


            foreach (
                $request->bahan_nama as $key => $nama
            ) {

                $jumlah =
                    (float) ($request->bahan_jumlah[$key] ?? 0);

                $isi =
                    $request->bahan_isi[$key] ?? null;

                $harga =
                    (float) ($request->bahan_harga[$key] ?? 0);


                $total = 0;


                if ($isi !== null && $isi !== '') {

                    $total =
                        ($harga / (float) $isi) * $jumlah;

                } else {

                    $total =
                        $harga * $jumlah;
                }


                $totalBahan += $total;
            }


            /*
            |--------------------------------------------------------------------------
            | HITUNG BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            */

            $totalBiaya = 0;


            if ($request->has('biaya_nama')) {

                foreach (
                    $request->biaya_nama as $key => $nama
                ) {

                    /*
                    | Kalau nama kosong,
                    | jangan dihitung.
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
            | TOTAL MODAL + HPP
            |--------------------------------------------------------------------------
            */

            $totalModal =
                $totalBahan + $totalBiaya;

            $hpp =
                $totalModal;


            /*
            |--------------------------------------------------------------------------
            | UPDATE PRODUK
            |--------------------------------------------------------------------------
            */

            $dataProduk = [

                'nama' =>
                    $request->nama,

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

            ];


            /*
            |--------------------------------------------------------------------------
            | UPDATE GAMBAR
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('gambar')) {

                if (
                    $produk->gambar &&
                    Storage::disk('public')
                        ->exists($produk->gambar)
                ) {

                    Storage::disk('public')
                        ->delete($produk->gambar);
                }


                $dataProduk['gambar'] =
                    $request
                        ->file('gambar')
                        ->store(
                            'produk',
                            'public'
                        );
            }


            $produk->update($dataProduk);


            /*
            |--------------------------------------------------------------------------
            | SINKRONISASI BAHAN
            |--------------------------------------------------------------------------
            */

            $bahanIds = [];


            foreach (
                $request->bahan_nama as $key => $nama
            ) {

                $bahanId =
                    $request->bahan_id[$key] ?? null;

                $jumlah =
                    (float) ($request->bahan_jumlah[$key] ?? 0);

                /*
                | Isi Kemasan boleh kosong.
                */

                $isi =
                    $request->bahan_isi[$key] ?? null;

                $harga =
                    (float) ($request->bahan_harga[$key] ?? 0);


                $total = 0;


                if ($isi !== null && $isi !== '') {

                    $total =
                        ($harga / (float) $isi) * $jumlah;

                } else {

                    $total =
                        $harga * $jumlah;
                }


                $dataBahan = [

                    'nama' =>
                        $nama,

                    'jumlah' =>
                        $jumlah,

                    'satuan' =>
                        $request->bahan_satuan[$key] ?? '',

                    'isi_kemasan' =>
                        $isi,

                    'harga_satuan' =>
                        $harga,

                    'total' =>
                        $total,

                ];


                if ($bahanId) {

                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE BAHAN LAMA
                    |--------------------------------------------------------------------------
                    */

                    $bahan = BahanProduk::where(
                            'produk_id',
                            $produk->id
                        )
                        ->where(
                            'id',
                            $bahanId
                        )
                        ->first();


                    if ($bahan) {

                        $bahan->update($dataBahan);

                        $bahanIds[] =
                            $bahan->id;
                    }

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | TAMBAH BAHAN BARU
                    |--------------------------------------------------------------------------
                    */

                    $bahan = BahanProduk::create([

                        'produk_id' =>
                            $produk->id,

                        ...$dataBahan,

                    ]);


                    $bahanIds[] =
                        $bahan->id;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS BAHAN YANG SUDAH DIHILANGKAN
            |--------------------------------------------------------------------------
            */

            BahanProduk::where(
                'produk_id',
                $produk->id
            )
                ->whereNotIn(
                    'id',
                    $bahanIds
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | SINKRONISASI BIAYA TAMBAHAN
            |--------------------------------------------------------------------------
            */

            $biayaIds = [];


            if ($request->has('biaya_nama')) {

                foreach (
                    $request->biaya_nama as $key => $nama
                ) {

                    /*
                    | Kalau nama kosong,
                    | jangan disimpan.
                    */

                    if (
                        empty(trim($nama ?? ''))
                    ) {

                        continue;
                    }


                    $biayaId =
                        $request->biaya_id[$key] ?? null;

                    $jumlah =
                        (float) ($request->biaya_jumlah[$key] ?? 0);

                    $harga =
                        (float) ($request->biaya_harga[$key] ?? 0);


                    $total =
                        $jumlah * $harga;


                    $dataBiaya = [

                        'nama' =>
                            $nama,

                        'jumlah' =>
                            $jumlah,

                        'satuan' =>
                            $request->biaya_satuan[$key] ?? '',

                        'harga_satuan' =>
                            $harga,

                        'total' =>
                            $total,

                    ];


                    if ($biayaId) {

                        /*
                        |--------------------------------------------------------------------------
                        | UPDATE BIAYA LAMA
                        |--------------------------------------------------------------------------
                        */

                        $biaya = BiayaTambahan::where(
                                'produk_id',
                                $produk->id
                            )
                            ->where(
                                'id',
                                $biayaId
                            )
                            ->first();


                        if ($biaya) {

                            $biaya->update($dataBiaya);

                            $biayaIds[] =
                                $biaya->id;
                        }

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | TAMBAH BIAYA BARU
                        |--------------------------------------------------------------------------
                        */

                        $biaya = BiayaTambahan::create([

                            'produk_id' =>
                                $produk->id,

                            ...$dataBiaya,

                        ]);


                        $biayaIds[] =
                            $biaya->id;
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS BIAYA YANG SUDAH DIHILANGKAN
            |--------------------------------------------------------------------------
            */

            if (count($biayaIds) > 0) {

                BiayaTambahan::where(
                    'produk_id',
                    $produk->id
                )
                    ->whereNotIn(
                        'id',
                        $biayaIds
                    )
                    ->delete();

            } else {

                BiayaTambahan::where(
                    'produk_id',
                    $produk->id
                )->delete();
            }

        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

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
        $produk = Produk::where('user_id', auth()->id())
            ->findOrFail($id);


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