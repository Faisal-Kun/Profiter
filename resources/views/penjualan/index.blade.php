@extends('layouts.app')

@section('content')

<style>

    /* =========================
       HEADER
    ========================= */

    .page-title {
        color: #fff;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #858994;
        font-size: 14px;
    }


    /* =========================
       SALES CARD
    ========================= */

    .sales-card {
        background: #17191f;
        border: 1px solid #272a33;
        border-radius: 16px;
        overflow: hidden;
    }


    /* =========================
       TABLE
    ========================= */

    .sales-table {
        margin: 0;
        color: #fff;
    }

    .sales-table thead {
        background: #11141b;
    }

    .sales-table thead th {
        color: #858994;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #272a33;
        padding: 16px;
        white-space: nowrap;
    }

    .sales-table tbody td {
        background: #17191f;
        color: #c9ccd4;
        border-bottom: 1px solid #272a33;
        padding: 17px 16px;
        vertical-align: middle;
    }

    .sales-table tbody tr:last-child td {
        border-bottom: none;
    }

    .sales-table tbody tr {
        transition: .2s ease;
    }

    .sales-table tbody tr:hover td {
        background: rgba(34, 211, 238, .045);
    }


    /* =========================
       NUMBER
    ========================= */

    .row-number {
        width: 45px;
        color: #626875 !important;
        font-size: 13px;
    }


    /* =========================
       DATE
    ========================= */

    .sales-date {
        color: #b8bdc8;
        white-space: nowrap;
        font-size: 14px;
    }

    .sales-date i {
        color: #22d3ee;
        margin-right: 7px;
    }


    /* =========================
       PRODUCT
    ========================= */

    .product-name {
        color: #fff;
        font-weight: 600;
    }

    .product-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: rgba(34, 211, 238, .10);
        color: #22d3ee;

        margin-right: 9px;
    }


    /* =========================
       QUANTITY
    ========================= */

    .sales-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 7px 11px;

        border-radius: 8px;

        background: rgba(34, 211, 238, .10);
        color: #22d3ee;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================
       PRICE
    ========================= */

    .sales-price {
        color: #c9ccd4;
        font-size: 14px;
        white-space: nowrap;
    }


    /* =========================
       TOTAL
    ========================= */

    .sales-total {
        color: #fff;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================
       PROFIT
    ========================= */

    .sales-profit {
        color: #43d17d;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================
       ACTION
    ========================= */

    .btn-detail {
        background: rgba(34, 211, 238, .10);
        border: 1px solid rgba(34, 211, 238, .25);
        color: #22d3ee;
        font-weight: 600;
    }

    .btn-detail:hover {
        background: #22d3ee;
        border-color: #22d3ee;
        color: #061014;
    }


    .btn-edit {
        background: rgba(99, 102, 241, .10);
        border: 1px solid rgba(99, 102, 241, .25);
        color: #818cf8;
        font-weight: 600;
    }

    .btn-edit:hover {
        background: #6366f1;
        border-color: #6366f1;
        color: #fff;
    }


    .btn-delete {
        border-color: #353945;
        color: #858994;
    }

    .btn-delete:hover {
        background: rgba(255, 92, 92, .10);
        border-color: #ff5c5c;
        color: #ff5c5c;
    }


    /* =========================
       EMPTY
    ========================= */

    .empty-sales {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-sales-icon {
        width: 70px;
        height: 70px;

        margin: 0 auto 18px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 18px;

        background: rgba(34, 211, 238, .08);
        color: #22d3ee;

        font-size: 32px;
    }

    .empty-sales h5 {
        color: #fff;
        font-weight: 600;
    }

    .empty-sales p {
        color: #858994;
        font-size: 14px;
    }


    /* =========================
       ALERT
    ========================= */

    .sales-alert {
        background: rgba(34, 211, 238, .08);
        border: 1px solid rgba(34, 211, 238, .2);
        color: #22d3ee;
        border-radius: 10px;
    }

    .sales-alert .btn-close {
        filter: invert(1);
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .sales-table thead th,
        .sales-table tbody td {
            padding: 13px 12px;
        }

    }

</style>


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="page-title">
            Penjualan
        </h3>

        <p class="page-subtitle mb-0">
            Catat dan kelola transaksi penjualan produk kamu
        </p>

    </div>


    <a
        href="/penjualan/tambah"
        class="btn btn-warning"
    >

        <i class="bi bi-plus-circle me-1"></i>

        Tambah Penjualan

    </a>

</div>


{{-- =========================
NOTIFIKASI
========================= --}}

@if(session('success'))

    <div class="alert sales-alert alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


{{-- =========================
TABLE
========================= --}}

<div class="sales-card">

    <div class="table-responsive">

        <table class="table sales-table align-middle">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Produk</th>

                    <th>Jumlah</th>

                    <th>Harga Jual</th>

                    <th>Total Penjualan</th>

                    <th>Keuntungan</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($penjualans as $penjualan)

                    <tr>

                        {{-- NO --}}

                        <td class="row-number">

                            {{ $loop->iteration }}

                        </td>


                        {{-- TANGGAL --}}

                        <td>

                            <span class="sales-date">

                                <i class="bi bi-calendar3"></i>

                                {{ \Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat('d F Y') }}

                            </span>

                        </td>


                        {{-- PRODUK --}}

                        <td>

                            <span class="product-icon">

                                <i class="bi bi-box-seam"></i>

                            </span>

                            <strong class="product-name">

                                {{ $penjualan->produk->nama ?? '-' }}

                            </strong>

                        </td>


                        {{-- JUMLAH --}}

                        <td>

                            <span class="sales-badge">

                                <i class="bi bi-cart-check"></i>

                                {{ $penjualan->jumlah_terjual }}

                                produk

                            </span>

                        </td>


                        {{-- HARGA JUAL --}}

                        <td>

                            <span class="sales-price">

                                Rp{{ number_format(
                                    $penjualan->harga_jual,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </td>


                        {{-- TOTAL PENJUALAN --}}

                        <td>

                            <strong class="sales-total">

                                Rp{{ number_format(
                                    $penjualan->total_penjualan,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </strong>

                        </td>


                        {{-- KEUNTUNGAN --}}

                        <td>

                            <strong class="sales-profit">

                                Rp{{ number_format(
                                    $penjualan->keuntungan,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </strong>

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <div class="d-flex gap-2">


                                {{-- DETAIL --}}

                                <a
                                    href="/penjualan/detail/{{ $penjualan->id }}"
                                    class="btn btn-sm btn-detail"
                                >

                                    <i class="bi bi-eye me-1"></i>

                                    Detail

                                </a>


                                {{-- EDIT --}}

                                <a
                                    href="/penjualan/edit/{{ $penjualan->id }}"
                                    class="btn btn-sm btn-edit"
                                >

                                    <i class="bi bi-pencil me-1"></i>

                                    Edit

                                </a>


                                {{-- HAPUS --}}

                                <form
                                    action="/penjualan/{{ $penjualan->id }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus penjualan ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-delete"
                                        title="Hapus"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>


                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="8">

                            <div class="empty-sales">

                                <div class="empty-sales-icon">

                                    <i class="bi bi-receipt"></i>

                                </div>


                                <h5>
                                    Belum Ada Data Penjualan
                                </h5>


                                <p>
                                    Mulai catat transaksi penjualan
                                    produk kamu untuk melihat keuntungan.
                                </p>


                                <a
                                    href="/penjualan/tambah"
                                    class="btn btn-warning mt-2"
                                >

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Tambah Penjualan

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection