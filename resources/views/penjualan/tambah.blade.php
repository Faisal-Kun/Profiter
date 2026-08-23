
@extends('layouts.app')

@section('content')

<style>

    .form-card {
        border: none;
        border-radius: 15px;
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: #888;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .summary-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 9px 0;
    }

    .summary-final {
        border-top: 1px solid #ddd;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 20px;
        font-weight: 700;
    }

    .profit-box {
        background: #198754;
        color: white;
        border-radius: 14px;
        padding: 22px;
    }

    .profit-number {
        font-size: 28px;
        font-weight: 700;
    }

</style>


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3>
            Tambah Penjualan
        </h3>

        <p class="text-muted mb-0">
            Catat penjualan produk
        </p>

    </div>


    <a
        href="/penjualan"
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>



{{-- ========================================================= --}}
{{-- ERROR VALIDASI --}}
{{-- ========================================================= --}}

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>
            Data belum bisa disimpan.
        </strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif



{{-- ========================================================= --}}
{{-- FORM --}}
{{-- ========================================================= --}}

<form
    action="/penjualan"
    method="POST"
>

    @csrf


    {{-- ===================================================== --}}
    {{-- INFORMASI PENJUALAN --}}
    {{-- ===================================================== --}}

    <div class="card form-card mb-4">

        <div class="card-body">

            <h5 class="section-title">
                Informasi Penjualan
            </h5>

            <p class="section-subtitle">
                Masukkan data penjualan produk
            </p>


            <div class="row g-3">


                {{-- TANGGAL --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Tanggal Penjualan
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        required
                    >

                </div>



                {{-- PRODUK --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Produk
                    </label>

                    <select
                        name="produk_id"
                        id="produkSelect"
                        class="form-select"
                        required
                    >

                        <option
                            value=""
                            disabled
                            selected
                        >
                            Pilih Produk
                        </option>


                        @foreach($produks as $produk)

                            <option
                                value="{{ $produk->id }}"
                                data-harga="{{ $produk->harga_jual }}"
                                data-hpp="{{ $produk->hpp }}"
                                {{ old('produk_id') == $produk->id ? 'selected' : '' }}
                            >

                                {{ $produk->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- JUMLAH TERJUAL --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Jumlah Terjual
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            name="jumlah_terjual"
                            id="jumlahTerjual"
                            class="form-control"
                            min="1"
                            placeholder="Contoh: 10"
                            value="{{ old('jumlah_terjual') }}"
                            required
                        >

                        <span class="input-group-text">
                            produk
                        </span>

                    </div>

                </div>



                {{-- CATATAN --}}

                <div class="col-12">

                    <label class="form-label">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="3"
                        placeholder="Contoh: Penjualan di toko..."
                    >{{ old('catatan') }}</textarea>

                </div>

            </div>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- HASIL PERHITUNGAN --}}
    {{-- ===================================================== --}}

    <div
        class="row g-4 mb-4"
        id="hasilPenjualan"
        style="display:none;"
    >


        {{-- PERHITUNGAN --}}

        <div class="col-lg-7">

            <div class="card form-card h-100">

                <div class="card-body">

                    <h5 class="section-title">
                        Perhitungan
                    </h5>

                    <p class="section-subtitle">
                        Dihitung otomatis berdasarkan produk dan jumlah terjual
                    </p>


                    <div class="summary-box">


                        {{-- HARGA JUAL --}}

                        <div class="summary-row">

                            <span>
                                Harga Jual / Produk
                            </span>

                            <strong id="hargaJual">
                                Rp0
                            </strong>

                        </div>



                        {{-- HPP --}}

                        <div class="summary-row">

                            <span>
                                HPP / Produk
                            </span>

                            <strong id="hppProduk">
                                Rp0
                            </strong>

                        </div>



                        {{-- JUMLAH --}}

                        <div class="summary-row">

                            <span>
                                Jumlah Terjual
                            </span>

                            <strong id="hasilJumlah">
                                0 produk
                            </strong>

                        </div>



                        {{-- TOTAL PENJUALAN --}}

                        <div class="summary-row">

                            <span>
                                Total Penjualan
                            </span>

                            <strong id="totalPenjualan">
                                Rp0
                            </strong>

                        </div>



                        {{-- TOTAL HPP --}}

                        <div class="summary-row">

                            <span>
                                Total HPP
                            </span>

                            <strong id="totalHpp">
                                Rp0
                            </strong>

                        </div>



                        {{-- KEUNTUNGAN --}}

                        <div class="summary-row summary-final">

                            <span>
                                Keuntungan
                            </span>

                            <strong
                                id="keuntungan"
                                class="text-success"
                            >
                                Rp0
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- BOX KEUNTUNGAN --}}
        {{-- ================================================= --}}

        <div class="col-lg-5">

            <div class="profit-box h-100">

                <small>
                    Keuntungan Penjualan
                </small>


                <div
                    id="profitNumber"
                    class="profit-number mt-2"
                >
                    Rp0
                </div>


                <p class="mt-2 mb-4">
                    Perkiraan keuntungan dari penjualan ini
                </p>


                <div class="d-flex justify-content-between">

                    <span>
                        Omzet
                    </span>

                    <strong id="profitOmzet">
                        Rp0
                    </strong>

                </div>


                <div class="d-flex justify-content-between mt-2">

                    <span>
                        Total HPP
                    </span>

                    <strong id="profitHpp">
                        Rp0
                    </strong>

                </div>

            </div>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- BUTTON --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-end gap-2 mb-5">

        <a
            href="/penjualan"
            class="btn btn-secondary"
        >

            Batal

        </a>


        <button
            type="submit"
            class="btn btn-warning px-4"
        >

            <i class="bi bi-check-circle"></i>

            Simpan Penjualan

        </button>

    </div>

</form>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

function rupiah(angka)
{
    return new Intl.NumberFormat(
        'id-ID',
        {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }
    ).format(angka);
}



function hitungPenjualan()
{
    const select =
        document.getElementById('produkSelect');


    const jumlahInput =
        document.getElementById('jumlahTerjual');


    const hasil =
        document.getElementById('hasilPenjualan');


    const option =
        select.options[select.selectedIndex];


    /*
    |--------------------------------------------------------------------------
    | JIKA PRODUK BELUM DIPILIH
    |--------------------------------------------------------------------------
    */

    if (!option || !option.value)
    {
        hasil.style.display = 'none';

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | AMBIL HARGA
    |--------------------------------------------------------------------------
    */

    const harga =
        parseFloat(
            option.dataset.harga
        ) || 0;


    /*
    |--------------------------------------------------------------------------
    | AMBIL HPP
    |--------------------------------------------------------------------------
    */

    const hpp =
        parseFloat(
            option.dataset.hpp
        ) || 0;


    /*
    |--------------------------------------------------------------------------
    | AMBIL JUMLAH
    |--------------------------------------------------------------------------
    */

    const jumlah =
        parseFloat(
            jumlahInput.value
        ) || 0;


    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL
    |--------------------------------------------------------------------------
    */

    const totalPenjualan =
        harga * jumlah;


    const totalHpp =
        hpp * jumlah;


    const keuntungan =
        totalPenjualan - totalHpp;



    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN DATA
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('hargaJual')
        .innerText =
        rupiah(harga);


    document
        .getElementById('hppProduk')
        .innerText =
        rupiah(hpp);


    document
        .getElementById('hasilJumlah')
        .innerText =
        jumlah + ' produk';


    document
        .getElementById('totalPenjualan')
        .innerText =
        rupiah(totalPenjualan);


    document
        .getElementById('totalHpp')
        .innerText =
        rupiah(totalHpp);


    document
        .getElementById('keuntungan')
        .innerText =
        rupiah(keuntungan);


    document
        .getElementById('profitNumber')
        .innerText =
        rupiah(keuntungan);


    document
        .getElementById('profitOmzet')
        .innerText =
        rupiah(totalPenjualan);


    document
        .getElementById('profitHpp')
        .innerText =
        rupiah(totalHpp);


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HASIL
    |--------------------------------------------------------------------------
    */

    hasil.style.display = 'flex';
}



/*
|--------------------------------------------------------------------------
| EVENT PRODUK
|--------------------------------------------------------------------------
*/

document
    .getElementById('produkSelect')
    .addEventListener(
        'change',
        hitungPenjualan
    );



/*
|--------------------------------------------------------------------------
| EVENT JUMLAH
|--------------------------------------------------------------------------
*/

document
    .getElementById('jumlahTerjual')
    .addEventListener(
        'input',
        hitungPenjualan
    );



/*
|--------------------------------------------------------------------------
| HITUNG ULANG JIKA OLD VALUE ADA
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {
        hitungPenjualan();
    }
);

</script>

@endsection