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
       HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 4px;
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
       PRODUCT
    ========================= */

    .product-image {

        width: 100%;

        height: 300px;

        object-fit: cover;

        display: block;
    }


    .product-placeholder {

        width: 100%;

        height: 300px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #111821;

        color: #455267;

        font-size: 60px;
    }


    .product-name {

        color: var(--text);

        font-weight: 700;

        font-size: 22px;
    }


    .product-category {

        color: var(--muted);

        font-size: 14px;
    }


    /* =========================
       STATUS BADGE
    ========================= */

    .status-badge {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        background: rgba(94,231,160,.09);

        border: 1px solid rgba(94,231,160,.18);

        color: var(--success);

        padding: 7px 12px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: 600;
    }


    /* =========================
       INFO
    ========================= */

    .section-title {

        color: var(--text);

        font-weight: 600;

        font-size: 17px;
    }


    .info-row {

        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 20px;

        padding: 15px 0;

        border-bottom: 1px solid var(--border);
    }

    .info-row:last-child {

        border-bottom: none;

        padding-bottom: 0;
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

        height: 100%;

        background: #111821;

        border: 1px solid var(--border);

        border-radius: 12px;

        padding: 18px;
    }

    .summary-icon {

        width: 38px;

        height: 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 10px;

        background: var(--primary-soft);

        color: var(--primary-hover);

        margin-bottom: 14px;
    }

    .summary-label {

        color: var(--muted);

        font-size: 13px;
    }

    .summary-value {

        color: var(--text);

        font-size: 22px;

        font-weight: 700;

        margin-top: 4px;
    }


    /* =========================
       PROFIT
    ========================= */

    .profit-box {

        background: #111821;

        border: 1px solid rgba(94,231,160,.18);

        border-radius: 14px;

        padding: 20px;

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

        font-size: 28px;

        font-weight: 700;

        margin-top: 5px;
    }

    .profit-description {

        color: var(--muted);

        font-size: 13px;
    }


    .profit-row {

        display: flex;

        justify-content: space-between;

        color: var(--muted);

        font-size: 14px;
    }

    .profit-row strong {

        color: var(--text);
    }


    .profit-box hr {

        border-color: var(--border);

        opacity: 1;
    }


    /* =========================
       NOTE
    ========================= */

    .note-box {

        background: #111821;

        border: 1px solid var(--border);

        border-radius: 12px;

        padding: 16px;

        color: #c9d0da;

        font-size: 14px;

        line-height: 1.6;
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

        transition: .2s ease;
    }

    .btn-primary-custom:hover {

        background: var(--primary-hover);

        border-color: var(--primary-hover);

        color: #fff;

        transform: translateY(-1px);
    }


    .btn-secondary-custom {

        background: var(--card);

        border: 1px solid #354154;

        color: var(--muted);

        font-weight: 500;

        border-radius: 10px;

        transition: .2s ease;
    }

    .btn-secondary-custom:hover {

        background: var(--card-hover);

        border-color: var(--primary);

        color: var(--primary-hover);
    }


    .btn-delete {

        background: transparent;

        border: 1px solid #354154;

        color: var(--muted);

        font-weight: 500;

        border-radius: 10px;

        transition: .2s ease;
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

    @media(max-width:768px) {

        .page-title {
            font-size: 24px;
        }

        .product-image,
        .product-placeholder {
            height: 240px;
        }

        .info-row {
            padding: 13px 0;
        }

        .info-label,
        .info-value {
            font-size: 13px;
        }

        .profit-value {
            font-size: 25px;
        }

    }

</style>


@php

    $jumlah = $produksi->jumlah_produksi;

    $hargaJual = $produksi->produk->harga_jual ?? 0;

    $hpp = $produksi->produk->hpp ?? 0;

    $modal = $hpp * $jumlah;

    $penjualan = $hargaJual * $jumlah;

    $keuntungan = $penjualan - $modal;

    $margin = $penjualan > 0
        ? ($keuntungan / $penjualan) * 100
        : 0;

@endphp


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="page-title">

            Detail Produksi

        </h3>

        <p class="page-subtitle mb-0">

            Informasi lengkap aktivitas produksi

        </p>

    </div>


    <a
        href="/produksi"
        class="btn btn-secondary-custom"
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
MAIN
========================= --}}

<div class="row g-4 mb-4">


    {{-- =========================
    PRODUK
    ========================= --}}

    <div class="col-lg-5">

        <div class="detail-card h-100">

            @if($produksi->produk?->gambar)

                <img
                    src="{{ asset('storage/' . $produksi->produk->gambar) }}"
                    class="product-image"
                    alt="{{ $produksi->produk->nama ?? 'Produk' }}"
                >

            @else

                <div class="product-placeholder">

                    <i class="bi bi-box-seam"></i>

                </div>

            @endif


            <div class="p-4">

                <div class="d-flex justify-content-between align-items-start gap-3">

                    <div>

                        <div class="product-name">

                            {{ $produksi->produk->nama ?? '-' }}

                        </div>

                        <div class="product-category mt-1">

                            {{ $produksi->produk->kategori ?? '-' }}

                        </div>

                    </div>


                    <span class="status-badge">

                        <i class="bi bi-check-circle"></i>

                        Tercatat

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
    INFORMASI PRODUKSI
    ========================= --}}

    <div class="col-lg-7">

        <div class="detail-card h-100">

            <div class="p-4">

                <div class="section-title mb-3">

                    Informasi Produksi

                </div>


                {{-- TANGGAL --}}

                <div class="info-row">

                    <span class="info-label">

                        Tanggal Produksi

                    </span>

                    <span class="info-value">

                        {{ \Carbon\Carbon::parse($produksi->tanggal)->translatedFormat('d F Y') }}

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

                    <span
                        class="info-value"
                        style="color:var(--primary-hover);"
                    >

                        {{ $jumlah }} produk

                    </span>

                </div>


                {{-- HARGA --}}

                <div class="info-row">

                    <span class="info-label">

                        Harga Jual / Produk

                    </span>

                    <span
                        class="info-value"
                        style="color:var(--primary-hover);"
                    >

                        Rp{{ number_format($hargaJual, 0, ',', '.') }}

                    </span>

                </div>


                {{-- HPP --}}

                <div class="info-row">

                    <span class="info-label">

                        HPP / Produk

                    </span>

                    <span class="info-value">

                        Rp{{ number_format($hpp, 0, ',', '.') }}

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
RINGKASAN
========================= --}}

<div class="detail-card mb-4">

    <div class="p-4">

        <div class="section-title mb-4">

            Ringkasan Produksi

        </div>


        <div class="row g-3">


            {{-- JUMLAH --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-icon">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <div class="summary-label">

                        Jumlah Produksi

                    </div>

                    <div class="summary-value">

                        {{ $jumlah }} produk

                    </div>

                </div>

            </div>


            {{-- HPP --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-icon">

                        <i class="bi bi-calculator"></i>

                    </div>

                    <div class="summary-label">

                        HPP / Produk

                    </div>

                    <div class="summary-value">

                        Rp{{ number_format($hpp, 0, ',', '.') }}

                    </div>

                </div>

            </div>


            {{-- MODAL --}}

            <div class="col-md-4">

                <div class="summary-box">

                    <div class="summary-icon">

                        <i class="bi bi-wallet2"></i>

                    </div>

                    <div class="summary-label">

                        Modal Produksi

                    </div>

                    <div class="summary-value">

                        Rp{{ number_format($modal, 0, ',', '.') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
KEUNTUNGAN
========================= --}}

<div class="row g-4 mb-4">


    <div class="col-lg-7">

        <div class="detail-card h-100">

            <div class="p-4">

                <div class="section-title mb-4">

                    Perkiraan Hasil Produksi

                </div>


                <div class="info-row">

                    <span class="info-label">

                        Potensi Penjualan

                    </span>

                    <span class="info-value">

                        Rp{{ number_format($penjualan, 0, ',', '.') }}

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">

                        Modal Produksi

                    </span>

                    <span class="info-value">

                        Rp{{ number_format($modal, 0, ',', '.') }}

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">

                        Perkiraan Keuntungan

                    </span>

                    <span
                        class="info-value"
                        style="color:var(--success);"
                    >

                        Rp{{ number_format($keuntungan, 0, ',', '.') }}

                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">

                        Margin

                    </span>

                    <span
                        class="info-value"
                        style="color:var(--success);"
                    >

                        {{ number_format($margin, 1, ',', '.') }}%

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- PROFIT --}}

    <div class="col-lg-5">

        <div class="profit-box h-100">

            <div class="profit-label">

                Perkiraan Keuntungan

            </div>


            <div class="profit-value">

                Rp{{ number_format($keuntungan, 0, ',', '.') }}

            </div>


            <p class="profit-description mt-2 mb-4">

                Perkiraan keuntungan apabila seluruh
                hasil produksi terjual dengan harga jual
                produk saat ini.

            </p>


            <div class="profit-row">

                <span>

                    Penjualan

                </span>

                <strong>

                    Rp{{ number_format($penjualan, 0, ',', '.') }}

                </strong>

            </div>


            <div class="profit-row mt-2">

                <span>

                    Modal

                </span>

                <strong>

                    Rp{{ number_format($modal, 0, ',', '.') }}

                </strong>

            </div>


            <hr>


            <div class="profit-row">

                <strong style="color:var(--text);">

                    Margin

                </strong>

                <strong style="color:var(--success);">

                    {{ number_format($margin, 1, ',', '.') }}%

                </strong>

            </div>

        </div>

    </div>

</div>


{{-- =========================
CATATAN
========================= --}}

@if($produksi->catatan)

    <div class="detail-card mb-4">

        <div class="p-4">

            <div class="section-title mb-3">

                Catatan Produksi

            </div>

            <div class="note-box">

                {{ $produksi->catatan }}

            </div>

        </div>

    </div>

@endif


{{-- =========================
ACTION
========================= --}}

<div class="d-flex justify-content-end gap-2 mb-5">

    <a
        href="/produksi/edit/{{ $produksi->id }}"
        class="btn btn-primary-custom"
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
        class="btn btn-secondary-custom"
    >

        Kembali

    </a>

</div>

@endsection