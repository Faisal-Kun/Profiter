@extends('layouts.app')

@section('content')

<style>

    /* =========================
       FORM CARD
    ========================= */

    .form-card {
        background: #17191f;
        border: 1px solid #272a33;
        border-radius: 16px;
        overflow: hidden;
        color: #fff;
    }

    .form-card .card-body {
        padding: 24px;
    }

    .section-title {
        color: #fff;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: #858994;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .form-label {
        color: #c9ccd4;
        font-weight: 600;
        font-size: 13px;
    }


    /* =========================
       INPUT
    ========================= */

    .form-control,
    .form-select {
        background: #11141b;
        border: 1px solid #353945;
        color: #fff;
        border-radius: 9px;
        padding: 11px 13px;
    }

    .form-control::placeholder {
        color: #626875;
    }

    .form-control:focus,
    .form-select:focus {
        background: #11141b;
        color: #fff;
        border-color: #22d3ee;
        box-shadow: 0 0 0 3px rgba(34, 211, 238, .10);
    }

    .form-select option {
        background: #17191f;
        color: #fff;
    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {
        background: #20232b;
        border-color: #353945;
        color: #22d3ee;
        font-weight: 600;
    }


    /* =========================
       RESULT BOX
    ========================= */

    .result-box {
        background: #11141b;
        border: 1px solid #272a33;
        border-radius: 12px;
        padding: 20px;
    }

    .result-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        color: #b8bdc8;
    }

    .result-row strong {
        color: #fff;
    }

    .result-final {
        border-top: 1px solid #353945;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 19px;
        font-weight: 700;
    }

    .cyan {
        color: #22d3ee !important;
    }


    /* =========================
       BUTTON
    ========================= */

    .btn-warning {
        background: #22d3ee !important;
        border-color: #22d3ee !important;
        color: #061014 !important;
        font-weight: 600;
    }

    .btn-warning:hover {
        background: #67e8f9 !important;
        border-color: #67e8f9 !important;
        color: #061014 !important;
    }


    /* =========================
       SECONDARY
    ========================= */

    .btn-secondary {
        background: #20232b;
        border: 1px solid #353945;
        color: #c9ccd4;
    }

    .btn-secondary:hover {
        background: #292e38;
        border-color: #454b59;
        color: #fff;
    }


    /* =========================
       INFO BOX
    ========================= */

    .info-box {
        background: #11141b;
        border: 1px solid #272a33;
        border-radius: 12px;
        padding: 20px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .form-card .card-body {
            padding: 18px;
        }

    }

</style>


{{-- =========================
     HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3>
            Tambah Produksi
        </h3>
        <p class="mb-0" style="color: #fff !important;">
     Tambahkan data produksi baru
</p>

    </div>


    <a
        href="/produksi"
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>


<form
    action="/produksi"
    method="POST"
>

    @csrf


    {{-- ERROR --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Data belum bisa disimpan:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================
         INFORMASI PRODUKSI
    ========================= --}}

    <div class="card form-card mb-4">

        <div class="card-body">

            <h5 class="section-title">
                Informasi Produksi
            </h5>

            <p class="section-subtitle">
                Masukkan informasi produksi yang dilakukan
            </p>


            <div class="row g-3">


                {{-- TANGGAL --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Tanggal Produksi
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        required
                    >

                </div>


                {{-- PRODUK --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Produk
                    </label>

                    <select
                        name="produk_id"
                        id="produkSelect"
                        class="form-select"
                        required
                    >

                        <option
                            value=""
                            disabled
                            selected
                        >
                            Pilih Produk
                        </option>


                        @foreach($produks as $produk)

                            <option
                                value="{{ $produk->id }}"
                                data-harga="{{ $produk->harga_jual }}"
                                data-hpp="{{ $produk->hpp }}"
                                data-modal="{{ $produk->total_modal }}"
                                {{ old('produk_id') == $produk->id ? 'selected' : '' }}
                            >

                                {{ $produk->nama }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- JUMLAH --}}

                <div class="col-md-6">

                    <label class="form-label">
                        Jumlah Produksi
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            name="jumlah_produksi"
                            id="jumlahProduksi"
                            class="form-control"
                            placeholder=""
                            min="1"
                            value="{{ old('jumlah_produksi') }}"
                            required
                        >

                        <span class="input-group-text">
                            produk
                        </span>

                    </div>

                </div>


                {{-- CATATAN --}}

                <div class="col-12">

                    <label class="form-label">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"
                        placeholder=""
                    >{{ old('catatan') }}</textarea>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         INFORMASI PRODUK
    ========================= --}}

    <div
        class="card form-card mb-4"
        id="informasiProduk"
        style="display:none;"
    >

        <div class="card-body">

            <h5 class="section-title">
                Informasi Produk
            </h5>

            <p class="section-subtitle">
                Informasi harga dan modal produk yang dipilih
            </p>


            <div class="result-box">


                <div class="result-row">

                    <span>
                        Harga Jual / Produk
                    </span>

                    <strong id="hargaJual">
                        Rp0
                    </strong>

                </div>


                <div class="result-row">

                    <span>
                        HPP / Produk
                    </span>

                    <strong
                        id="hppProduk"
                        class="cyan"
                    >
                        Rp0
                    </strong>

                </div>


                <div class="result-row">

                    <span>
                        Modal Produksi Sebelumnya
                    </span>

                    <strong id="modalProduk">
                        Rp0
                    </strong>

                </div>


                <div class="result-row result-final">

                    <span>
                        Estimasi Modal Produksi
                    </span>

                    <strong
                        id="estimasiModal"
                        class="cyan"
                    >
                        Rp0
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         BUTTON
    ========================= --}}

    <div class="d-flex justify-content-end gap-2 mb-5">

        <a
            href="/produksi"
            class="btn btn-secondary"
        >
            Batal
        </a>


        <button
            type="submit"
            class="btn btn-warning px-4"
        >

            <i class="bi bi-check-circle"></i>

            Simpan Produksi

        </button>

    </div>

</form>


<script>

function rupiah(angka)
{
    return new Intl.NumberFormat('id-ID', {

        style: 'currency',

        currency: 'IDR',

        maximumFractionDigits: 0

    }).format(angka);
}


/* =========================
   UPDATE PRODUK
========================= */

function updateProduk()
{

    const select =
        document.getElementById('produkSelect');

    const option =
        select.options[select.selectedIndex];


    if (!option || !option.value) {

        document
            .getElementById('informasiProduk')
            .style.display = 'none';

        return;
    }


    const harga =
        parseFloat(option.dataset.harga) || 0;

    const hpp =
        parseFloat(option.dataset.hpp) || 0;

    const modal =
        parseFloat(option.dataset.modal) || 0;


    document
        .getElementById('hargaJual')
        .innerText = rupiah(harga);


    document
        .getElementById('hppProduk')
        .innerText = rupiah(hpp);


    document
        .getElementById('modalProduk')
        .innerText = rupiah(modal);


    hitungModal(hpp);


    document
        .getElementById('informasiProduk')
        .style.display = 'block';

}


/* =========================
   HITUNG MODAL
========================= */

function hitungModal(hpp)
{

    const jumlah =
        parseFloat(
            document
                .getElementById('jumlahProduksi')
                .value
        ) || 0;


    const estimasi =
        hpp * jumlah;


    document
        .getElementById('estimasiModal')
        .innerText = rupiah(estimasi);

}


/* =========================
   EVENT
========================= */

document
    .getElementById('produkSelect')
    .addEventListener('change', updateProduk);


document
    .getElementById('jumlahProduksi')
    .addEventListener('input', function() {

        const select =
            document.getElementById('produkSelect');

        const option =
            select.options[select.selectedIndex];


        if (!option || !option.value) {
            return;
        }


        const hpp =
            parseFloat(option.dataset.hpp) || 0;


        hitungModal(hpp);

    });


/* =========================
   LOAD
========================= */

document.addEventListener(
    'DOMContentLoaded',
    function() {

        updateProduk();

    }
);

</script>

@endsection