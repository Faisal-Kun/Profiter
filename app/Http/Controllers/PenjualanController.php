<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::where('user_id', auth()->id())
            ->with('produk')
            ->latest()
            ->get();

        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $produks = Produk::where('user_id', auth()->id())
            ->orderBy('nama')
            ->get();

        return view('penjualan.tambah', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_terjual' => 'required|numeric|min:1',
            'catatan' => 'nullable|string',
        ]);

        $produk = Produk::where('user_id', auth()->id())
            ->findOrFail($request->produk_id);

        $jumlah = (int) $request->jumlah_terjual;

        if ($jumlah > $produk->stok) {
            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_terjual' =>
                        'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok
                ]);
        }

        $hargaJual = $produk->harga_jual;
        $hppProduk = $produk->hpp ?? 0;

        $totalPenjualan = $hargaJual * $jumlah;
        $totalHpp = $hppProduk * $jumlah;
        $keuntungan = $totalPenjualan - $totalHpp;

        Penjualan::create([
            'user_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'produk_id' => $produk->id,
            'jumlah_terjual' => $jumlah,
            'harga_jual' => $hargaJual,
            'total_penjualan' => $totalPenjualan,
            'hpp' => $totalHpp,
            'keuntungan' => $keuntungan,
            'catatan' => $request->catatan,
        ]);

        $produk->decrement('stok', $jumlah);

        return redirect('/penjualan')
            ->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $penjualan = Penjualan::where('user_id', auth()->id())
            ->with('produk')
            ->findOrFail($id);

        return view('penjualan.detail', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::where('user_id', auth()->id())
            ->findOrFail($id);

        $produks = Produk::where('user_id', auth()->id())
            ->orderBy('nama')
            ->get();

        return view(
            'penjualan.edit',
            compact('penjualan', 'produks')
        );
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::where('user_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_terjual' => 'required|numeric|min:1',
            'catatan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $penjualan) {

            $produkLama = Produk::where('user_id', auth()->id())
                ->lockForUpdate()
                ->findOrFail($penjualan->produk_id);

            $produkLama->increment(
                'stok',
                $penjualan->jumlah_terjual
            );

            $produkBaru = Produk::where('user_id', auth()->id())
                ->lockForUpdate()
                ->findOrFail($request->produk_id);

            if ($request->jumlah_terjual > $produkBaru->stok) {
                throw new \Exception(
                    'Stok tidak mencukupi. Stok tersedia: ' .
                    $produkBaru->stok
                );
            }

            $jumlah = $request->jumlah_terjual;
            $hargaJual = $produkBaru->harga_jual;
            $hppProduk = $produkBaru->hpp ?? 0;

            $totalPenjualan = $hargaJual * $jumlah;
            $totalHpp = $hppProduk * $jumlah;
            $keuntungan = $totalPenjualan - $totalHpp;

            $penjualan->update([
                'tanggal' => $request->tanggal,
                'produk_id' => $request->produk_id,
                'jumlah_terjual' => $jumlah,
                'harga_jual' => $hargaJual,
                'total_penjualan' => $totalPenjualan,
                'hpp' => $totalHpp,
                'keuntungan' => $keuntungan,
                'catatan' => $request->catatan,
            ]);

            $produkBaru->decrement(
                'stok',
                $jumlah
            );
        });

        return redirect(
            '/penjualan/detail/' . $penjualan->id
        )->with(
            'success',
            'Penjualan berhasil diperbarui dan stok disesuaikan!'
        );
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::where('user_id', auth()->id())
            ->findOrFail($id);

        DB::transaction(function () use ($penjualan) {

            $produk = Produk::where('user_id', auth()->id())
                ->lockForUpdate()
                ->findOrFail($penjualan->produk_id);

            $produk->increment(
                'stok',
                $penjualan->jumlah_terjual
            );

            $penjualan->delete();
        });

        return redirect('/penjualan')
            ->with(
                'success',
                'Penjualan berhasil dihapus dan stok dikembalikan!'
            );
    }
}