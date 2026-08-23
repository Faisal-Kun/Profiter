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
        --warning: #fbbf24;
    }


    /* =========================
       HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 5px;
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
       PRODUCT IMAGE
    ========================= */

    .product-detail-image {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 16px 16px 0 0;
    }


    /* =========================
       PRODUCT NAME
    ========================= */

    .product-name-title {
        color: var(--text);
        font-weight: 700;
    }

    .product-category {
        color: var(--muted);
        font-size: 14px;
    }


    /* =========================
       INFO
    ========================= */

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 15px 0;

        border-bottom: 1px solid var(--border);

        gap: 20px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--muted);
        font-size: 14px;
    }

    .info-value {
        color: var(--text);
        font-weight: 600;
        text-align: right;
    }


    /* =========================
       SUMMARY
    ========================= */

    .summary-box {
        background: #1a2230;
        border: 1px solid #293647;
        border-radius: 12px;
        padding: 18px;
        height: 100%;
    }

    .summary-label {
        color: var(--muted);
        font-size: 13px;
    }

    .summary-value {
        color: var(--text);
        font-size: 22px;
        font-weight: 700;
        margin-top: 5px;
    }


    /* =========================
       STATUS
    ========================= */

    .progress {
        background: #1a2230;
    }

    .progress-bar {
        background: var(--primary) !important;
    }


    /* =========================
       PROFIT
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

        background: var(--success);
    }

    .profit-label {
        color: var(--muted);
        font-size: 13px;
    }

    .profit-value {
        color: var(--success);
        font-size: 30px;
        font-weight: 700;
    }

    .profit-description {
        color: var(--muted);
        font-size: 14px;
    }

    .profit-row {
        color: var(--muted);
    }

    .profit-row strong {
        color: var(--text);
    }

    .profit-box hr {
        border-color: var(--border);
    }


    /* =========================
       BADGE
    ========================= */

    .production-badge {
        display: inline-block;

        background: rgba(94,231,160,.10);
        border: 1px solid rgba(94,231,160,.20);

        color: var(--success);

        padding: 6px 11px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-edit {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
    }

    .btn-edit:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-1px);
    }


    .btn-back {
        background: var(--card);
        border: 1px solid #354154;
        color: var(--muted);
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-back:hover {
        background: var(--card-hover);
        border-color: var(--primary);
        color: var(--primary-hover);
    }


    .btn-delete {
        border-color: #354154;
        color: var(--muted);
        border-radius: 10px;
    }

    .btn-delete:hover {
        background: rgba(248,113,113,.10);
        border-color: var(--danger);
        color: var(--danger);
    }


    /* =========================
       ALERT
    ========================= */

    .production-alert {
        background: rgba(94,231,160,.08);
        border: 1px solid rgba(94,231,160,.20);
        color: var(--success);
        border-radius: 12px;
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .page-title {
            font-size: 24px;
        }

        .product-detail-image {
            height: 280px;
        }

        .info-row {
            padding: 13px 0;
        }

        .info-label,
        .info-value {
            font-size: 13px;
        }

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

        <h3 class="page-title">
            Detail Produksi
        </h3>

        <p class="page-subtitle mb-0">
            Informasi lengkap produksi
        </p>

    </div>


    <a
        href="/produksi"
        class="btn btn-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>



{{-- =========================
NOTIFIKASI
========================= --}}

@if(session('success'))

    <div class="alert production-alert alert-dismissible fade show mb-4">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif



{{-- =========================
INFORMASI UTAMA
========================= --}}

<div class="row g-4 mb-4">


    {{-- =========================
    PRODUK
    ========================= --}}

    <div class="col-lg-5">

        <div class="detail-card h-100">

            <img
                src="{{ $produksi->produk?->gambar
                    ? asset('storage/' . $produksi->produk->gambar)
                    : 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?w=800'
                }}"
                class="product-detail-image"
                alt="{{ $produksi->produk?->nama ?? 'Produk' }}"
            >


            <div class="p-4">

                <h4 class="product-name-title mb-1">

                    {{ $produksi->produk->nama ?? '-' }}

                </h4>


                <p class="product-category mb-3">

                    {{ $produksi->produk->kategori ?? '-' }}

                </p>


                <span class="production-badge">

                    <i class="bi bi-check-circle me-1"></i>

                    Produksi Tercatat

                </span>

            </div>

        </div>

    </div>



    {{-- =========================
    DETAIL PRODUKSI
    ========================= --}}

    <div class="col-lg-7">

        <div class="detail-card h-100">

            <div class="p-4">

                <h5 class="product-name-title mb-3">

                    Informasi Produksi

                </h5>


                {{-- TANGGAL --}}

                <div class="info-row">

                    <span class="info-label">
                        Tanggal Produksi
                    </span>

                    <span class="info-value">

                        {{ \Carbon\Carbon::parse(
                            $produksi->tanggal
                        )->translatedFormat('d F Y') }}

                    </span>

                </div>


                {{-- PRODUK --}}

                <div class="info-row">

                    <span class="info-label">
                        Nama Produk
                    </span>

                    <span class="info-value">

                        {{ $produksi->produk->nama ?? '-' }}

                    </span>

                </div>


                {{-- JUMLAH --}}

                <div class="info-row">

                    <span class="info-label">
                        Jumlah Produksi
                    </span>

                    <span class="info-value">

                        {{ $produksi->jumlah_produksi }} produk

                    </span>

                </div>


                {{-- HARGA --}}

                <div class="info-row">

                    <span class="info-label">
                        Harga Jual
                    </span>

                    <span
                        class="info-value"
                        style="color:#60a5fa;"
                    >

                        Rp{{ number_format(
                            $produksi->produk->harga_jual ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- CATATAN --}}

                <div class="info-row">

                    <span class="info-label">
                        Catatan
                    </span>

                    <span class="info-value">

                        {{ $produksi->catatan ?: '-' }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================
RINGKASAN PRODUK
========================= --}}

<div class="detail-card mb-4">

    <div class="p-4">

        <h5 class="product-name-title mb-4">

            Ringkasan Produksi

        </h5>


        <div class="row g-3">


            {{-- HPP --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-label">
                        HPP / Produk
                    </div>

                    <div class="summary-value">

                        Rp{{ number_format(
                            $produksi->produk->hpp ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

            </div>


            {{-- MODAL --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-label">
                        Modal Produksi
                    </div>

                    <div class="summary-value">

                        Rp{{ number_format(
                            ($produksi->produk->hpp ?? 0)
                            * $produksi->jumlah_produksi,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

            </div>


            {{-- HARGA JUAL --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-label">
                        Harga Jual / Produk
                    </div>

                    <div class="summary-value">

                        Rp{{ number_format(
                            $produksi->produk->harga_jual ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>



{{-- =========================
STATUS PRODUKSI
========================= --}}

<div class="row g-4 mb-5">


    <div class="col-lg-7">

        <div class="detail-card h-100">

            <div class="p-4">

                <h5 class="product-name-title mb-4">

                    Status Produksi

                </h5>


                <div class="d-flex justify-content-between mb-2">

                    <span class="page-subtitle">
                        Jumlah Produksi
                    </span>

                    <strong style="color:var(--text);">

                        {{ $produksi->jumlah_produksi }}

                    </strong>

                </div>


                <div
                    class="progress mb-4"
                    style="height:10px;"
                >

                    <div
                        class="progress-bar"
                        style="width:100%;"
                    ></div>

                </div>


                <div class="d-flex justify-content-between">

                    <span class="page-subtitle">
                        Produk
                    </span>

                    <strong style="color:var(--text);">

                        {{ $produksi->produk->nama ?? '-' }}

                    </strong>

                </div>


                <div class="d-flex justify-content-between mt-2">

                    <span class="page-subtitle">
                        Jumlah
                    </span>

                    <strong style="color:var(--success);">

                        {{ $produksi->jumlah_produksi }} produk

                    </strong>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================
    PERKIRAAN KEUNTUNGAN
    ========================= --}}

    <div class="col-lg-5">

        @php

            $jumlah = $produksi->jumlah_produksi;

            $hargaJual =
                $produksi->produk->harga_jual ?? 0;

            $hpp =
                $produksi->produk->hpp ?? 0;

            $penjualan =
                $hargaJual * $jumlah;

            $modal =
                $hpp * $jumlah;

            $keuntungan =
                $penjualan - $modal;

            $margin =
                $penjualan > 0
                    ? ($keuntungan / $penjualan) * 100
                    : 0;

        @endphp


        <div class="profit-box h-100">

            <div class="profit-label">
                Perkiraan Keuntungan
            </div>


            <div class="profit-value mt-2">

                Rp{{ number_format(
                    $keuntungan,
                    0,
                    ',',
                    '.'
                ) }}

            </div>


            <p class="profit-description mb-4 mt-2">

                Perkiraan keuntungan berdasarkan
                jumlah produksi.

            </p>


            <div class="d-flex justify-content-between profit-row">

                <span>
                    Penjualan
                </span>

                <strong>

                    Rp{{ number_format(
                        $penjualan,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>


            <div class="d-flex justify-content-between mt-2 profit-row">

                <span>
                    Modal
                </span>

                <strong>

                    Rp{{ number_format(
                        $modal,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>


            <hr>


            <div class="d-flex justify-content-between">

                <strong>
                    Margin
                </strong>

                <strong style="color:var(--success);">

                    {{ number_format(
                        $margin,
                        1,
                        ',',
                        '.'
                    ) }}%

                </strong>

            </div>

        </div>

    </div>

</div>



{{-- =========================
ACTION
========================= --}}

<div class="d-flex justify-content-end gap-2 mb-5">

    <a
        href="/produksi/edit/{{ $produksi->id }}"
        class="btn btn-edit"
    >

        <i class="bi bi-pencil me-1"></i>

        Edit

    </a>


    <form
        action="/produksi/{{ $produksi->id }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus data produksi ini?')"
    >

        @csrf

        @method('DELETE')

        <button
            type="submit"
            class="btn btn-delete"
        >

            <i class="bi bi-trash me-1"></i>

            Hapus Produksi

        </button>

    </form>


    <a
        href="/produksi"
        class="btn btn-back"
    >

        Kembali

    </a>

</div>


@endsection