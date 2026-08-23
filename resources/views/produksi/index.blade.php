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
       PRODUCTION CARD
    ========================= */

    .production-card {
        background: #17191f;
        border: 1px solid #272a33;
        border-radius: 16px;
        overflow: hidden;
    }


    /* =========================
       TABLE
    ========================= */

    .production-table {
        margin: 0;
        color: #fff;
    }

    .production-table thead {
        background: #11141b;
    }

    .production-table thead th {
        color: #858994;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #272a33;
        padding: 16px;
        white-space: nowrap;
    }

    .production-table tbody td {
        background: #17191f;
        color: #c9ccd4;
        border-bottom: 1px solid #272a33;
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

    .production-date {
        color: #b8bdc8;
        white-space: nowrap;
        font-size: 14px;
    }

    .production-date i {
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
       PRODUCTION BADGE
    ========================= */

    .production-badge {
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
       NOTE
    ========================= */

    .production-note {
        color: #858994;
        font-size: 13px;
        max-width: 250px;
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

    .empty-production {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-production-icon {
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

    .empty-production h5 {
        color: #fff;
        font-weight: 600;
    }

    .empty-production p {
        color: #858994;
        font-size: 14px;
    }


    /* =========================
       ALERT
    ========================= */

    .production-alert {
        background: rgba(34, 211, 238, .08);
        border: 1px solid rgba(34, 211, 238, .2);
        color: #22d3ee;
        border-radius: 10px;
    }

    .production-alert .btn-close {
        filter: invert(1);
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .production-table thead th,
        .production-table tbody td {
            padding: 13px 12px;
        }

        .production-note {
            max-width: 150px;
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
    class="btn btn-warning"
>

    <i class="bi bi-plus-circle me-1"></i>

    Tambah Produksi

</a>


</div>

{{-- =========================
NOTIFIKASI
========================= --}}

@if(session('success'))


<div class="alert production-alert alert-dismissible fade show">

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

                        <span class="product-icon">

                            <i class="bi bi-box-seam"></i>

                        </span>

                        <strong class="product-name">

                            {{ $produksi->produk->nama ?? '-' }}

                        </strong>

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
                                class="btn btn-warning mt-2"
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
