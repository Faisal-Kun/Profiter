@extends('layouts.app')

@section('content')

<style>

    /* =========================
       GLOBAL FORM
    ========================= */

    .form-card {
        background: #17191f;
        border: 1px solid #272a33;
        border-radius: 16px;
        overflow: hidden;
        color: #fff;
    }

    .form-card .card-body {
        padding: 24px;
    }

    .section-title {
        color: #fff;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: #858994;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .form-label {
        color: #c9ccd4;
        font-weight: 600;
        font-size: 13px;
    }


    /* =========================
       INPUT
    ========================= */

    .form-control,
    .form-select {
        background: #11141b;
        border: 1px solid #353945;
        color: #fff;
        border-radius: 9px;
        padding: 11px 13px;
    }

    .form-control::placeholder {
        color: #626875;
    }

    .form-control:focus,
    .form-select:focus {
        background: #11141b;
        color: #fff;
        border-color: #22d3ee;
        box-shadow: 0 0 0 3px rgba(34, 211, 238, .10);
    }

    /* Input file */

    input[type="file"] {
        color: #858994;
    }

    input[type="file"]::file-selector-button {
        background: #22d3ee;
        color: #061014;
        border: none;
        padding: 9px 14px;
        margin-right: 12px;
        font-weight: 600;
        cursor: pointer;
    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {
        background: #20232b;
        border-color: #353945;
        color: #22d3ee;
        font-weight: 600;
    }


    /* =========================
       DYNAMIC ROW
    ========================= */

    .dynamic-row {
        background: #11141b;
        border: 1px solid #272a33;
        border-radius: 12px;
        padding: 17px;
        margin-bottom: 10px;
    }

    .dynamic-row:hover {
        border-color: rgba(34, 211, 238, .35);
    }


    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-warning {
        background: #22d3ee !important;
        border-color: #22d3ee !important;
        color: #061014 !important;
        font-weight: 600;
    }

    .btn-warning:hover {
        background: #67e8f9 !important;
        border-color: #67e8f9 !important;
        color: #061014 !important;
        transform: translateY(-1px);
    }


    /* =========================
       BUTTON SECONDARY
    ========================= */

    .btn-secondary {
        background: #20232b;
        border: 1px solid #353945;
        color: #c9ccd4;
    }

    .btn-secondary:hover {
        background: #292e38;
        border-color: #454b59;
        color: #fff;
    }


    /* =========================
       BUTTON DELETE
    ========================= */

    .btn-outline-danger {
        border-color: #353945;
        color: #858994;
    }

    .btn-outline-danger:hover {
        background: rgba(255, 92, 92, .10);
        border-color: #ff5c5c;
        color: #ff5c5c;
    }


    /* =========================
       TEXT MUTED
    ========================= */

    .text-muted {
        color: #858994 !important;
    }


    /* =========================
       RESULT BOX
    ========================= */

    .result-box {
        background: #11141b;
        border: 1px solid #272a33;
        border-radius: 12px;
        padding: 20px;
    }

    .result-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        color: #b8bdc8;
    }

    .result-row strong {
        color: #fff;
    }

    .result-final {
        border-top: 1px solid #353945;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 19px;
        font-weight: 700;
    }

    #hpp {
        color: #22d3ee !important;
    }


    /* =========================
       BIAYA BAHAN
    ========================= */

    .bahan-total {
        color: #22d3ee;
        font-weight: 600;
    }


    /* =========================
       PROFIT RESULT
    ========================= */

    .profit-result {
        background:
            linear-gradient(
                135deg,
                #0d3038,
                #12343b
            );

        border: 1px solid rgba(34, 211, 238, .25);
        color: #fff;
        border-radius: 16px;
        padding: 22px;
    }

    .profit-result small {
        color: #8edee8;
    }

    .profit-number {
        color: #22d3ee;
        font-size: 28px;
        font-weight: 700;
    }

    .profit-result p {
        color: #858994;
    }

    .profit-result hr {
        border-color: #36535a;
        opacity: 1;
    }

    .profit-result strong {
        color: #fff;
    }


    /* =========================
       ALERT ERROR
    ========================= */

    .alert-danger {
        background: rgba(255, 92, 92, .08);
        border: 1px solid rgba(255, 92, 92, .25);
        color: #ff7b7b;
        border-radius: 10px;
    }

    .alert-danger strong {
        color: #ff7b7b;
    }


    /* =========================
       FILE INFO
    ========================= */

    .form-card small {
        color: #626875 !important;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .form-card .card-body {
            padding: 18px;
        }

        .dynamic-row {
            padding: 14px;
        }

        .profit-number {
            font-size: 24px;
        }

    }

</style>

{{-- HEADER --}}

<div class="d-flex justify-content-between align-items-center mb-4">


<div>
    <h3>Tambah Produk</h3>

    <p class="text-muted mb-0">
        Masukkan informasi produk dan biaya produksinya
    </p>
</div>

<a href="/produk" class="btn btn-secondary">
    <i class="bi bi-arrow-left"></i>
    Kembali
</a>


</div>

<form action="/produk" method="POST" enctype="multipart/form-data">


@csrf


{{-- ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger">

        <strong>Data belum bisa disimpan:</strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>
@endif


{{-- GAMBAR --}}
<div class="card form-card mb-4">

    <div class="card-body">

        <label class="form-label">
            Gambar Produk
        </label>

        <input
            type="file"
            name="gambar"
            class="form-control"
            accept="image/jpeg,image/png,image/webp"
        >

        <small class="text-muted">
            Format JPG, JPEG, PNG, atau WEBP. Maksimal 5MB.
        </small>

    </div>

</div>


{{-- INFORMASI PRODUK --}}
<div class="card form-card mb-4">

    <div class="card-body">

        <h5 class="section-title">
            Informasi Produk
        </h5>

        <p class="section-subtitle">
            Informasi dasar produk yang akan dijual
        </p>


        <div class="row g-3">

            {{-- NAMA --}}
            <div class="col-md-6">

                <label class="form-label">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Contoh: Ayam Crispy"
                    required
                >

            </div>


            {{-- KATEGORI --}}
            <div class="col-md-6">

                <label class="form-label">
                    Kategori
                </label>

                <input
                    type="text"
                    name="kategori"
                    class="form-control"
                    list="daftarKategori"
                    placeholder="Pilih atau ketik kategori"
                    required
                >

                <datalist id="daftarKategori">

                    <option value="Makanan">
                    <option value="Minuman">
                    <option value="Cemilan">
                    <option value="Fashion">
                    <option value="Aksesoris">
                    <option value="Elektronik">
                    <option value="Lainnya">

                </datalist>

            </div>


            {{-- HARGA JUAL --}}
            <div class="col-md-6">

                <label class="form-label">
                    Harga Jual
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        id="hargaJual"
                        name="harga_jual"
                        class="form-control"
                        placeholder="15000"
                        min="0"
                        required
                    >

                </div>

            </div>

        </div>

    </div>

</div>


{{-- BAHAN --}}
<div class="card form-card mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h5 class="section-title">
                    Bahan yang Digunakan
                </h5>

                <p class="section-subtitle mb-0">
                    Masukkan bahan dan jumlah yang digunakan
                </p>

            </div>

            <button
                type="button"
                class="btn btn-warning btn-sm"
                onclick="tambahBahan()"
            >

                <i class="bi bi-plus-circle"></i>
                Tambah Bahan

            </button>

        </div>


        <div id="daftarBahan">

            {{-- BAHAN PERTAMA --}}
            <div class="dynamic-row bahan-row">

                <div class="row g-3 align-items-end">

                    {{-- NAMA --}}
                    <div class="col-lg-3">

                        <label class="form-label">
                            Nama Bahan
                        </label>

                        <input
                            type="text"
                            name="bahan_nama[]"
                            class="form-control"
                            placeholder="Contoh: Tepung"
                            required
                        >

                    </div>


                    {{-- JUMLAH --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Jumlah Digunakan
                        </label>

                        <input
                            type="number"
                            name="bahan_jumlah[]"
                            class="form-control bahan-dipakai"
                            placeholder="10"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="bahan_satuan[]"
                            class="form-control"
                            list="satuanBahan"
                            placeholder="Ketik satuan"
                            required
                        >

                        <datalist id="satuanBahan">

                            <option value="pcs">
                            <option value="kg">
                            <option value="gram">
                            <option value="liter">
                            <option value="ml">
                            <option value="butir">
                            <option value="bungkus">
                            <option value="pack">
                            <option value="botol">

                        </datalist>

                    </div>


                    {{-- ISI KEMASAN --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Isi Kemasan
                        </label>

                        <input
                            type="number"
                            name="bahan_isi[]"
                            class="form-control bahan-isi"
                            placeholder="30"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    {{-- HARGA KEMASAN --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Harga Kemasan
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="bahan_harga[]"
                                class="form-control bahan-harga"
                                placeholder="5000"
                                min="0"
                                required
                            >

                        </div>

                    </div>


                    {{-- HAPUS --}}
                    <div class="col-lg-1">

                        <button
                            type="button"
                            class="btn btn-outline-danger w-100"
                            onclick="hapusBahan(this)"
                        >

                            <i class="bi bi-trash"></i>

                        </button>

                    </div>

                </div>


                {{-- HASIL BIAYA BAHAN --}}
                <div class="text-end mt-3">

                    <span class="text-muted">
                        Biaya bahan:
                    </span>

                    <strong class="bahan-total">
                        Rp0
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- BIAYA TAMBAHAN --}}
<div class="card form-card mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h5 class="section-title">
                    Biaya Tambahan
                </h5>

                <p class="section-subtitle mb-0">
                    Opsional. Contoh: minyak, gas, kemasan, listrik, dan lainnya.
                </p>

            </div>

            <button
                type="button"
                class="btn btn-warning btn-sm"
                onclick="tambahBiaya()"
            >

                <i class="bi bi-plus-circle"></i>
                Tambah Biaya

            </button>

        </div>


        <div id="daftarBiaya">

            {{-- BIAYA PERTAMA --}}
            <div class="dynamic-row biaya-row">

                <div class="row g-2 align-items-end">

                    {{-- NAMA --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Nama Biaya
                        </label>

                        <input
                            type="text"
                            name="biaya_nama[]"
                            class="form-control biaya-nama"
                            placeholder="Contoh: Minyak Goreng"
                        >

                    </div>


                    {{-- JUMLAH --}}
                    <div class="col-md-2">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            name="biaya_jumlah[]"
                            class="form-control biaya-jumlah"
                            placeholder="2"
                            min="0"
                            step="0.01"
                        >

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-md-2">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="biaya_satuan[]"
                            class="form-control biaya-satuan"
                            list="satuanBiaya"
                            placeholder="Ketik satuan"
                        >

                        <datalist id="satuanBiaya">

                            <option value="liter">
                            <option value="kg">
                            <option value="gram">
                            <option value="ml">
                            <option value="pcs">
                            <option value="tabung">
                            <option value="kWh">
                            <option value="lainnya">

                        </datalist>

                    </div>


                    {{-- HARGA --}}
                    <div class="col-md-2">

                        <label class="form-label">
                            Harga Satuan
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="biaya_harga[]"
                                class="form-control biaya-harga"
                                placeholder="18000"
                                min="0"
                            >

                        </div>

                    </div>


                    {{-- HAPUS --}}
                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-outline-danger w-100"
                            onclick="hapusBiaya(this)"
                        >

                            <i class="bi bi-trash"></i>
                            Hapus

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- HASIL PERHITUNGAN --}}
<div class="row g-4 mb-4">

    {{-- PERHITUNGAN --}}
    <div class="col-lg-7">

        <div class="card form-card h-100">

            <div class="card-body">

                <h5 class="section-title">
                    Perhitungan
                </h5>

                <p class="section-subtitle">
                    Nilai dihitung otomatis berdasarkan data yang dimasukkan
                </p>


                <div class="result-box">

                    <div class="result-row">

                        <span>
                            Total Biaya Bahan
                        </span>

                        <strong id="totalBahan">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row">

                        <span>
                            Total Biaya Tambahan
                        </span>

                        <strong id="totalBiaya">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row">

                        <span>
                            Total Modal Produksi
                        </span>

                        <strong id="totalModal">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row result-final">

                        <span>
                            HPP / Produk
                        </span>

                        <strong
                            id="hpp"
                            class="text-warning"
                        >
                            Rp0
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KEUNTUNGAN --}}
    <div class="col-lg-5">

        <div class="profit-result h-100">

            <small>
                Perkiraan Keuntungan
            </small>


            <div
                class="profit-number mt-2"
                id="laba"
            >
                Rp0
            </div>


            <p class="mt-2 mb-4">
                Keuntungan setiap produk
            </p>


            <div class="d-flex justify-content-between">

                <span>
                    Harga Jual
                </span>

                <strong id="hasilHarga">
                    Rp0
                </strong>

            </div>


            <div class="d-flex justify-content-between mt-2">

                <span>
                    HPP
                </span>

                <strong id="hasilHpp">
                    Rp0
                </strong>

            </div>


            <hr>


            <div class="d-flex justify-content-between">

                <strong>
                    Margin
                </strong>

                <strong id="margin">
                    0%
                </strong>

            </div>

        </div>

    </div>

</div>


{{-- BUTTON --}}
<div class="d-flex justify-content-end gap-2 mb-5">

    <a
        href="/produk"
        class="btn btn-secondary"
    >
        Batal
    </a>


    <button
        type="submit"
        class="btn btn-warning px-4"
    >

        <i class="bi bi-check-circle"></i>

        Simpan Produk

    </button>

</div>


</form>

<script>

function rupiah(angka) {

    return new Intl.NumberFormat('id-ID', {

        style: 'currency',

        currency: 'IDR',

        maximumFractionDigits: 0

    }).format(angka);

}


/*
|--------------------------------------------------------------------------
| HITUNG SEMUA
|--------------------------------------------------------------------------
*/

function hitung() {

    let totalBahan = 0;
    let totalBiaya = 0;


    /*
    |--------------------------------------------------------------------------
    | HITUNG BAHAN
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.bahan-row')
        .forEach(function(row) {

            let dipakai =
                parseFloat(
                    row.querySelector('.bahan-dipakai')?.value
                ) || 0;


            let isi =
                parseFloat(
                    row.querySelector('.bahan-isi')?.value
                ) || 0;


            let harga =
                parseFloat(
                    row.querySelector('.bahan-harga')?.value
                ) || 0;


            let biaya = 0;


            if (isi > 0) {

                biaya =
                    (harga / isi) * dipakai;

            }


            totalBahan += biaya;


            let hasil =
                row.querySelector('.bahan-total');


            if (hasil) {

                hasil.innerText =
                    rupiah(biaya);

            }

        });


    /*
    |--------------------------------------------------------------------------
    | HITUNG BIAYA TAMBAHAN
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.biaya-row')
        .forEach(function(row) {

            let nama =
                row.querySelector('.biaya-nama')?.value
                .trim() || '';


            let jumlah =
                parseFloat(
                    row.querySelector('.biaya-jumlah')?.value
                ) || 0;


            let harga =
                parseFloat(
                    row.querySelector('.biaya-harga')?.value
                ) || 0;


            /*
            | Kalau nama kosong, biaya dianggap tidak digunakan.
            */

            if (nama !== '') {

                totalBiaya +=
                    jumlah * harga;

            }

        });


    /*
    |--------------------------------------------------------------------------
    | TOTAL MODAL
    |--------------------------------------------------------------------------
    */

    let totalModal =
        totalBahan + totalBiaya;


    /*
    |--------------------------------------------------------------------------
    | HPP
    |--------------------------------------------------------------------------
    |
    | Jumlah produksi sudah dihapus.
    |
    */

    let hpp =
        totalModal;


    /*
    |--------------------------------------------------------------------------
    | HARGA JUAL
    |--------------------------------------------------------------------------
    */

    let hargaJual =
        parseFloat(
            document.getElementById('hargaJual')?.value
        ) || 0;


    /*
    |--------------------------------------------------------------------------
    | LABA
    |--------------------------------------------------------------------------
    */

    let laba =
        hargaJual - hpp;


    /*
    |--------------------------------------------------------------------------
    | MARGIN
    |--------------------------------------------------------------------------
    */

    let margin = 0;


    if (hargaJual > 0) {

        margin =
            (laba / hargaJual) * 100;

    }


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN
    |--------------------------------------------------------------------------
    */

    document.getElementById('totalBahan').innerText =
        rupiah(totalBahan);


    document.getElementById('totalBiaya').innerText =
        rupiah(totalBiaya);


    document.getElementById('totalModal').innerText =
        rupiah(totalModal);


    document.getElementById('hpp').innerText =
        rupiah(hpp);


    document.getElementById('hasilHarga').innerText =
        rupiah(hargaJual);


    document.getElementById('hasilHpp').innerText =
        rupiah(hpp);


    document.getElementById('laba').innerText =
        rupiah(laba);


    document.getElementById('margin').innerText =
        margin.toFixed(1) + '%';

}


/*
|--------------------------------------------------------------------------
| TAMBAH BAHAN
|--------------------------------------------------------------------------
*/

function tambahBahan() {

    let container =
        document.getElementById('daftarBahan');


    let pertama =
        container.querySelector('.bahan-row');


    let row =
        pertama.cloneNode(true);


    row.querySelectorAll('input').forEach(function(input) {

        input.value = '';

    });


    row.querySelector('.bahan-total').innerText =
        'Rp0';


    container.appendChild(row);


    pasangEvent();

    hitung();

}


/*
|--------------------------------------------------------------------------
| HAPUS BAHAN
|--------------------------------------------------------------------------
*/

function hapusBahan(button) {

    let rows =
        document.querySelectorAll('.bahan-row');


    if (rows.length <= 1) {

        alert(
            'Minimal harus ada satu bahan.'
        );

        return;

    }


    button
        .closest('.bahan-row')
        .remove();


    hitung();

}


/*
|--------------------------------------------------------------------------
| TAMBAH BIAYA
|--------------------------------------------------------------------------
*/

function tambahBiaya() {

    let container =
        document.getElementById('daftarBiaya');


    let pertama =
        container.querySelector('.biaya-row');


    let row =
        pertama.cloneNode(true);


    row.querySelectorAll('input').forEach(function(input) {

        input.value = '';

    });


    container.appendChild(row);


    pasangEvent();

    hitung();

}


/*
|--------------------------------------------------------------------------
| HAPUS BIAYA
|--------------------------------------------------------------------------
*/

function hapusBiaya(button) {

    let rows =
        document.querySelectorAll('.biaya-row');


    if (rows.length <= 1) {

        /*
        | Kalau tinggal satu,
        | jangan dihapus.
        | Cukup kosongkan saja.
        */

        let row =
            button.closest('.biaya-row');


        row.querySelectorAll('input').forEach(function(input) {

            input.value = '';

        });


        hitung();

        return;

    }


    button
        .closest('.biaya-row')
        .remove();


    hitung();

}


/*
|--------------------------------------------------------------------------
| EVENT INPUT
|--------------------------------------------------------------------------
*/

function pasangEvent() {

    document
        .querySelectorAll('input')
        .forEach(function(input) {

            input.removeEventListener(
                'input',
                hitung
            );

            input.addEventListener(
                'input',
                hitung
            );

        });

}


/*
|--------------------------------------------------------------------------
| JALANKAN
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function() {

        pasangEvent();

        hitung();

    }
);

</script>

@endsection
