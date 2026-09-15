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
        --primary-hover: #60a5fa;
        --primary-soft: rgba(59,130,246,.10);

        --text: #f1f4f8;
        --muted: #8995a8;
        --dim: #64748b;

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

    .dashboard-header {
        margin-bottom: 28px;
    }

    .dashboard-title {
        color: var(--text);
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .dashboard-subtitle {
        color: var(--muted);
        font-size: 14px;
        margin: 0;
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: var(--primary);
        border: 1px solid var(--primary);

        color: #fff;
        font-size: 14px;
        font-weight: 600;

        padding: 11px 17px;
        border-radius: 10px;

        text-decoration: none;

        transition: all .2s ease;
    }

    .btn-primary-custom:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;

        transform: translateY(-2px);

        box-shadow:
            0 6px 18px rgba(59,130,246,.18);
    }

    .btn-outline-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: transparent;

        border: 1px solid var(--border);

        color: var(--muted);

        font-size: 13px;
        font-weight: 600;

        padding: 8px 13px;

        border-radius: 9px;

        text-decoration: none;

        transition: all .2s ease;
    }

    .btn-outline-custom:hover {
        background: var(--primary-soft);
        border-color: var(--primary);
        color: var(--primary-hover);
    }


    /* =========================
       STATISTICS
    ========================= */

    .stat-card {
        height: 100%;

        background: var(--card);

        border: 1px solid var(--border);

        border-radius: 16px;

        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);

        background: var(--card-hover);

        border-color: #315b9d;

        box-shadow:
            0 8px 25px rgba(0,0,0,.25);
    }

    .stat-card .card-body {
        padding: 20px;
    }

    .stat-icon {
        width: 43px;
        height: 43px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--primary-soft);

        color: var(--primary-hover);

        border-radius: 11px;

        font-size: 19px;

        margin-bottom: 15px;
    }

    .stat-label {
        color: var(--muted);

        font-size: 13px;
        font-weight: 500;
    }

    .stat-value {
        color: var(--text);

        font-size: 21px;
        font-weight: 700;

        margin-top: 5px;

        line-height: 1.3;
    }

    .stat-value.profit-value {
        color: var(--success);
    }


    /* =========================
       SECTION
    ========================= */

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;

        margin-bottom: 15px;
    }

    .section-title {
        color: var(--text);

        font-size: 18px;
        font-weight: 700;

        margin: 0;
    }

    .section-subtitle {
        color: var(--muted);

        font-size: 13px;

        margin: 5px 0 0;
    }


    /* =========================
       CHART
    ========================= */

    .chart-card {
        background: var(--card);

        border: 1px solid var(--border);

        border-radius: 18px;

        margin-bottom: 38px;
    }

    .chart-card .card-body {
        padding: 22px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 20px;
    }

    .chart-icon {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--primary-soft);

        color: var(--primary-hover);

        font-size: 17px;
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
        height: 100%;

        background: var(--card);

        border: 1px solid var(--border);

        border-radius: 18px;

        overflow: hidden;

        transition: all .2s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);

        background: var(--card-hover);

        border-color: #2563eb;

        box-shadow:
            0 10px 30px rgba(0,0,0,.30);
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

        transition:
            transform .3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.04);
    }

    .product-placeholder {
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-placeholder i {
        color: #4b5868;

        font-size: 52px;
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

        background:
            rgba(5,10,15,.72);

        backdrop-filter: blur(6px);

        font-size: 12px;
        font-weight: 600;
    }

    .stock-good {
        color: var(--success) !important;
    }

    .stock-low {
        color: var(--warning) !important;
    }

    .stock-empty {
        color: var(--danger) !important;
    }


    /* =========================
       PRODUCT INFO
    ========================= */

    .product-card .card-body {
        padding: 20px;
    }

    .product-category {
        display: inline-block;

        background: var(--primary-soft);

        color: var(--primary-hover);

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 500;

        margin-bottom: 9px;
    }

    .product-name {
        color: var(--text);

        font-size: 18px;
        font-weight: 700;

        margin-bottom: 6px;
    }

    .product-price {
        color: var(--primary-hover);

        font-size: 20px;
        font-weight: 700;
    }


    /* =========================
       PRODUCT DETAIL INFO
    ========================= */

    .product-info {
        border-top: 1px solid var(--border);

        border-bottom: 1px solid var(--border);

        padding: 14px 0;

        margin: 15px 0;

        font-size: 13px;
    }

    .product-info span {
        color: var(--muted);
    }

    .product-info strong {
        color: #cbd5e1;

        font-weight: 600;
    }

    .product-info .profit {
        color: var(--success);

        font-weight: 600;
    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-product {
        background: var(--card);

        border: 1px dashed #354154;

        border-radius: 18px;

        padding: 70px 20px;

        text-align: center;
    }

    .empty-product i {
        color: #4b5868;

        font-size: 45px;
    }

    .empty-product h5 {
        color: var(--text);

        font-size: 17px;
        font-weight: 700;

        margin-top: 15px;
        margin-bottom: 7px;
    }

    .empty-product p {
        color: var(--muted);

        font-size: 13px;

        margin-bottom: 20px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .dashboard-title {
            font-size: 24px;
        }

        .dashboard-header {
            align-items: flex-start !important;

            gap: 15px;
        }

        .dashboard-header .btn-primary-custom {
            white-space: nowrap;
        }

        .chart-card .card-body {
            padding: 18px;
        }

        .chart-wrapper {
            height: 280px;
        }

        .section-header {
            align-items: center;
        }

    }


    @media (max-width: 500px) {

        .dashboard-title {
            font-size: 22px;
        }

        .dashboard-subtitle {
            font-size: 13px;
        }

        .dashboard-header {
            flex-direction: column;
        }

        .dashboard-header .btn-primary-custom {
            width: 100%;
        }

        .stat-card .card-body {
            padding: 17px;
        }

        .stat-value {
            font-size: 19px;
        }

        .product-image-wrapper {
            height: 200px;
        }

        .chart-wrapper {
            height: 240px;
        }

        .section-header {
            align-items: flex-start;

            gap: 10px;
        }

    }

</style>


<div class="dashboard-wrapper">


    {{-- =========================
       HEADER
    ========================= --}}

    <div class="dashboard-header d-flex justify-content-between align-items-center">

        <div>

            <h3 class="dashboard-title">
                Dashboard
            </h3>

            <p class="dashboard-subtitle">
                Ringkasan usaha kamu
            </p>

        </div>


        <a
            href="/produk/tambah"
            class="btn-primary-custom"
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

            <div class="card stat-card">

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

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-icon">

                        <i class="bi bi-graph-up-arrow"></i>

                    </div>

                    <div class="stat-label">
                        Laba
                    </div>

                    <div class="stat-value profit-value">

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

            <div class="card stat-card">

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

            <div class="card stat-card">

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

            <div class="card stat-card">

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

    <div class="card chart-card">

        <div class="card-body">


            <div class="chart-header">

                <div>

                    <h5 class="section-title">
                        Grafik Penjualan
                    </h5>

                    <div class="chart-info mt-1">
                        Jumlah produk yang terjual berdasarkan tanggal
                    </div>

                </div>


                <div class="chart-icon">

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

    <div class="section-header">

        <div>

            <h5 class="section-title">
                Produk
            </h5>

            <p class="section-subtitle">
                Produk yang kamu kelola
            </p>

        </div>


        <a
            href="/produk"
            class="btn-outline-custom"
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


                                <div class="product-placeholder">

                                    <i class="bi bi-image"></i>

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
                                class="btn-primary-custom w-100"
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
                class="btn-primary-custom"
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


                    datasets: [

                        @foreach($dataGrafik ?? [] as $namaProduk => $dataProduk)

                        {

                            label:
                                @json($namaProduk),

                            data:
                                @json($dataProduk),

                            borderWidth:
                                3,

                            tension:
                                0.4,

                            fill:
                                false,

                            pointRadius:
                                4,

                            pointHoverRadius:
                                6

                        },

                        @endforeach

                    ]

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

                            display: true,

                            position: 'top',

                            labels: {

                                color:
                                    '#8995a8',

                                usePointStyle:
                                    true,

                                padding:
                                    18

                            }

                        },


                        tooltip: {

                            backgroundColor:
                                '#151b24',

                            borderColor:
                                '#273342',

                            borderWidth:
                                1,

                            titleColor:
                                '#f1f4f8',

                            bodyColor:
                                '#cbd5e1',

                            padding:
                                12

                        }

                    },


                    scales: {

                        x: {

                            ticks: {

                                color:
                                    '#8995a8'

                            },

                            grid: {

                                display:
                                    false

                            }

                        },


                        y: {

                            beginAtZero:
                                true,

                            ticks: {

                                color:
                                    '#8995a8',

                                precision:
                                    0

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