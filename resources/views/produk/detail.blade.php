@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

    :root {
        --bg-card: #151b24;
        --bg-card-hover: #1a2230;
        --bg-soft: #1a2230;

        --border: #273342;
        --border-soft: #293647;

        --primary: #3b82f6;
        --primary-hover: #60a5fa;
        --primary-soft: rgba(59,130,246,.10);

        --text: #f5f7f6;
        --text-soft: #f1f4f8;
        --muted: #8995a8;

        --success: #5ee7a0;
        --danger: #f87171;
        --warning: #fbbf24;
    }


    /* =========================
       PAGE HEADER
    ========================= */

    .page-title {
        color: var(--text);
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: var(--muted);
        font-size: 14px;
    }


    /* =========================
       DETAIL CARD
    ========================= */

    .detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        transition: .25s ease;
    }

    .detail-card:hover {
        border-color: #2563eb;
        box-shadow: 0 10px 30px rgba(0,0,0,.25);
    }


    /* =========================
       PRODUCT IMAGE
    ========================= */

    .product-detail-image {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
    }


    /* =========================
       PRODUCT NAME
    ========================= */

    .product-name-title {
        color: var(--text);
        font-size: 22px;
        font-weight: 700;
    }

    .product-category {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;

        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.15);

        color: var(--primary-hover);
        font-size: 11px;
        font-weight: 600;
    }


    /* =========================
       SECTION TITLE
    ========================= */

    .card-section-title {
        color: var(--text);
        font-weight: 700;
    }


    /* =========================
       INFO ROW
    ========================= */

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 15px 0;

        border-bottom: 1px solid var(--border);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--muted);
        font-size: 14px;
    }

    .info-value {
        color: var(--text-soft);
        font-weight: 700;
        text-align: right;
    }


    /* =========================
       PRIMARY TEXT
    ========================= */

    .text-warning {
        color: var(--primary-hover) !important;
    }


    /* =========================
       STOCK
    ========================= */

    .text-success {
        color: var(--success) !important;
    }


    /* =========================
       BUTTON EDIT
    ========================= */

    .btn-edit {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 15px;
        transition: .2s ease;
    }

    .btn-edit:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-2px);
    }


    /* =========================
       BUTTON BACK
    ========================= */

    .btn-back {
        background: var(--bg-card);
        border: 1px solid #354154;
        color: var(--muted);
        font-weight: 600;
        border-radius: 10px;
        padding: 9px 14px;
        transition: .2s ease;
    }

    .btn-back:hover {
        background: var(--bg-soft);
        border-color: var(--primary);
        color: var(--primary-hover);
    }


    /* =========================
       BUTTON DELETE
    ========================= */

    .btn-delete {
        background: transparent;
        border: 1px solid #354154;
        color: var(--muted);
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 15px;
        transition: .2s ease;
    }

    .btn-delete:hover {
        background: rgba(248,113,113,.10);
        border-color: var(--danger);
        color: var(--danger);
    }


    /* =========================
       PROFIT BOX
    ========================= */

    .profit-box {
        background: var(--bg-card);
        border: 1px solid var(--border);
        color: var(--text);

        border-radius: 18px;
        padding: 25px;

        position: relative;
        overflow: hidden;

        transition: .25s ease;
    }

    .profit-box:hover {
        border-color: #2563eb;
        background: var(--bg-card-hover);
        box-shadow: 0 10px 30px rgba(0,0,0,.25);
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


    /* =========================
       PROFIT
    ========================= */

    .profit-label {
        color: var(--muted);
        font-size: 13px;
    }

    .profit-value {
        color: var(--primary-hover);
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
        color: var(--text-soft);
    }

    .profit-box hr {
        border-color: var(--border);
        opacity: 1;
    }


    /* =========================
       MARGIN
    ========================= */

    .margin-value {
        color: var(--primary-hover);
        font-weight: 700;
    }


    /* =========================
       RESPONSIVE
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
            Detail Produk
        </h3>

        <p class="page-subtitle mb-0">
            Informasi lengkap dan perhitungan produk
        </p>

    </div>


    <a
        href="/produk"
        class="btn btn-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>



{{-- =========================
MAIN CONTENT
========================= --}}

<div class="row g-4">


    {{-- =========================
    FOTO PRODUK
    ========================= --}}

    <div class="col-lg-5">

        <div class="detail-card">

            @if($produk->gambar)

                <img
                    src="{{ asset('storage/' . $produk->gambar) }}"
                    class="product-detail-image"
                    alt="{{ $produk->nama }}"
                >

            @else

                <div
                    class="product-detail-image d-flex align-items-center justify-content-center"
                    style="background:#1a2230;"
                >

                    <i
                        class="bi bi-image"
                        style="font-size:70px;color:#526176;"
                    ></i>

                </div>

            @endif


            <div class="p-4 text-center">

                <h4 class="product-name-title mb-2">

                    {{ $produk->nama }}

                </h4>


                <span class="product-category">

                    {{ $produk->kategori ?? 'Produk' }}

                </span>

            </div>

        </div>

    </div>



    {{-- =========================
    INFORMASI PRODUK
    ========================= --}}

    <div class="col-lg-7">

        <div class="detail-card">

            <div class="p-4">

                <h5 class="card-section-title mb-3">

                    Informasi Produk

                </h5>


                {{-- NAMA --}}

                <div class="info-row">

                    <span class="info-label">
                        Nama Produk
                    </span>

                    <span class="info-value">
                        {{ $produk->nama }}
                    </span>

                </div>


                {{-- KATEGORI --}}

                <div class="info-row">

                    <span class="info-label">
                        Kategori
                    </span>

                    <span class="info-value">
                        {{ $produk->kategori ?? 'Produk' }}
                    </span>

                </div>


                {{-- HARGA --}}

                <div class="info-row">

                    <span class="info-label">
                        Harga Jual
                    </span>

                    <span class="info-value text-warning">

                        Rp{{ number_format(
                            $produk->harga_jual ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- STOK --}}

                <div class="info-row">

                    <span class="info-label">
                        Stok Tersedia
                    </span>

                    <span class="info-value text-success">

                        {{ $produk->stok ?? 0 }}
                        produk

                    </span>

                </div>


                {{-- TOTAL BAHAN --}}

                <div class="info-row">

                    <span class="info-label">
                        Total Biaya Bahan
                    </span>

                    <span class="info-value">

                        Rp{{ number_format(
                            $produk->total_bahan ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- BIAYA TAMBAHAN --}}

                <div class="info-row">

                    <span class="info-label">
                        Biaya Tambahan
                    </span>

                    <span class="info-value">

                        Rp{{ number_format(
                            $produk->total_biaya_tambahan ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- TOTAL MODAL --}}

                <div class="info-row">

                    <span class="info-label">
                        Total Modal Produksi
                    </span>

                    <span class="info-value">

                        Rp{{ number_format(
                            $produk->total_modal ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- HPP --}}

                <div class="info-row">

                    <span class="info-label">
                        HPP / Produk
                    </span>

                    <span class="info-value text-warning">

                        Rp{{ number_format(
                            $produk->hpp ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                {{-- BUTTON --}}

                <div class="d-flex gap-2 mt-4">


                    <a
                        href="/produk/edit/{{ $produk->id }}"
                        class="btn btn-edit"
                    >

                        <i class="bi bi-pencil me-1"></i>

                        Edit Produk

                    </a>


                    <form
                        action="/produk/{{ $produk->id }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-delete"
                        >

                            <i class="bi bi-trash me-1"></i>

                            Hapus

                        </button>

                    </form>


                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================
KEUNTUNGAN
========================= --}}

<div class="row g-4 mt-1">


    <div class="col-lg-5">

        <div class="profit-box h-100">

            <div class="profit-label">
                Keuntungan / Produk
            </div>


            <div class="profit-value mt-2">

                Rp{{ number_format(
                    ($produk->harga_jual ?? 0) - ($produk->hpp ?? 0),
                    0,
                    ',',
                    '.'
                ) }}

            </div>


            <p class="profit-description mb-4 mt-2">

                Perkiraan keuntungan dari setiap produk
                yang terjual.

            </p>


            <div class="d-flex justify-content-between profit-row">

                <span>
                    Harga Jual
                </span>

                <strong>

                    Rp{{ number_format(
                        $produk->harga_jual ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>


            <div class="d-flex justify-content-between mt-2 profit-row">

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


            <hr>


            <div class="d-flex justify-content-between">

                <strong>
                    Margin
                </strong>

                <strong class="margin-value">

                    @if(($produk->harga_jual ?? 0) > 0)

                        {{ number_format(
                            (
                                (
                                    ($produk->harga_jual ?? 0)
                                    -
                                    ($produk->hpp ?? 0)
                                )
                                /
                                $produk->harga_jual
                            ) * 100,
                            1,
                            ',',
                            '.'
                        ) }}%

                    @else

                        0%

                    @endif

                </strong>

            </div>

        </div>

    </div>


</div>


@endsection