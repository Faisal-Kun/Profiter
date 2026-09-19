@extends('layouts.app')

@section('content')

<style>
    :root {
        --bg-card: #151b24;
        --bg-soft: #1a2230;
        --border: #273342;
        --primary: #3b82f6;
        --primary-hover: #60a5fa;
        --text: #f5f7f6;
        --muted: #8995a8;
        --success: #22c55e;
        --danger: #ef4444;
    }

    .detail-wrapper {
        max-width: 1200px;
        margin: auto;
    }

    /* =========================
       HEADER
    ========================= */

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 15px;
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .back-btn {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--bg-card);
        border: 1px solid var(--border);

        color: var(--text);
        text-decoration: none;

        transition: .2s;
    }

    .back-btn:hover {
        background: var(--bg-soft);
        color: var(--primary-hover);
    }

    .detail-header h1 {
        margin: 0;
        color: var(--text);
        font-size: 25px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        border: none;
        border-radius: 9px;
        padding: 10px 16px;

        font-weight: 600;
        text-decoration: none;

        cursor: pointer;

        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--primary-hover);
        color: white;
    }

    .btn-delete {
        background: #2a1a1d;
        border: 1px solid #4b252b;
        color: #f87171;
    }

    .btn-delete:hover {
        background: #381c21;
    }

    /* =========================
       MAIN GRID
    ========================= */

    .main-grid {
        display: grid;
        grid-template-columns: 350px 1fr;

        gap: 20px;
        margin-bottom: 20px;
    }

    .detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border);

        border-radius: 14px;
        padding: 22px;
    }

    /* =========================
       PRODUCT
    ========================= */

    .product-image {
        width: 100%;
        height: 300px;

        border-radius: 12px;

        object-fit: cover;

        background: var(--bg-soft);

        display: block;
    }

    .no-image {
        height: 300px;

        border-radius: 12px;

        background: var(--bg-soft);

        display: flex;
        align-items: center;
        justify-content: center;

        color: var(--muted);
    }

    .product-name {
        color: var(--text);

        font-size: 24px;

        margin: 18px 0 6px;
    }

    .product-category {
        color: var(--muted);
        margin: 0;
    }

    /* =========================
       INFORMATION
    ========================= */

    .section-title {
        color: var(--text);

        font-size: 18px;

        margin: 0 0 18px;
    }

    .info-list {
        display: grid;
        gap: 0;
    }

    .info-row {
        display: flex;
        justify-content: space-between;

        gap: 20px;

        padding: 13px 0;

        border-bottom: 1px solid var(--border);
    }

    .info-row:first-child {
        padding-top: 0;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: var(--muted);
    }

    .info-value {
        color: var(--text);

        font-weight: 600;

        text-align: right;
    }

    .price {
        color: #60a5fa;
    }

    .profit {
        color: var(--success);
    }

    /* =========================
       STATS
    ========================= */

    .stats-grid {
        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 15px;

        margin-bottom: 20px;
    }

    .stat-card {
        background: var(--bg-card);

        border: 1px solid var(--border);

        border-radius: 12px;

        padding: 18px;
    }

    .stat-label {
        color: var(--muted);

        font-size: 13px;

        margin-bottom: 8px;
    }

    .stat-value {
        color: var(--text);

        font-size: 22px;

        font-weight: 700;
    }

    .stat-sub {
        color: var(--muted);

        font-size: 12px;

        margin-top: 5px;
    }

    /* =========================
       SECTION
    ========================= */

    .section-card {
        background: var(--bg-card);

        border: 1px solid var(--border);

        border-radius: 14px;

        padding: 22px;

        margin-bottom: 20px;
    }

    .section-header {
        display: flex;

        justify-content: space-between;
        align-items: center;

        margin-bottom: 18px;
    }

    .section-header .section-title {
        margin: 0;
    }

    /* =========================
       TABLE
    ========================= */

    .table-wrapper {
        overflow-x: auto;
    }

    .detail-table {
        width: 100%;

        border-collapse: collapse;
    }

    .detail-table th {
        color: var(--muted);

        font-size: 13px;

        font-weight: 600;

        text-align: left;

        padding: 12px;

        border-bottom: 1px solid var(--border);

        white-space: nowrap;
    }

    .detail-table td {
        color: var(--text);

        padding: 14px 12px;

        border-bottom: 1px solid var(--border);

        white-space: nowrap;
    }

    .detail-table tr:last-child td {
        border-bottom: none;
    }

    .detail-table .number {
        text-align: right;
    }

    .empty {
        padding: 25px;

        text-align: center;

        color: var(--muted);
    }

    /* =========================
       PROFIT
    ========================= */

    .profit-box {
        background: linear-gradient(
            135deg,
            #17243a,
            #151b24
        );

        border: 1px solid #29436a;

        border-radius: 14px;

        padding: 22px;
    }

    .profit-title {
        color: var(--muted);

        margin-bottom: 8px;
    }

    .profit-main {
        color: var(--success);

        font-size: 30px;

        font-weight: 800;

        margin-bottom: 18px;
    }

    .profit-details {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 15px;
    }

    .profit-detail {
        background: rgba(0, 0, 0, .15);

        border-radius: 10px;

        padding: 14px;
    }

    .profit-detail span {
        display: block;

        color: var(--muted);

        font-size: 13px;

        margin-bottom: 5px;
    }

    .profit-detail strong {
        color: var(--text);

        font-size: 17px;
    }

    .delete-form {
        margin: 0;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 900px) {

        .main-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {

        .detail-header {
            align-items: flex-start;

            flex-direction: column;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;

            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .profit-details {
            grid-template-columns: 1fr;
        }

        .detail-card,
        .section-card {
            padding: 16px;
        }
    }
</style>


<div class="detail-wrapper">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="detail-header">

        <div class="detail-header-left">

            <a href="{{ url('/produk') }}" class="back-btn">
                ←
            </a>

            <div>
                <h1>Detail Produk</h1>
            </div>

        </div>


        <div class="header-actions">

            <a
                href="{{ url('/produk/edit/'.$produk->id) }}"
                class="btn btn-edit"
            >
                ✏️ Edit
            </a>


            <form
                action="{{ url('/produk/'.$produk->id) }}"
                method="POST"
                class="delete-form"
                onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-delete"
                >
                    🗑️ Hapus
                </button>

            </form>

        </div>

    </div>


    {{-- =========================
         INFORMASI UTAMA
    ========================= --}}

    <div class="main-grid">


        {{-- PRODUK --}}

        <div class="detail-card">

            @if($produk->gambar)

                <img
                    src="{{ asset('storage/'.$produk->gambar) }}"
                    alt="{{ $produk->nama }}"
                    class="product-image"
                >

            @else

                <div class="no-image">
                    Tidak ada gambar
                </div>

            @endif


            <h2 class="product-name">
                {{ $produk->nama }}
            </h2>


            <p class="product-category">
                {{ $produk->kategori }}
            </p>

        </div>



        {{-- INFORMASI PRODUK --}}

        <div class="detail-card">

            <h2 class="section-title">
                Informasi Produk
            </h2>


            <div class="info-list">


                <div class="info-row">

                    <span class="info-label">
                        Harga Jual
                    </span>

                    <span class="info-value price">
                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        HPP / Unit
                    </span>

                    <span class="info-value">
                        Rp {{ number_format($produk->hpp, 0, ',', '.') }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Total Komponen
                    </span>

                    <span class="info-value">
                        Rp {{ number_format($produk->total_bahan, 0, ',', '.') }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Biaya Tambahan
                    </span>

                    <span class="info-value">
                        Rp {{ number_format($produk->total_biaya_tambahan, 0, ',', '.') }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Total Modal
                    </span>

                    <span class="info-value">
                        Rp {{ number_format($produk->total_modal, 0, ',', '.') }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Margin / Unit
                    </span>

                    <span class="info-value profit">
                        Rp {{ number_format(
                            $produk->harga_jual - $produk->hpp,
                            0,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>



                <div class="info-row">

                    <span class="info-label">
                        Margin %
                    </span>

                    <span class="info-value profit">

                        @php
                            $margin = $produk->harga_jual > 0
                                ? (($produk->harga_jual - $produk->hpp) / $produk->harga_jual) * 100
                                : 0;
                        @endphp

                        {{ number_format($margin, 1, ',', '.') }}%

                    </span>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================
         STATISTIK
    ========================= --}}

    <div class="stats-grid">


        <div class="stat-card">

            <div class="stat-label">
                Total Produksi
            </div>

            <div class="stat-value">

                {{ number_format(
                    $produk->produksi_sum_jumlah_produksi ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

            <div class="stat-sub">
                unit dibuat
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-label">
                Total Terjual
            </div>

            <div class="stat-value">

                {{ number_format(
                    $produk->penjualan_sum_jumlah_terjual ?? 0,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

            <div class="stat-sub">
                unit terjual
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-label">
                Stok Tersisa
            </div>

            <div class="stat-value">

                {{ number_format(
                    $produk->stok,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

            <div class="stat-sub">
                unit tersedia
            </div>

        </div>



        <div class="stat-card">

            <div class="stat-label">
                Omzet
            </div>

            <div class="stat-value">

                Rp {{ number_format(
                    ($produk->penjualan_sum_jumlah_terjual ?? 0) * $produk->harga_jual,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

            <div class="stat-sub">
                dari penjualan
            </div>

        </div>

    </div>



    {{-- =========================
         KOMPONEN PRODUK
    ========================= --}}

    <div class="section-card">


        <div class="section-header">

            <h2 class="section-title">
                Rincian Komponen Produk
            </h2>

        </div>


        @if($produk->bahan->count())


            <div class="table-wrapper">

                <table class="detail-table">


                    <thead>

                        <tr>

                            <th>
                                Komponen
                            </th>

                            <th>
                                Jumlah
                            </th>

                            <th>
                                Satuan
                            </th>

                            <th>
                                Isi Kemasan
                            </th>

                            <th>
                                Harga
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @foreach($produk->bahan as $bahan)

                            <tr>


                                <td>
                                    {{ $bahan->nama }}
                                </td>


                                <td>
                                    {{ number_format(
                                        $bahan->jumlah,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>


                                <td>
                                    {{ $bahan->satuan }}
                                </td>


                                <td>

                                    @if(
                                        $bahan->isi_kemasan !== null &&
                                        $bahan->isi_kemasan > 0
                                    )

                                        {{ number_format(
                                            $bahan->isi_kemasan,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                        pcs

                                    @else

                                        -

                                    @endif

                                </td>


                                <td>
                                    Rp {{ number_format(
                                        $bahan->harga_satuan,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>


                            </tr>

                        @endforeach


                    </tbody>

                </table>

            </div>


        @else

            <div class="empty">
                Belum ada komponen produk.
            </div>

        @endif

    </div>



    {{-- =========================
         BIAYA TAMBAHAN
    ========================= --}}

    <div class="section-card">


        <div class="section-header">

            <h2 class="section-title">
                Biaya Tambahan
            </h2>

        </div>


        @if($produk->biayaTambahan->count())


            <div class="table-wrapper">

                <table class="detail-table">


                    <thead>

                        <tr>

                            <th>
                                Nama Biaya
                            </th>

                            <th>
                                Jumlah
                            </th>

                            <th>
                                Satuan
                            </th>

                            <th>
                                Harga
                            </th>

                            <th class="number">
                                Total
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @foreach($produk->biayaTambahan as $biaya)

                            <tr>


                                <td>
                                    {{ $biaya->nama }}
                                </td>


                                <td>

                                    {{ number_format(
                                        $biaya->jumlah,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                <td>
                                    {{ $biaya->satuan }}
                                </td>


                                <td>
                                    Rp {{ number_format(
                                        $biaya->harga_satuan,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>


                                <td class="number">

                                    Rp {{ number_format(
                                        $biaya->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                            </tr>

                        @endforeach


                        <tr class="total-row">

                            <td colspan="4">
                                Total Biaya Tambahan
                            </td>

                            <td class="number">

                                Rp {{ number_format(
                                    $produk->total_biaya_tambahan,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>


        @else

            <div class="empty">
                Tidak ada biaya tambahan.
            </div>

        @endif

    </div>



    {{-- =========================
         KEUNTUNGAN
    ========================= --}}

    <div class="profit-box">


        <div class="profit-title">
            Keuntungan per Unit
        </div>


        <div class="profit-main">

            Rp {{ number_format(
                $produk->harga_jual - $produk->hpp,
                0,
                ',',
                '.'
            ) }}

        </div>


        <div class="profit-details">


            <div class="profit-detail">

                <span>
                    Harga Jual
                </span>

                <strong>
                    Rp {{ number_format(
                        $produk->harga_jual,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>



            <div class="profit-detail">

                <span>
                    HPP
                </span>

                <strong>
                    Rp {{ number_format(
                        $produk->hpp,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>



            <div class="profit-detail">

                <span>
                    Margin
                </span>

                <strong>
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

@endsection