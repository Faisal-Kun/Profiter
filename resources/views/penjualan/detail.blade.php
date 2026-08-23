@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

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
       HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-weight: 700;
        font-size: 28px;
    }

    .page-subtitle {
        color: var(--muted);
        font-size: 14px;
    }


    /* =========================
       CARD
    ========================= */

    .detail-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }


    /* =========================
       PRODUCT ICON
    ========================= */

    .product-icon {
        width: 80px;
        height: 80px;
        border-radius: 18px;

        background: var(--primary-soft);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 35px;

        color: var(--primary);
    }


    /* =========================
       TEXT
    ========================= */

    .product-title {
        color: var(--text);
        font-weight: 700;
    }

    .transaction-id {
        color: var(--muted);
    }


    /* =========================
       INFO
    ========================= */

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 20px;

        padding: 14px 0;

        border-bottom: 1px solid var(--border);

        color: var(--text);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--muted);
    }

    .info-value {
        color: var(--text);
    }


    /* =========================
       TOTAL BOX
    ========================= */

    .total-box {
        background: var(--primary-soft);

        border: 1px solid var(--border);

        border-radius: 14px;

        padding: 22px;

        color: var(--text);
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
       PROFIT BOX
    ========================= */

    .profit-box {
        background: var(--card);

        border: 1px solid var(--border);

        color: var(--text);

        border-radius: 16px;

        padding: 25px;

        position: relative;

        overflow: hidden;
    }

    .profit-box::before {
        content: "";

        position: absolute;

        left: 0;
        top: 0;
        bottom: 0;

        width: 4px;

        background: var(--primary);
    }

    .profit-box small {
        color: var(--muted);
    }

    .profit-value {
        color: var(--primary);

        font-size: 30px;

        font-weight: 700;
    }

    .profit-box p {
        color: var(--muted);
    }

    .profit-box hr {
        border-color: var(--border);
    }


    /* =========================
       BUTTON PRIMARY
    ========================= */

    .btn-warning {
        background: var(--primary);

        border: 1px solid var(--primary);

        color: #fff;

        font-weight: 600;

        border-radius: 10px;

        transition: all .2s ease;
    }

    .btn-warning:hover {
        background: var(--primary-hover);

        border-color: var(--primary-hover);

        color: #fff;

        transform: translateY(-1px);
    }


    /* =========================
       BUTTON SECONDARY
    ========================= */

    .btn-secondary {
        background: var(--card);

        border: 1px solid #353f4d;

        color: var(--muted);

        font-weight: 500;

        border-radius: 10px;

        transition: all .2s ease;
    }

    .btn-secondary:hover {
        background: var(--card-hover);

        border-color: var(--primary);

        color: var(--primary);
    }


    /* =========================
       DELETE BUTTON
    ========================= */

    .btn-outline-danger {
        border-color: #353f4d;

        color: var(--muted);

        border-radius: 10px;

        transition: all .2s ease;
    }

    .btn-outline-danger:hover {
        background: rgba(248,113,113,.10);

        border-color: var(--danger);

        color: var(--danger);
    }


    /* =========================
       ALERT
    ========================= */

    .alert-success {
        background: rgba(94,231,160,.10);

        border: 1px solid rgba(94,231,160,.25);

        color: var(--success);
    }


    /* =========================
       MOBILE
    ========================= */

    @media(max-width: 768px) {

        .page-title {
            font-size: 24px;
        }

        .info-row {
            padding: 13px 0;
        }

        .product-icon {
            width: 65px;
            height: 65px;
            font-size: 28px;
        }

        .total-value,
        .profit-value {
            font-size: 26px;
        }

    }

</style>


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="page-title mb-1">
            Detail Penjualan
        </h3>

        <p class="page-subtitle mb-0">
            Informasi lengkap transaksi penjualan
        </p>

    </div>


    <a
        href="/penjualan"
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>



{{-- =========================
NOTIFIKASI
========================= --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-1"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif



{{-- =========================
ISI DETAIL
========================= --}}

<div class="row g-4">


    {{-- =========================
    INFORMASI TRANSAKSI
    ========================= --}}

    <div class="col-lg-7">

        <div class="card detail-card h-100">

            <div class="card-body">


                <div class="d-flex align-items-center gap-3 mb-4">


                    <div class="product-icon">

                        <i class="bi bi-cart-check"></i>

                    </div>


                    <div>

                        <h4 class="product-title mb-1">

                            {{ $penjualan->produk->nama ?? 'Produk tidak ditemukan' }}

                        </h4>


                        <small class="transaction-id">

                            Transaksi #PJ{{ str_pad(
                                $penjualan->id,
                                3,
                                '0',
                                STR_PAD_LEFT
                            ) }}

                        </small>

                    </div>

                </div>



                {{-- TANGGAL --}}

                <div class="info-row">

                    <span class="info-label">
                        Tanggal
                    </span>

                    <strong class="info-value">

                        {{ \Carbon\Carbon::parse(
                            $penjualan->tanggal
                        )->translatedFormat('d F Y') }}

                    </strong>

                </div>



                {{-- PRODUK --}}

                <div class="info-row">

                    <span class="info-label">
                        Produk
                    </span>

                    <strong class="info-value">

                        {{ $penjualan->produk->nama ?? '-' }}

                    </strong>

                </div>



                {{-- JUMLAH --}}

                <div class="info-row">

                    <span class="info-label">
                        Jumlah Terjual
                    </span>

                    <strong class="info-value">

                        {{ number_format(
                            $penjualan->jumlah_terjual,
                            0,
                            ',',
                            '.'
                        ) }}

                        produk

                    </strong>

                </div>



                {{-- HARGA --}}

                <div class="info-row">

                    <span class="info-label">
                        Harga / Produk
                    </span>

                    <strong class="info-value">

                        Rp{{ number_format(
                            $penjualan->harga_jual,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>



                {{-- CATATAN --}}

                <div class="info-row">

                    <span class="info-label">
                        Catatan
                    </span>

                    <span class="info-value">

                        {{ $penjualan->catatan ?: '-' }}

                    </span>

                </div>


            </div>

        </div>

    </div>



    {{-- =========================
    RINGKASAN
    ========================= --}}

    <div class="col-lg-5">


        <div class="card detail-card mb-4">

            <div class="card-body">


                <h5
                    class="product-title mb-4"
                >
                    Ringkasan
                </h5>



                {{-- HARGA JUAL --}}

                <div class="info-row">

                    <span class="info-label">
                        Harga Jual
                    </span>

                    <strong>

                        Rp{{ number_format(
                            $penjualan->harga_jual,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>



                {{-- JUMLAH --}}

                <div class="info-row">

                    <span class="info-label">
                        Jumlah
                    </span>

                    <strong>

                        {{ number_format(
                            $penjualan->jumlah_terjual,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>



                {{-- TOTAL --}}

                <div class="total-box mt-4">

                    <small>
                        Total Penjualan
                    </small>


                    <div class="total-value mt-2">

                        Rp{{ number_format(
                            $penjualan->total_penjualan,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


            </div>

        </div>



        {{-- =========================
        KEUNTUNGAN
        ========================= --}}

        <div class="profit-box">


            <small>
                Perkiraan Keuntungan
            </small>


            <div class="profit-value mt-2">

                Rp{{ number_format(
                    $penjualan->keuntungan,
                    0,
                    ',',
                    '.'
                ) }}

            </div>


            <p class="mb-4 mt-2">

                Keuntungan dari transaksi ini

            </p>



            <div class="d-flex justify-content-between">

                <span>
                    Total Penjualan
                </span>

                <strong>

                    Rp{{ number_format(
                        $penjualan->total_penjualan,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>



            <div class="d-flex justify-content-between mt-2">

                <span>
                    Total HPP
                </span>

                <strong>

                    Rp{{ number_format(
                        $penjualan->hpp,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>



            <hr>



            <div class="d-flex justify-content-between">

                <strong>
                    Laba
                </strong>

                <strong class="text-primary">

                    Rp{{ number_format(
                        $penjualan->keuntungan,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>


        </div>

    </div>

</div>



{{-- =========================
ACTION
========================= --}}

<div class="d-flex justify-content-end gap-2 mt-4 mb-5">


    {{-- EDIT --}}

    <a
        href="{{ url('/penjualan/edit/' . $penjualan->id) }}"
        class="btn btn-warning"
    >

        <i class="bi bi-pencil me-1"></i>

        Edit Penjualan

    </a>



    {{-- HAPUS --}}

    <form
        action="{{ url('/penjualan/' . $penjualan->id) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
    >

        @csrf

        @method('DELETE')


        <button
            type="submit"
            class="btn btn-outline-danger"
        >

            <i class="bi bi-trash me-1"></i>

            Hapus

        </button>

    </form>


</div>

@endsection