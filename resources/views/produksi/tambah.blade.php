@extends('layouts.app')

@section('content')

<style>

    .form-card {
        border: none;
        border-radius: 15px;
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .section-subtitle {
        color: #888;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 9px 0;
    }

    .info-final {
        border-top: 1px solid #ddd;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 18px;
        font-weight: 700;
    }

</style>


{{-- ============================= --}}
{{-- HEADER --}}
{{-- ============================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3>
            Tambah Produksi
        </h3>

        <p class="text-muted mb-0">
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



{{-- ============================= --}}
{{-- FORM --}}
{{-- ============================= --}}

<form
    action="/produksi"
    method="POST"
>

    @csrf


    {{-- ============================= --}}
    {{-- INFORMASI PRODUKSI --}}
    {{-- ============================= --}}

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
                            selected
                            disabled
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



                {{-- JUMLAH PRODUKSI --}}

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
                            placeholder="Contoh: 30"
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
                        placeholder="Contoh: Produksi pagi, 30 cup..."
                    >{{ old('catatan') }}</textarea>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================= --}}
    {{-- INFORMASI PRODUK --}}
    {{-- ============================= --}}

    <div
        class="card form-card mb-4"
        id="informasiProduk"
        style="display: none;"
    >

        <div class="card-body">

            <h5 class="section-title">
                Informasi Produk
            </h5>

            <p class="section-subtitle">
                Informasi harga dari produk yang dipilih
            </p>


            <div class="info-box">


                {{-- HARGA JUAL --}}

                <div class="info-row">

                    <span>
                        Harga Jual / Produk
                    </span>

                    <strong id="hargaJual">
                        Rp0
                    </strong>

                </div>



                {{-- HPP --}}

                <div class="info-row">

                    <span>
                        HPP / Produk
                    </span>

                    <strong
                        id="hppProduk"
                        class="text-warning"
                    >
                        Rp0
                    </strong>

                </div>



                {{-- MODAL --}}

                <div class="info-row">

                    <span>
                        Modal Produksi Sebelumnya
                    </span>

                    <strong id="modalProduk">
                        Rp0
                    </strong>

                </div>



                {{-- JUMLAH --}}

                <div class="info-row info-final">

                    <span>
                        Estimasi Modal Produksi
                    </span>

                    <strong
                        id="estimasiModal"
                        class="text-warning"
                    >
                        Rp0
                    </strong>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================= --}}
    {{-- TOMBOL --}}
    {{-- ============================= --}}

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

/*
|--------------------------------------------------------------------------
| FORMAT RUPIAH
|--------------------------------------------------------------------------
*/

function rupiah(angka)
{
    return new Intl.NumberFormat(
        'id-ID',
        {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }
    ).format(angka);
}



/*
|--------------------------------------------------------------------------
| UPDATE INFORMASI PRODUK
|--------------------------------------------------------------------------
*/

function updateProduk()
{

    const select =
        document.getElementById('produkSelect');

    const option =
        select.options[select.selectedIndex];


    if (!option || !option.value)
    {

        document
            .getElementById('informasiProduk')
            .style.display = 'none';

        return;

    }


    const harga =
        parseFloat(
            option.dataset.harga
        ) || 0;


    const hpp =
        parseFloat(
            option.dataset.hpp
        ) || 0;


    const modal =
        parseFloat(
            option.dataset.modal
        ) || 0;


    document
        .getElementById('hargaJual')
        .innerText =
        rupiah(harga);


    document
        .getElementById('hppProduk')
        .innerText =
        rupiah(hpp);


    document
        .getElementById('modalProduk')
        .innerText =
        rupiah(modal);


    hitungModal(hpp);


    document
        .getElementById('informasiProduk')
        .style.display = 'block';

}



/*
|--------------------------------------------------------------------------
| HITUNG ESTIMASI MODAL
|--------------------------------------------------------------------------
*/

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
        .innerText =
        rupiah(estimasi);

}



/*
|--------------------------------------------------------------------------
| EVENT PRODUK
|--------------------------------------------------------------------------
*/

document
    .getElementById('produkSelect')
    .addEventListener(
        'change',
        function()
        {

            updateProduk();

        }
    );



/*
|--------------------------------------------------------------------------
| EVENT JUMLAH
|--------------------------------------------------------------------------
*/

document
    .getElementById('jumlahProduksi')
    .addEventListener(
        'input',
        function()
        {

            const select =
                document.getElementById('produkSelect');

            const option =
                select.options[select.selectedIndex];


            if (!option || !option.value)
            {
                return;
            }


            const hpp =
                parseFloat(
                    option.dataset.hpp
                ) || 0;


            hitungModal(hpp);

        }
    );



/*
|--------------------------------------------------------------------------
| JALANKAN JIKA ADA OLD VALUE
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function()
    {

        updateProduk();

    }
);

</script>

@endsection