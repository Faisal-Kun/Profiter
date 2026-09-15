@extends('layouts.app')

@section('content')

<style>
    :root {
        --card: #151b24;
        --card-hover: #1a2230;
        --border: #273342;

        --primary: #3b82f6;
        --primary-hover: #60a5fa;
        --primary-soft: rgba(59,130,246,.10);

        --text: #f5f7fa;
        --muted: #8995a8;

        --success: #5ee7a0;
        --danger: #f87171;
    }

    /* =========================
       PAGE
    ========================= */

    .sales-form-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .page-subtitle {
        color: var(--muted);
        font-size: 14px;
    }

    /* =========================
       CARD
    ========================= */

    .form-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 24px;
    }

    .section-title {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .section-subtitle {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* =========================
       LABEL
    ========================= */

    .form-label {
        color: #b8c1ce;
        font-size: 13px;
        font-weight: 600;
    }

    /* =========================
       INPUT
    ========================= */

    .form-control,
    .form-select {
        background: #111822;
        border: 1px solid #354154;
        color: #fff;
        border-radius: 10px;
        padding: 11px 13px;
    }

    .form-control::placeholder {
        color: #657286;
    }

    .form-control:focus,
    .form-select:focus {
        background: #111822;
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59,130,246,.10);
    }

    .form-select option {
        background: #151b24;
        color: #fff;
    }

    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {
        background: #1a2230;
        border: 1px solid #354154;
        color: #8995a8;
        font-weight: 600;
    }

    /* =========================
       RESULT
    ========================= */

    .result-box {
        background: #111822;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
    }

    .result-row {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 11px 0;

        color: var(--muted);
    }

    .result-row strong {
        color: var(--text);
    }

    .result-final {
        border-top: 1px solid var(--border);
        margin-top: 10px;
        padding-top: 16px;

        font-size: 18px;
        font-weight: 700;
    }

    /* =========================
       PROFIT
    ========================= */

    .profit-result {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;

        padding: 24px;

        position: relative;
        overflow: hidden;
    }

    .profit-result::before {
        content: "";

        position: absolute;

        left: 0;
        top: 0;
        bottom: 0;

        width: 4px;

        background: var(--primary);
    }

    .profit-result small {
        color: var(--muted);
    }

    .profit-number {
        color: var(--primary);
        font-size: 30px;
        font-weight: 700;
    }

    .profit-result p {
        color: var(--muted);
    }

    .profit-result hr {
        border-color: var(--border);
        opacity: 1;
    }

    /* =========================
       BUTTON
    ========================= */

    .btn-primary-custom {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-primary-custom:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-back {
        background: var(--card);
        border: 1px solid #354154;
        color: var(--muted);
        font-weight: 500;
        border-radius: 10px;
    }

    .btn-back:hover {
        background: var(--card-hover);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* =========================
       ERROR
    ========================= */

    .alert-danger {
        background: rgba(248,113,113,.08);
        border: 1px solid rgba(248,113,113,.25);
        color: #ff8585;
        border-radius: 10px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .page-title {
            font-size: 24px;
        }

        .form-card .card-body {
            padding: 18px;
        }

        .profit-number {
            font-size: 26px;
        }
    }
</style>


<div class="sales-form-page">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="page-title">
                Tambah Penjualan
            </h3>

            <p class="page-subtitle mb-0">
                Tambahkan data penjualan produk
            </p>

        </div>

        <a
            href="/penjualan"
            class="btn btn-back"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>

    </div>


    {{-- =========================
         ERROR
    ========================= --}}

    @if ($errors->any())

        <div class="alert alert-danger mb-4">

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


    <form
        action="/penjualan"
        method="POST"
    >

        @csrf


        {{-- =========================
             INFORMASI PENJUALAN
        ========================= --}}

        <div class="card form-card mb-4">

            <div class="card-body">

                <h5 class="section-title">
                    Informasi Penjualan
                </h5>

                <p class="section-subtitle">
                    Masukkan informasi produk yang terjual
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
                                    data-stok="{{ $produk->jumlah_produksi }}"
                                >
                                    {{ $produk->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- JUMLAH --}}

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
                            rows="4"
                            placeholder=""
                        >{{ old('catatan') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             INFORMASI PRODUK
        ========================= --}}

        <div
            class="card form-card mb-4"
            id="informasiProduk"
            style="display:none;"
        >

            <div class="card-body">

                <h5 class="section-title">
                    Informasi Produk
                </h5>

                <p class="section-subtitle">
                    Informasi harga, HPP, dan stok produk
                </p>


                <div class="result-box">

                    <div class="result-row">

                        <span>
                            Harga Jual / Produk
                        </span>

                        <strong id="hargaJual">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row">

                        <span>
                            HPP / Produk
                        </span>

                        <strong id="hppProduk">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row">

                        <span>
                            Stok Tersedia
                        </span>

                        <strong
                            id="stokProduk"
                            style="color:#60a5fa;"
                        >
                            0 produk
                        </strong>

                    </div>


                    <div class="result-row">

                        <span>
                            Total Penjualan
                        </span>

                        <strong id="totalPenjualan">
                            Rp0
                        </strong>

                    </div>


                    <div class="result-row result-final">

                        <span>
                            Estimasi Keuntungan
                        </span>

                        <strong
                            id="keuntungan"
                            style="color:#5ee7a0;"
                        >
                            Rp0
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             RINGKASAN
        ========================= --}}

        <div
            class="profit-result mb-4"
            id="profitBox"
            style="display:none;"
        >

            <small>
                Ringkasan Penjualan
            </small>


            <div
                class="profit-number mt-2"
                id="profitNumber"
            >
                Rp0
            </div>


            <p class="mt-2 mb-4">
                Estimasi keuntungan dari transaksi ini
            </p>


            <div class="d-flex justify-content-between">

                <span>
                    Total Penjualan
                </span>

                <strong id="hasilPenjualan">
                    Rp0
                </strong>

            </div>


            <div class="d-flex justify-content-between mt-2">

                <span>
                    Total HPP
                </span>

                <strong id="hasilHpp">
                    Rp0
                </strong>

            </div>


            <hr>


            <div class="d-flex justify-content-between">

                <strong>
                    Keuntungan
                </strong>

                <strong
                    id="hasilKeuntungan"
                    style="color:#5ee7a0;"
                >
                    Rp0
                </strong>

            </div>

        </div>


        {{-- =========================
             BUTTON
        ========================= --}}

        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="/penjualan"
                class="btn btn-back"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary-custom px-4"
            >
                <i class="bi bi-check-circle me-1"></i>
                Simpan Penjualan
            </button>

        </div>

    </form>

</div>


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


function hitung()
{
    const select =
        document.getElementById('produkSelect');

    const option =
        select.options[select.selectedIndex];

    if (!option || !option.value) {

        document
            .getElementById('informasiProduk')
            .style.display = 'none';

        document
            .getElementById('profitBox')
            .style.display = 'none';

        return;
    }


    const harga =
        parseFloat(option.dataset.harga) || 0;

    const hpp =
        parseFloat(option.dataset.hpp) || 0;

    const stok =
        parseInt(option.dataset.stok) || 0;

    const jumlah =
        parseInt(
            document
                .getElementById('jumlahTerjual')
                .value
        ) || 0;


    const total =
        harga * jumlah;

    const totalHpp =
        hpp * jumlah;

    const keuntungan =
        total - totalHpp;


    document
        .getElementById('hargaJual')
        .innerText = rupiah(harga);

    document
        .getElementById('hppProduk')
        .innerText = rupiah(hpp);

    document
        .getElementById('stokProduk')
        .innerText = stok + ' produk';

    document
        .getElementById('totalPenjualan')
        .innerText = rupiah(total);

    document
        .getElementById('keuntungan')
        .innerText = rupiah(keuntungan);

    document
        .getElementById('hasilPenjualan')
        .innerText = rupiah(total);

    document
        .getElementById('hasilHpp')
        .innerText = rupiah(totalHpp);

    document
        .getElementById('hasilKeuntungan')
        .innerText = rupiah(keuntungan);

    document
        .getElementById('profitNumber')
        .innerText = rupiah(keuntungan);


    document
        .getElementById('informasiProduk')
        .style.display = 'block';

    document
        .getElementById('profitBox')
        .style.display = 'block';
}


document
    .getElementById('produkSelect')
    .addEventListener('change', hitung);


document
    .getElementById('jumlahTerjual')
    .addEventListener('input', hitung);


document.addEventListener(
    'DOMContentLoaded',
    function() {
        hitung();
    }
);

</script>

@endsection