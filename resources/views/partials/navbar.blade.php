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

        {{-- USER LOGIN --}}

        <div class="topbar-user">

            <div class="topbar-user-icon">
                <i class="bi bi-person-fill"></i>
            </div>

            <div class="topbar-user-info">

                <span class="topbar-user-label">
                    Login sebagai
                </span>

                <span class="topbar-user-name">
                    {{ auth()->user()->name }}
                </span>

            </div>

        </div>


        {{-- TANGGAL --}}

        <div class="topbar-date">

            <i class="bi bi-calendar3 me-2"></i>

            {{ now()->translatedFormat('d F Y') }}

        </div>


        {{-- LOGOUT --}}

        <form action="{{ route('logout') }}"
              method="POST"
              class="logout-form"
              onsubmit="return confirm('Yakin ingin logout?')">

            @csrf

            <button type="submit" class="logout-btn">

                <i class="bi bi-box-arrow-right"></i>

                <span>Logout</span>

            </button>

        </form>

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

        gap: 10px;

    }


    /* =========================
       USER
    ========================= */

    .topbar-user {

        display: flex;

        align-items: center;

        gap: 9px;

        padding: 6px 11px;

        border: 1px solid #272a33;

        border-radius: 9px;

        background: #17191f;

        transition: .2s ease;

    }


    .topbar-user:hover {

        border-color: #22d3ee;

    }


    /* USER ICON */

    .topbar-user-icon {

        width: 30px;

        height: 30px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 8px;

        background: rgba(34, 211, 238, .10);

        border: 1px solid rgba(34, 211, 238, .15);

        color: #22d3ee;

        font-size: 14px;

    }


    /* USER INFO */

    .topbar-user-info {

        display: flex;

        flex-direction: column;

        line-height: 1.2;

    }


    .topbar-user-label {

        color: #686f7d;

        font-size: 9px;

        margin-bottom: 2px;

    }


    .topbar-user-name {

        max-width: 130px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        color: #e7ebf0;

        font-size: 12px;

        font-weight: 600;

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

        transition: .2s ease;

    }


    .topbar-date i {

        color: #22d3ee;

    }


    .topbar-date:hover {

        border-color: #22d3ee;

        color: #b8bdc8;

    }


    /* =========================
       LOGOUT
    ========================= */

    .logout-form {

        margin: 0;

    }


    .logout-btn {

        height: 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 0 13px;

        border: 1px solid #272a33;

        border-radius: 9px;

        background: #17191f;

        color: #858994;

        font-size: 13px;

        font-weight: 500;

        cursor: pointer;

        transition: .2s ease;

    }


    .logout-btn i {

        font-size: 15px;

    }


    .logout-btn:hover {

        border-color: rgba(248, 113, 113, .35);

        background: rgba(248, 113, 113, .08);

        color: #f87171;

    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 900px) {

        .topbar-user-info {

            display: none;

        }

        .topbar-user {

            padding: 4px;

        }

        .topbar-user-icon {

            width: 32px;

            height: 32px;

        }

    }


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


        .logout-btn {

            width: 36px;

            height: 36px;

            padding: 0;

        }


        .logout-btn span {

            display: none;

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