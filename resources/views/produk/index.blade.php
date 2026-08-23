@extends('layouts.app')

@section('content')

<style>

.product-page {
    max-width: 1400px;
    margin: 0 auto;
}

/* HEADER */

.product-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}

.product-title {
    color: #f5f7f6;
    font-size: 28px;
    font-weight: 700;
    margin: 0;
}

.product-subtitle {
    color: #8995a8;
    font-size: 14px;
    margin-top: 6px;
}


/* BUTTON */

.btn-add-product {
    background: #3b82f6;
    border: none;
    color: #fff;
    font-weight: 700;
    padding: 11px 17px;
    border-radius: 10px;
    transition: .2s;
}

.btn-add-product:hover {
    background: #60a5fa;
    color: #fff;
    transform: translateY(-2px);
}


/* ALERT */

.product-alert {
    background: rgba(52,211,153,.08);
    border: 1px solid rgba(52,211,153,.2);
    color: #6ee7b7;
    border-radius: 12px;
}


/* COUNT */

.product-count {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 22px;
}

.product-count-label {
    color: #8995a8;
    font-size: 14px;
}

.product-count-number {
    background: #17243a;
    color: #60a5fa;
    border: 1px solid #263b5c;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}


/* CARD */

.product-card {
    background: #151b24;
    border: 1px solid #273342;
    border-radius: 18px;
    overflow: hidden;
    height: 100%;
    transition: .25s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    border-color: #2563eb;
    box-shadow: 0 14px 35px rgba(0,0,0,.25);
}


/* IMAGE */

.product-image-wrapper {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: #1a2230;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.04);
}


/* PLACEHOLDER */

.product-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #526176;
    font-size: 55px;
}


/* STOCK */

.stock-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    padding: 6px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    backdrop-filter: blur(8px);
}

.stock-good {
    background: rgba(52,211,153,.15);
    color: #6ee7b7;
    border: 1px solid rgba(52,211,153,.2);
}

.stock-low {
    background: rgba(245,158,11,.15);
    color: #fbbf24;
    border: 1px solid rgba(245,158,11,.2);
}

.stock-empty {
    background: rgba(248,113,113,.15);
    color: #f87171;
    border: 1px solid rgba(248,113,113,.2);
}


/* CONTENT */

.product-info {
    padding: 20px;
}


/* CATEGORY */

.product-category {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    background: rgba(59,130,246,.10);
    border: 1px solid rgba(59,130,246,.15);
    color: #60a5fa;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 10px;
}


/* NAME */

.product-name {
    color: #f5f7f6;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}


/* PRICE */

.product-price {
    color: #60a5fa;
    font-size: 21px;
    font-weight: 700;
    margin-bottom: 18px;
}


/* STATS */

.product-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 18px;
}

.stat-box {
    background: #1a2230;
    border: 1px solid #293647;
    border-radius: 10px;
    padding: 11px 9px;
}

.stat-label {
    display: block;
    color: #7f8da3;
    font-size: 11px;
    margin-bottom: 5px;
}

.stat-value {
    display: block;
    color: #f1f4f8;
    font-size: 13px;
    font-weight: 700;
}

.stat-profit {
    color: #5ee7a0;
}


/* DETAIL */

.btn-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    padding: 11px;
    border-radius: 10px;
    background: #3b82f6;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: .2s;
}

.btn-detail:hover {
    background: #60a5fa;
    color: #fff;
}


/* EMPTY */

.empty-product {
    background: #151b24;
    border: 1px dashed #354154;
    border-radius: 18px;
    padding: 70px 20px;
    text-align: center;
}

.empty-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 18px;
    border-radius: 18px;
    background: #17243a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #526176;
    font-size: 32px;
}

.empty-product h5 {
    color: #f5f7fa;
    font-weight: 700;
}

.empty-product p {
    color: #7f8da3;
    font-size: 14px;
}


/* RESPONSIVE */

@media(max-width: 768px) {

    .product-header {
        align-items: flex-start;
        gap: 15px;
    }

    .product-title {
        font-size: 24px;
    }

    .btn-add-product {
        white-space: nowrap;
    }

}

@media(max-width: 500px) {

    .product-header {
        flex-direction: column;
    }

    .btn-add-product {
        width: 100%;
    }

    .product-stats {
        grid-template-columns: 1fr;
    }

}

</style>

<div class="product-page">


<div class="product-header">

    <div>

        <h3 class="product-title">
            Produk
        </h3>

        <div class="product-subtitle">
            Kelola produk, harga, stok, dan keuntungan usaha
        </div>

    </div>

    <a
        href="/produk/tambah"
        class="btn btn-add-product"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Produk
    </a>

</div>


@if(session('success'))

    <div class="alert product-alert alert-dismissible fade show mb-4">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


<div class="product-count">

    <span class="product-count-label">
        Total produk
    </span>

    <span class="product-count-number">
        {{ $produks->count() }}
    </span>

</div>


<div class="row g-4">

    @forelse($produks as $produk)

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

            $laba =
                ($produk->harga_jual ?? 0)
                -
                ($produk->hpp ?? 0);

        @endphp


        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="product-card">

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


                    <div class="stock-badge {{ $stockClass }}">

                        <i class="bi bi-box-seam me-1"></i>

                        {{ $stockText }}

                    </div>

                </div>


                <div class="product-info">

                    <span class="product-category">

                        {{ $produk->kategori ?? 'Produk' }}

                    </span>


                    <h5 class="product-name">

                        {{ $produk->nama }}

                    </h5>


                    <div class="product-price">

                        Rp{{ number_format(
                            $produk->harga_jual ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    <div class="product-stats">

                        <div class="stat-box">

                            <span class="stat-label">
                                Stok
                            </span>

                            <span class="stat-value">
                                {{ $stok }}
                            </span>

                        </div>


                        <div class="stat-box">

                            <span class="stat-label">
                                HPP
                            </span>

                            <span class="stat-value">

                                Rp{{ number_format(
                                    $produk->hpp ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </div>


                        <div class="stat-box">

                            <span class="stat-label">
                                Laba
                            </span>

                            <span class="stat-value stat-profit">

                                Rp{{ number_format(
                                    $laba,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </div>

                    </div>


                    <a
                        href="/produk/detail/{{ $produk->id }}"
                        class="btn-detail"
                    >

                        <i class="bi bi-eye"></i>

                        Lihat Detail

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="empty-product">

                <div class="empty-icon">

                    <i class="bi bi-box-seam"></i>

                </div>

                <h5>
                    Belum ada produk
                </h5>

                <p>
                    Tambahkan produk pertama untuk mulai
                    mengelola usaha kamu.
                </p>

                <a
                    href="/produk/tambah"
                    class="btn btn-add-product"
                >

                    <i class="bi bi-plus-lg me-1"></i>

                    Tambah Produk

                </a>

            </div>

        </div>

    @endforelse

</div>


</div>

@endsection
