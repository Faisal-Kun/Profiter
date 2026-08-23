@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

    :root {
        --bg-main: #0d1117;
        --card: #17191f;
        --card-hover: #1d2028;
        --border: #272a33;

        --primary: #22d3ee;
        --primary-hover: #67e8f9;
        --primary-soft: rgba(34,211,238,.10);

        --text: #ffffff;
        --muted: #858994;

        --success: #5ee7a0;
        --danger: #ff5c5c;
    }


    /* =========================
       HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 5px;
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
        border-radius: 16px;
        overflow: hidden;
        box-shadow: none !important;
    }


    /* =========================
       SECTION
    ========================= */

    .section-title {
        color: var(--text);
        font-weight: 600;
        margin-bottom: 5px;
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
        color: #b8bdc8;
        font-size: 14px;
        font-weight: 500;
    }


    /* =========================
       INPUT
    ========================= */

    .form-control,
    .form-select {
        background: #12151b;
        border: 1px solid #353945;
        color: #fff;
        border-radius: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #12151b;
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 0 0 .2rem rgba(34,211,238,.10);
    }

    .form-control::placeholder {
        color: #626875;
    }

    .form-select option {
        background: #17191f;
        color: #fff;
    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {
        background: #22252d;
        border: 1px solid #353945;
        color: #b8bdc8;
    }


    /* =========================
       SUMMARY
    ========================= */

    .summary-box {
        background: #12151b;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        height: 100%;
    }

    .summary-box small {
        color: var(--muted) !important;
    }

    .summary-box h5 {
        color: #fff;
        font-weight: 700;
    }


    /* =========================
       TOTAL
    ========================= */

    .total-box {
        background: var(--primary-soft);
        border: 1px solid rgba(34,211,238,.20);
        border-radius: 14px;
        padding: 22px;
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
       LABA
    ========================= */

    .profit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
    }

    .profit-row {
        color: #b8bdc8;
    }

    .profit-row strong {
        color: #fff;
    }

    .profit-value {
        color: var(--success) !important;
    }

    .profit-card hr {
        border-color: var(--border);
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-edit {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #061014;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-edit:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #061014;
        transform: translateY(-1px);
    }

    .btn-back {
        background: var(--card);
        border: 1px solid #353945;
        color: #b8bdc8;
        font-weight: 500;
        border-radius: 10px;
    }

    .btn-back:hover {
        background: #22252d;
        border-color: var(--primary);
        color: var(--primary);
    }


    /* =========================
       ALERT
    ========================= */

    .alert-danger {
        background: rgba(255,92,92,.08);
        border: 1px solid rgba(255,92,92,.25);
        color: #ff8585;
    }

    .alert-success {
        background: rgba(94,231,160,.08);
        border: 1px solid rgba(94,231,160,.25);
        color: var(--success);
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .page-title {
            font-size: 24px;
        }

        .total-value {
            font-size: 26px;
        }

    }

</style>


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
ERROR VALIDASI
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

        <div class="card-body p-4">

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

                        <option value="" disabled>
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
                        placeholder="Contoh: Penjualan hari ini..."
                    >{{ old('catatan', $penjualan->catatan) }}</textarea>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
    HASIL PERHITUNGAN
    ========================= --}}

    <div class="card form-card mb-4">

        <div class="card-body p-4">

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
            class="btn btn-edit px-4"
        >

            <i class="bi bi-check-circle me-1"></i>

            Simpan Perubahan

        </button>

    </div>


</form>


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
        parseFloat(
            option.dataset.harga
        ) || 0;


    const hpp =
        parseFloat(
            option.dataset.hpp
        ) || 0;


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


    document.getElementById('harga').innerText =
        rupiah(harga);


    document.getElementById('hpp').innerText =
        rupiah(hpp);


    document.getElementById('total').innerText =
        rupiah(total);


    document.getElementById('modal').innerText =
        rupiah(modal);


    document.getElementById('hasilPenjualan').innerText =
        rupiah(total);


    document.getElementById('laba').innerText =
        rupiah(laba);

}


document.addEventListener(
    'DOMContentLoaded',
    function () {

        hitung();

    }
);

</script>

@endsection