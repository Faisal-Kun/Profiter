<div class="topbar">

    {{-- JUDUL HALAMAN --}}

    <div class="topbar-left">

        <div class="topbar-icon">

            @if(request()->is('/'))
                <i class="bi bi-grid-1x2"></i>

            @elseif(request()->is('produk*'))
                <i class="bi bi-box-seam"></i>

            @elseif(request()->is('produksi*'))
                <i class="bi bi-gear"></i>

            @elseif(request()->is('penjualan*'))
                <i class="bi bi-cart-check"></i>

            @elseif(request()->is('pengeluaran*'))
                <i class="bi bi-wallet2"></i>

            @elseif(request()->is('laporan*'))
                <i class="bi bi-bar-chart"></i>

            @else
                <i class="bi bi-grid"></i>
            @endif

        </div>


        <div>

            <h5 class="topbar-title mb-0">

                @if(request()->is('/'))
                    Dashboard

                @elseif(request()->is('produk/tambah'))
                    Tambah Produk

                @elseif(request()->is('produk/detail/*'))
                    Detail Produk

                @elseif(request()->is('produk/edit/*'))
                    Edit Produk

                @elseif(request()->is('produk'))
                    Produk

                @elseif(request()->is('produksi/tambah'))
                    Tambah Produksi

                @elseif(request()->is('produksi/detail/*'))
                    Detail Produksi

                @elseif(request()->is('produksi/edit/*'))
                    Edit Produksi

                @elseif(request()->is('produksi'))
                    Produksi

                @elseif(request()->is('penjualan/tambah'))
                    Tambah Penjualan

                @elseif(request()->is('penjualan/detail/*'))
                    Detail Penjualan

                @elseif(request()->is('penjualan/edit/*'))
                    Edit Penjualan

                @elseif(request()->is('penjualan'))
                    Penjualan

                @elseif(request()->is('pengeluaran/tambah'))
                    Tambah Pengeluaran

                @elseif(request()->is('pengeluaran'))
                    Pengeluaran

                @elseif(request()->is('laporan'))
                    Laporan

                @else
                    ProfitKu
                @endif

            </h5>

            <span class="topbar-subtitle">
                Kelola usaha dengan lebih mudah
            </span>

        </div>

    </div>


    {{-- KANAN --}}

    <div class="topbar-right">

        <div class="topbar-date">

            <i class="bi bi-calendar3 me-2"></i>

            {{ now()->translatedFormat('d F Y') }}

        </div>

    </div>

</div>


<style>

    /* =========================
       TOPBAR
    ========================= */

    .topbar {

        height: 76px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 0 30px;

        background: #11141b;

        border-bottom: 1px solid #242832;

    }


    /* =========================
       LEFT
    ========================= */

    .topbar-left {

        display: flex;

        align-items: center;

        gap: 13px;

    }


    /* =========================
       ICON
    ========================= */

    .topbar-icon {

        width: 40px;

        height: 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 11px;

        background: rgba(34, 211, 238, .10);

        border: 1px solid rgba(34, 211, 238, .15);

        color: #22d3ee;

        font-size: 18px;

    }


    /* =========================
       TITLE
    ========================= */

    .topbar-title {

        color: #ffffff;

        font-size: 18px;

        font-weight: 650;

        line-height: 1.2;

    }


    /* =========================
       SUBTITLE
    ========================= */

    .topbar-subtitle {

        display: block;

        margin-top: 3px;

        color: #858994;

        font-size: 12px;

    }


    /* =========================
       RIGHT
    ========================= */

    .topbar-right {

        display: flex;

        align-items: center;

    }


    /* =========================
       DATE
    ========================= */

    .topbar-date {

        display: flex;

        align-items: center;

        padding: 8px 12px;

        border: 1px solid #272a33;

        border-radius: 9px;

        color: #858994;

        background: #17191f;

        font-size: 13px;

    }


    .topbar-date i {

        color: #22d3ee;

    }


    /* =========================
       HOVER
    ========================= */

    .topbar-date:hover {

        border-color: #22d3ee;

        color: #b8bdc8;

        transition: .2s ease;

    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .topbar {

            height: 70px;

            padding: 0 18px;

        }

        .topbar-subtitle {

            display: none;

        }

        .topbar-title {

            font-size: 16px;

        }

        .topbar-date {

            font-size: 12px;

            padding: 7px 9px;

        }

    }


    @media (max-width: 576px) {

        .topbar {

            padding: 0 15px;

        }

        .topbar-date {

            display: none;

        }

    }

</style>

