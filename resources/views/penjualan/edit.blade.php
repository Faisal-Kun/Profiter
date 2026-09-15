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

    .form-control:focus,
    .form-select:focus {
        background: #111822;
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59,130,246,.10);
    }

    .form-control::placeholder {
        color: #657286;
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
       SUMMARY
    ========================= */

    .summary-box {
        background: #111822;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        height: 100%;
    }

    .summary-box small {
        color: var(--muted);
    }

    .summary-box h5 {
        color: var(--text);
        font-weight: 700;
    }

    /* =========================
       TOTAL
    ========================= */

    .total-box {
        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.20);
        border-radius: 14px;
        padding: 20px;
        height: 100%;
    }

    .total-box small {
        color: var(--muted);
    }

    .total-value {
        color: var(--primary);
        font-size: 30px;
        font-weight: 700;
    }

    /* =========================
       PROFIT
    ========================= */

    .profit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;
    }

    .profit-row {
        color: var(--muted);
    }

    .profit-row strong {
        color: var(--text);
    }

    .profit-value {
        color: var(--success) !important;
    }

    .profit-card hr {
        border-color: var(--border);
        opacity: 1;
    }

    /* =========================
       BUTTON
    ========================= */

    .btn-save {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
        transition: all .2s ease;
    }

    .btn-save:hover {
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
       ALERT
    ========================= */

    .alert-danger {
        background: rgba(248,113,113,.08);
        border: 1px solid rgba(248,113,113,.25);
        color: #ff8585;
        border-radius: 10px;
    }

    .alert-success {
        background: rgba(94,231,160,.08);
        border: 1px solid rgba(94,231,160,.25);
        color: var(--success);
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

        .total-value {
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
                Edit Penjualan
            </h3>

            <p class="page-subtitle mb-0">
                Ubah informasi transaksi penjualan
            </p>

        </div>

        <a
            href="/penjualan/detail/{{ $penjualan->id }}"
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


    {{-- =========================
         SUCCESS
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success mb-4">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    <form
        action="/penjualan/{{ $penjualan->id }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- =========================
             INFORMASI
        ========================= --}}

        <div class="card form-card mb-4">

            <div class="card-body">

                <h5 class="section-title">
                    Informasi Penjualan
                </h5>

                <p class="section-subtitle">
                    Perbarui informasi transaksi
                </p>


                <div class="row g-3">

                    {{-- TANGGAL --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ old('tanggal', $penjualan->tanggal) }}"
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
                            id="produk"
                            class="form-select"
                            onchange="hitung()"
                            required
                        >

                            <option
                                value=""
                                disabled
                            >
                                Pilih Produk
                            </option>

                            @foreach($produks as $produk)

                                <option
                                    value="{{ $produk->id }}"
                                    data-harga="{{ $produk->harga_jual }}"
                                    data-hpp="{{ $produk->hpp }}"
                                    {{ old('produk_id', $penjualan->produk_id) == $produk->id ? 'selected' : '' }}
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
                                id="jumlah"
                                class="form-control"
                                value="{{ old('jumlah_terjual', $penjualan->jumlah_terjual) }}"
                                min="1"
                                oninput="hitung()"
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
                        >{{ old('catatan', $penjualan->catatan) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             PERHITUNGAN
        ========================= --}}

        <div class="card form-card mb-4">

            <div class="card-body">

                <h5 class="section-title">
                    Perhitungan
                </h5>

                <p class="section-subtitle">
                    Nilai akan berubah otomatis berdasarkan produk dan jumlah
                </p>


                <div class="row g-3">

                    {{-- HARGA --}}

                    <div class="col-md-4">

                        <div class="summary-box">

                            <small>
                                Harga / Produk
                            </small>

                            <h5
                                id="harga"
                                class="mt-2 mb-0"
                            >
                                Rp0
                            </h5>

                        </div>

                    </div>


                    {{-- HPP --}}

                    <div class="col-md-4">

                        <div class="summary-box">

                            <small>
                                HPP / Produk
                            </small>

                            <h5
                                id="hpp"
                                class="mt-2 mb-0"
                            >
                                Rp0
                            </h5>

                        </div>

                    </div>


                    {{-- TOTAL --}}

                    <div class="col-md-4">

                        <div class="total-box">

                            <small>
                                Total Penjualan
                            </small>

                            <div
                                id="total"
                                class="total-value mt-2"
                            >
                                Rp0
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             LABA
        ========================= --}}

        <div class="card profit-card mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between profit-row">

                    <span>
                        Total HPP
                    </span>

                    <strong id="modal">
                        Rp0
                    </strong>

                </div>


                <div class="d-flex justify-content-between mt-3 profit-row">

                    <span>
                        Total Penjualan
                    </span>

                    <strong id="hasilPenjualan">
                        Rp0
                    </strong>

                </div>


                <hr>


                <div class="d-flex justify-content-between">

                    <strong>
                        Perkiraan Laba
                    </strong>

                    <strong
                        id="laba"
                        class="profit-value"
                    >
                        Rp0
                    </strong>

                </div>

            </div>

        </div>


        {{-- =========================
             BUTTON
        ========================= --}}

        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="/penjualan/detail/{{ $penjualan->id }}"
                class="btn btn-back"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-save px-4"
            >
                <i class="bi bi-check-circle me-1"></i>
                Simpan Perubahan
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
        document.getElementById('produk');

    const option =
        select.options[select.selectedIndex];

    if (!option || !option.value) {
        return;
    }


    const harga =
        parseFloat(option.dataset.harga) || 0;

    const hpp =
        parseFloat(option.dataset.hpp) || 0;

    const jumlah =
        parseFloat(
            document.getElementById('jumlah').value
        ) || 0;


    const total =
        harga * jumlah;

    const modal =
        hpp * jumlah;

    const laba =
        total - modal;


    document
        .getElementById('harga')
        .innerText = rupiah(harga);

    document
        .getElementById('hpp')
        .innerText = rupiah(hpp);

    document
        .getElementById('total')
        .innerText = rupiah(total);

    document
        .getElementById('modal')
        .innerText = rupiah(modal);

    document
        .getElementById('hasilPenjualan')
        .innerText = rupiah(total);

    document
        .getElementById('laba')
        .innerText = rupiah(laba);
}


document.addEventListener(
    'DOMContentLoaded',
    function () {
        hitung();
    }
);

</script>

@endsection