@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

    :root {
        --bg-main: #0d1117;

        --card: #151b24;
        --card-hover: #1a2230;
        --border: #273342;

        --primary: #3b82f6;
        --primary-soft: rgba(59,130,246,.10);

        --text: #f5f7fa;
        --muted: #8995a8;

        --success: #5ee7a0;
        --danger: #f87171;
        --warning: #fbbf24;
    }


    /* =========================
       DASHBOARD
    ========================= */

    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
    }


    /* =========================
       HEADER
    ========================= */

    .dashboard-title {
        color: var(--text);
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 4px;
    }

    .dashboard-subtitle {
        color: var(--muted);
        font-size: 14px;
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-warning {
        background: #3b82f6;
        border-color: #3b82f6;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
    }

    .btn-warning:hover {
        background: #60a5fa;
        border-color: #60a5fa;
        color: #fff;
    }

    .btn-outline-light {
        border-color: var(--border);
        color: var(--muted);
        border-radius: 10px;
    }

    .btn-outline-light:hover {
        background: var(--primary-soft);
        border-color: var(--primary);
        color: var(--primary);
    }


    /* =========================
       STAT CARD
    ========================= */

    .stat-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: var(--primary);
        background: var(--card-hover);
        box-shadow: 0 8px 25px rgba(0,0,0,.25);
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;

        background: var(--primary-soft);
        color: var(--primary);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 20px;
        margin-bottom: 15px;
    }

    .stat-label {
        color: var(--muted);
        font-size: 13px;
    }

    .stat-value {
        color: var(--text);
        font-size: 22px;
        font-weight: 700;
        margin-top: 5px;
    }


    /* =========================
       SECTION
    ========================= */

    .section-title {
        color: var(--text);
        font-weight: 700;
        margin: 0;
    }


    /* =========================
       CHART
    ========================= */

    .chart-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-info {
        color: var(--muted);
        font-size: 13px;
    }

    .chart-wrapper {
        position: relative;
        height: 320px;
    }


    /* =========================
       PRODUCT CARD
    ========================= */

    .product-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        height: 100%;

        transition: all .2s ease;
    }

    .product-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        background: var(--card-hover);
        box-shadow: 0 10px 30px rgba(0,0,0,.3);
    }


    /* =========================
       PRODUCT IMAGE
    ========================= */

    .product-image-wrapper {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: #1a2230;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;

        transition: transform .3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.04);
    }


    /* =========================
       PRODUCT CATEGORY
    ========================= */

    .product-category {
        display: inline-block;

        background: var(--primary-soft);
        color: #60a5fa;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 12px;

        margin-bottom: 9px;
    }


    /* =========================
       PRODUCT NAME
    ========================= */

    .product-name {
        color: var(--text);
        font-weight: 600;
        margin-bottom: 6px;
    }


    /* =========================
       PRODUCT PRICE
    ========================= */

    .product-price {
        color: #60a5fa;
        font-size: 20px;
        font-weight: 700;
    }


    /* =========================
       PRODUCT INFO
    ========================= */

    .product-info {
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);

        padding: 14px 0;
        margin: 15px 0;

        color: var(--muted);
        font-size: 13px;
    }

    .product-info strong {
        color: var(--text);
    }


    /* =========================
       PROFIT
    ========================= */

    .profit {
        color: var(--success);
        font-weight: 600;
    }


    /* =========================
       STOCK
    ========================= */

    .stock-good {
        color: var(--success) !important;
        font-weight: 600;
    }

    .stock-low {
        color: var(--warning) !important;
        font-weight: 600;
    }

    .stock-empty {
        color: var(--danger) !important;
        font-weight: 600;
    }


    /* =========================
       STOCK BADGE
    ========================= */

    .stock-badge {
        position: absolute;

        top: 12px;
        right: 12px;

        padding: 6px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 600;

        background: rgba(5,10,15,.72);

        backdrop-filter: blur(6px);
    }


    /* =========================
       EMPTY
    ========================= */

    .empty-product {
        background: var(--card);

        border: 1px dashed var(--border);

        border-radius: 18px;

        padding: 60px 20px;

        text-align: center;
    }

    .empty-product i {
        font-size: 45px;
        color: #4b5868;
    }

    .empty-product h5 {
        color: var(--text);
        margin-top: 15px;
    }

    .empty-product p {
        color: var(--muted);
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width: 768px) {

        .dashboard-title {
            font-size: 24px;
        }

        .dashboard-wrapper {
            width: 100%;
        }

    }

</style>


<div class="dashboard-wrapper">


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="dashboard-title">
            Dashboard
        </h3>

        <p class="dashboard-subtitle mb-0">
            Ringkasan usaha kamu
        </p>

    </div>


    <a
        href="/produk/tambah"
        class="btn btn-warning"
    >

        <i class="bi bi-plus-circle me-1"></i>

        Tambah Produk

    </a>

</div>


{{-- =========================
STATISTIK
========================= --}}

<div class="row g-3 mb-4">


{{-- PENDAPATAN --}}

<div class="col-xl col-lg-4 col-md-6">

    <div class="card stat-card h-100">

        <div class="card-body">

            <div class="stat-icon">

                <i class="bi bi-wallet2"></i>

            </div>


            <div class="stat-label">
                Pendapatan
            </div>


            <div class="stat-value">

                Rp{{ number_format(
                    $pendapatan ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>

    </div>

</div>


{{-- LABA --}}

<div class="col-xl col-lg-4 col-md-6">

    <div class="card stat-card h-100">

        <div class="card-body">

            <div class="stat-icon">

                <i class="bi bi-graph-up-arrow"></i>

            </div>


            <div class="stat-label">
                Laba
            </div>


            <div
                class="stat-value"
                style="color: var(--success);"
            >

                Rp{{ number_format(
                    $keuntungan ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>

    </div>

</div>


{{-- PRODUK --}}

<div class="col-xl col-lg-4 col-md-6">

    <div class="card stat-card h-100">

        <div class="card-body">

            <div class="stat-icon">

                <i class="bi bi-box-seam"></i>

            </div>


            <div class="stat-label">
                Produk
            </div>


            <div class="stat-value">

                {{ $totalProduk ?? 0 }}

            </div>

        </div>

    </div>

</div>


{{-- TERJUAL --}}

<div class="col-xl col-lg-4 col-md-6">

    <div class="card stat-card h-100">

        <div class="card-body">

            <div class="stat-icon">

                <i class="bi bi-cart-check"></i>

            </div>


            <div class="stat-label">
                Terjual
            </div>


            <div class="stat-value">

                {{ $terjual ?? 0 }}

            </div>

        </div>

    </div>

</div>


{{-- MODAL --}}

<div class="col-xl col-lg-4 col-md-6">

    <div class="card stat-card h-100">

        <div class="card-body">

            <div class="stat-icon">

                <i class="bi bi-cash-stack"></i>

            </div>


            <div class="stat-label">
                Modal Produksi
            </div>


            <div class="stat-value">

                Rp{{ number_format(
                    $modal ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>

    </div>

</div>


</div>


{{-- =========================
GRAFIK
========================= --}}

<div class="card chart-card mb-5">

    <div class="card-body">


        <div class="chart-header">

            <div>

                <h5 class="section-title">
                    Grafik Penjualan
                </h5>

                <div class="chart-info mt-1">
                    Perkembangan jumlah penjualan
                </div>

            </div>


            <div style="color: var(--primary);">

                <i class="bi bi-bar-chart-line"></i>

            </div>

        </div>


        <div class="chart-wrapper">

            <canvas id="chartPenjualan"></canvas>

        </div>


    </div>

</div>


{{-- =========================
HEADER PRODUK
========================= --}}

<div class="d-flex justify-content-between align-items-end mb-3">

    <div>

        <h5 class="section-title">
            Produk
        </h5>

        <p class="dashboard-subtitle mb-0">
            Produk yang kamu kelola
        </p>

    </div>


    <a
        href="/produk"
        class="btn btn-outline-light btn-sm"
    >

        Lihat Semua

        <i class="bi bi-arrow-right ms-1"></i>

    </a>

</div>


{{-- =========================
PRODUK
========================= --}}

@if($produks->count() > 0)


<div class="row g-4">


@foreach($produks as $produk)


@php

    $stok = $produk->stok ?? 0;


    if ($stok <= 0) {

        $stockClass = 'stock-empty';
        $stockText = 'Habis';

    } elseif ($stok <= 5) {

        $stockClass = 'stock-low';
        $stockText = 'Stok rendah';

    } else {

        $stockClass = 'stock-good';
        $stockText = 'Tersedia';

    }

@endphp


<div class="col-xl-4 col-lg-4 col-md-6">


    <div class="card product-card">


        {{-- =========================
        GAMBAR
        ========================= --}}

        <div class="product-image-wrapper">


            @if(!empty($produk->gambar))


                <img
                    src="{{ asset('storage/' . $produk->gambar) }}"
                    class="product-image"
                    alt="{{ $produk->nama }}"
                >


            @else


                <div
                    class="d-flex
                           align-items-center
                           justify-content-center
                           h-100"
                >

                    <i
                        class="bi bi-image"
                        style="
                            font-size:55px;
                            color:#4b5868;
                        "
                    ></i>

                </div>


            @endif


            {{-- STATUS STOK --}}

            <div class="stock-badge {{ $stockClass }}">

                <i class="bi bi-box-seam me-1"></i>

                {{ $stockText }}

            </div>


        </div>


        {{-- =========================
        INFO PRODUK
        ========================= --}}

        <div class="card-body">


            {{-- KATEGORI --}}

            <span class="product-category">

                {{ $produk->kategori ?? 'Produk' }}

            </span>


            {{-- NAMA --}}

            <h5 class="product-name">

                {{ $produk->nama }}

            </h5>


            {{-- HARGA --}}

            <div class="product-price">

                Rp{{ number_format(
                    $produk->harga_jual ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>


            {{-- =========================
            INFO
            ========================= --}}

            <div class="product-info">


                {{-- HPP --}}

                <div class="d-flex justify-content-between mb-2">

                    <span>
                        HPP
                    </span>

                    <strong>

                        Rp{{ number_format(
                            $produk->hpp ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </strong>

                </div>


                {{-- LABA --}}

                <div class="d-flex justify-content-between mb-2">

                    <span>
                        Laba / produk
                    </span>

                    <span class="profit">

                        Rp{{ number_format(
                            ($produk->harga_jual ?? 0)
                            -
                            ($produk->hpp ?? 0),
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- STOK --}}

                <div class="d-flex justify-content-between">

                    <span>
                        Stok
                    </span>

                    <strong class="{{ $stockClass }}">

                        {{ $stok }} produk

                    </strong>

                </div>


            </div>


            {{-- DETAIL --}}

            <a
                href="{{ url('/produk/detail/' . $produk->id) }}"
                class="btn btn-warning w-100"
            >

                Lihat Detail

                <i class="bi bi-arrow-right ms-1"></i>

            </a>


        </div>


    </div>


</div>


@endforeach


</div>


@else


{{-- =========================
BELUM ADA PRODUK
========================= --}}

<div class="empty-product">

    <i class="bi bi-box-seam"></i>


    <h5>
        Belum ada produk
    </h5>


    <p>
        Tambahkan produk pertama kamu
        untuk mulai mengelola usaha.
    </p>


    <a
        href="/produk/tambah"
        class="btn btn-warning"
    >

        <i class="bi bi-plus-circle me-1"></i>

        Tambah Produk

    </a>

</div>


@endif


</div>


{{-- =========================
CHART JS
========================= --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const canvas =
            document.getElementById(
                'chartPenjualan'
            );


        if (!canvas) {

            return;

        }


        new Chart(
            canvas,
            {

                type: 'line',


                data: {

                    labels:
                        @json($labels ?? []),


                    datasets: [{

                        label: 'Penjualan',

                        data:
                            @json($data ?? []),


                        borderColor:
                            '#3b82f6',


                        backgroundColor:
                            'rgba(59,130,246,.08)',


                        pointBackgroundColor:
                            '#3b82f6',


                        pointBorderColor:
                            '#151b24',


                        borderWidth: 3,


                        tension: 0.4,


                        fill: true,


                        pointRadius: 4,


                        pointHoverRadius: 6

                    }]

                },


                options: {

                    responsive: true,


                    maintainAspectRatio: false,


                    interaction: {

                        intersect: false,

                        mode: 'index'

                    },


                    plugins: {

                        legend: {

                            display: false

                        }

                    },


                    scales: {

                        x: {

                            ticks: {

                                color:
                                    '#8995a8'

                            },


                            grid: {

                                display: false

                            }

                        },


                        y: {

                            beginAtZero: true,


                            ticks: {

                                color:
                                    '#8995a8'

                            },


                            grid: {

                                color:
                                    '#273342'

                            }

                        }

                    }

                }

            }
        );

    }
);

</script>


@endsection