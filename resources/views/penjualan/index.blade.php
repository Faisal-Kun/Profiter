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

    .sales-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .sales-header {
        margin-bottom: 24px;
    }

    .sales-title {
        color: var(--text);
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .sales-subtitle {
        color: var(--muted);
        font-size: 14px;
        margin: 0;
    }

    .btn-add-sales {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        padding: 11px 17px;
        border-radius: 10px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-add-sales:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-2px);
    }

    /* =========================
       ALERT
    ========================= */

    .sales-alert {
        background: rgba(94,231,160,.08);
        border: 1px solid rgba(94,231,160,.20);
        color: var(--success);
        border-radius: 10px;
    }

    .sales-alert .btn-close {
        filter: invert(1);
    }

    /* =========================
       COUNT
    ========================= */

    .sales-count {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 14px;
    }

    .sales-count-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 30px;
        height: 26px;

        padding: 0 9px;
        margin-left: 5px;

        background: #17243a;
        border: 1px solid #263b5c;
        color: #60a5fa;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 700;
    }

    /* =========================
       TABLE CARD
    ========================= */

    .sales-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
    }

    .sales-table {
        margin: 0;
        color: var(--text);
    }

    .sales-table thead {
        background: #111822;
    }

    .sales-table thead th {
        color: var(--muted);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;

        border-bottom: 1px solid var(--border);

        padding: 16px;
        white-space: nowrap;
    }

    .sales-table tbody td {
        background: var(--card);
        color: #c9d0da;

        border-bottom: 1px solid var(--border);

        padding: 17px 16px;
        vertical-align: middle;
    }

    .sales-table tbody tr:last-child td {
        border-bottom: none;
    }

    .sales-table tbody tr {
        transition: all .2s ease;
    }

    .sales-table tbody tr:hover td {
        background: var(--card-hover);
    }

    /* =========================
       NUMBER
    ========================= */

    .row-number {
        width: 45px;
        color: #657286 !important;
        font-size: 13px;
    }

    /* =========================
       DATE
    ========================= */

    .sales-date {
        color: #b8c1ce;
        white-space: nowrap;
        font-size: 13px;
    }

    .sales-date i {
        color: var(--primary);
        margin-right: 7px;
    }

    /* =========================
       PRODUCT
    ========================= */

    .product-wrapper {
        display: flex;
        align-items: center;
        min-width: 170px;
    }

    .product-icon {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.15);

        color: var(--primary);

        margin-right: 10px;
    }

    .product-name {
        color: var(--text);
        font-weight: 600;
        font-size: 14px;
    }

    /* =========================
       QUANTITY
    ========================= */

    .sales-quantity {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 7px 11px;

        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.15);

        color: #60a5fa;

        border-radius: 8px;

        font-size: 12px;
        font-weight: 600;
    }

    /* =========================
       MONEY
    ========================= */

    .sales-price {
        color: #b8c1ce;
        font-size: 13px;
        white-space: nowrap;
    }

    .sales-total {
        color: var(--text);
        font-weight: 700;
        white-space: nowrap;
        font-size: 14px;
    }

    .sales-profit {
        color: var(--success);
        font-weight: 700;
        white-space: nowrap;
        font-size: 14px;
    }

    /* =========================
       ACTION
    ========================= */

    .btn-sales-detail {
        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.22);
        color: #60a5fa;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-sales-detail:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .btn-sales-edit {
        background: rgba(99,102,241,.10);
        border: 1px solid rgba(99,102,241,.22);
        color: #818cf8;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-sales-edit:hover {
        background: #6366f1;
        border-color: #6366f1;
        color: #fff;
    }

    .btn-sales-delete {
        background: transparent;
        border: 1px solid #354154;
        color: #8995a8;
        border-radius: 9px;
    }

    .btn-sales-delete:hover {
        background: rgba(248,113,113,.10);
        border-color: var(--danger);
        color: var(--danger);
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

        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.15);

        color: var(--primary);

        font-size: 30px;
    }

    .empty-sales h5 {
        color: var(--text);
        font-weight: 600;
        margin-bottom: 7px;
    }

    .empty-sales p {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .sales-title {
            font-size: 24px;
        }

        .sales-header {
            align-items: flex-start !important;
            gap: 15px;
        }

        .sales-table thead th,
        .sales-table tbody td {
            padding: 13px 12px;
        }

        .btn-add-sales {
            padding: 9px 12px;
            font-size: 13px;
        }
    }

    @media (max-width: 500px) {

        .sales-header {
            flex-direction: column;
        }

        .btn-add-sales {
            width: 100%;
        }
    }
</style>


<div class="sales-page">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="sales-header d-flex justify-content-between align-items-center">

        <div>

            <h3 class="sales-title">
                Penjualan
            </h3>

            <p class="sales-subtitle">
                Catat dan kelola transaksi penjualan produk kamu
            </p>

        </div>

        <a
            href="/penjualan/tambah"
            class="btn btn-add-sales"
        >

            <i class="bi bi-plus-circle me-1"></i>
            Tambah Penjualan

        </a>

    </div>


    {{-- =========================
         ALERT
    ========================= --}}

    @if(session('success'))

        <div class="alert sales-alert alert-dismissible fade show mb-4">

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
         COUNT
    ========================= --}}

    <div class="sales-count">

        Total transaksi

        <span class="sales-count-number">
            {{ $penjualans->count() }}
        </span>

    </div>


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

                                <div class="product-wrapper">

                                    <span class="product-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </span>

                                    <strong class="product-name">
                                        {{ $penjualan->produk->nama ?? '-' }}
                                    </strong>

                                </div>

                            </td>


                            {{-- JUMLAH --}}

                            <td>

                                <span class="sales-quantity">

                                    <i class="bi bi-cart-check"></i>

                                    {{ $penjualan->jumlah_terjual }}

                                    produk

                                </span>

                            </td>


                            {{-- HARGA --}}

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


                            {{-- TOTAL --}}

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

                                    <a
                                        href="/penjualan/detail/{{ $penjualan->id }}"
                                        class="btn btn-sm btn-sales-detail"
                                    >
                                        <i class="bi bi-eye me-1"></i>
                                        Detail
                                    </a>


                                    <a
                                        href="/penjualan/edit/{{ $penjualan->id }}"
                                        class="btn btn-sm btn-sales-edit"
                                    >
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>


                                    <form
                                        action="/penjualan/{{ $penjualan->id }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus penjualan ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-sales-delete"
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
                                        class="btn btn-add-sales mt-3"
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

</div>

@endsection