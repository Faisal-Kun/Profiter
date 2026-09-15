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


    .btn-detail {
        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.25);
        color: var(--primary-hover);
        font-weight: 600;
        border-radius: 9px;
    }

    .btn-detail:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }


    .btn-delete {
        background: transparent;
        border: 1px solid #354154;
        color: var(--muted);
        border-radius: 9px;
    }

    .btn-delete:hover {
        background: rgba(248,113,113,.10);
        border-color: var(--danger);
        color: var(--danger);
    }


    /* =========================
       CARD
    ========================= */

    .production-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }


    /* =========================
       TABLE
    ========================= */

    .production-table {
        margin: 0;
        color: var(--text);
    }

    .production-table thead {
        background: #111821;
    }

    .production-table thead th {
        color: var(--muted);
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;

        border-bottom: 1px solid var(--border);

        padding: 16px;
        white-space: nowrap;
    }

    .production-table tbody td {
        background: var(--card);
        color: #c9d0da;

        border-bottom: 1px solid var(--border);

        padding: 17px 16px;
        vertical-align: middle;
    }

    .production-table tbody tr:last-child td {
        border-bottom: none;
    }

    .production-table tbody tr {
        transition: .2s ease;
    }

    .production-table tbody tr:hover td {
        background: rgba(59,130,246,.035);
    }


    /* =========================
       NUMBER
    ========================= */

    .row-number {
        width: 50px;
        color: #5e6878 !important;
        font-size: 13px;
    }


    /* =========================
       DATE
    ========================= */

    .production-date {
        color: #b9c1cd;
        font-size: 14px;
        white-space: nowrap;
    }

    .production-date i {
        color: var(--primary-hover);
        margin-right: 7px;
    }


    /* =========================
       PRODUCT
    ========================= */

    .product-wrapper {
        display: flex;
        align-items: center;
    }

    .product-icon {
        width: 38px;
        height: 38px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--primary-soft);
        color: var(--primary-hover);

        margin-right: 10px;

        flex-shrink: 0;
    }

    .product-name {
        color: var(--text);
        font-weight: 600;
    }


    /* =========================
       PRODUCTION BADGE
    ========================= */

    .production-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        background: rgba(94,231,160,.09);
        border: 1px solid rgba(94,231,160,.18);

        color: var(--success);

        padding: 7px 11px;
        border-radius: 8px;

        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }


    /* =========================
       NOTE
    ========================= */

    .production-note {
        color: var(--muted);
        font-size: 13px;

        max-width: 230px;

        display: block;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
       EMPTY
    ========================= */

    .empty-production {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-production-icon {
        width: 72px;
        height: 72px;

        margin: 0 auto 18px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 18px;

        background: var(--primary-soft);
        color: var(--primary-hover);

        font-size: 30px;
    }

    .empty-production h5 {
        color: var(--text);
        font-weight: 600;
    }

    .empty-production p {
        color: var(--muted);
        font-size: 14px;

        max-width: 430px;
        margin: 0 auto;
    }


    /* =========================
       MOBILE
    ========================= */

    @media(max-width: 768px) {

        .page-title {
            font-size: 24px;
        }

        .page-subtitle {
            font-size: 13px;
        }

        .production-table thead th,
        .production-table tbody td {
            padding: 13px 12px;
        }

        .production-note {
            max-width: 150px;
        }

        .product-icon {
            width: 34px;
            height: 34px;
        }

    }

</style>


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="page-title">
            Produksi
        </h3>

        <p class="page-subtitle mb-0">
            Catat dan kelola aktivitas produksi produk kamu
        </p>

    </div>


    <a
        href="/produksi/tambah"
        class="btn btn-primary-custom px-3"
    >

        <i class="bi bi-plus-circle me-1"></i>

        Tambah Produksi

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
TABLE
========================= --}}

<div class="production-card">

    <div class="table-responsive">

        <table class="table production-table align-middle">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Produk</th>

                    <th>Jumlah Produksi</th>

                    <th>Catatan</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($produksis as $produksi)

                    <tr>

                        {{-- NO --}}

                        <td class="row-number">

                            {{ $loop->iteration }}

                        </td>


                        {{-- TANGGAL --}}

                        <td>

                            <span class="production-date">

                                <i class="bi bi-calendar3"></i>

                                {{ \Carbon\Carbon::parse($produksi->tanggal)->translatedFormat('d F Y') }}

                            </span>

                        </td>


                        {{-- PRODUK --}}

                        <td>

                            <div class="product-wrapper">

                                <span class="product-icon">

                                    <i class="bi bi-box-seam"></i>

                                </span>

                                <span class="product-name">

                                    {{ $produksi->produk->nama ?? '-' }}

                                </span>

                            </div>

                        </td>


                        {{-- JUMLAH --}}

                        <td>

                            <span class="production-badge">

                                <i class="bi bi-box-seam"></i>

                                {{ $produksi->jumlah_produksi }}

                                produk

                            </span>

                        </td>


                        {{-- CATATAN --}}

                        <td>

                            <span class="production-note">

                                {{ $produksi->catatan ?: 'Tidak ada catatan' }}

                            </span>

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="/produksi/detail/{{ $produksi->id }}"
                                    class="btn btn-sm btn-detail"
                                >

                                    <i class="bi bi-eye me-1"></i>

                                    Detail

                                </a>


                                <form
                                    action="/produksi/{{ $produksi->id }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produksi ini?')"
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

                        <td colspan="6">

                            <div class="empty-production">

                                <div class="empty-production-icon">

                                    <i class="bi bi-box-seam"></i>

                                </div>

                                <h5>

                                    Belum Ada Data Produksi

                                </h5>

                                <p>

                                    Mulai catat produksi produk kamu
                                    untuk mengetahui stok yang tersedia.

                                </p>

                                <a
                                    href="/produksi/tambah"
                                    class="btn btn-primary-custom mt-3 px-3"
                                >

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Tambah Produksi

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