@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

    :root {
        --card: #151b24;
        --card-hover: #1a2230;
        --border: #273342;

        --primary: #3b82f6;
        --primary-hover: #60a5fa;
        --primary-soft: rgba(59,130,246,.10);

        --text: #f5f7fa;
        --muted: #8995a8;
    }


    /* =========================
       HEADER
    ========================= */

    .edit-title {
        color: var(--text);
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 5px;
    }

    .edit-subtitle {
        color: var(--muted);
        font-size: 14px;
    }


    /* =========================
       CARD
    ========================= */

    .edit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
    }

    .edit-card-body {
        padding: 28px;
    }

    .edit-section-title {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 24px;
    }


    /* =========================
       LABEL
    ========================= */

    .form-label {
        color: var(--muted);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }


    /* =========================
       INPUT
    ========================= */

    .form-control,
    .form-select {
        background: #1a2230;
        border: 1px solid #293647;
        color: var(--text);
        border-radius: 10px;
        padding: 11px 13px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #1a2230;
        border-color: var(--primary);
        color: var(--text);
        box-shadow: 0 0 0 .2rem var(--primary-soft);
    }

    .form-control::placeholder {
        color: #526176;
    }


    /* =========================
       SELECT
    ========================= */

    .form-select {
        cursor: pointer;
    }

    .form-select option {
        background: #151b24;
        color: var(--text);
    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {
        background: #17243a;
        border: 1px solid #293647;
        color: #60a5fa;
        font-weight: 700;
        border-radius: 10px 0 0 10px;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }


    /* =========================
       BUTTON PRIMARY
    ========================= */

    .btn-save {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 16px;
        transition: .2s;
    }

    .btn-save:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-1px);
    }


    /* =========================
       BUTTON BACK
    ========================= */

    .btn-back {
        background: #151b24;
        border: 1px solid #354154;
        color: var(--muted);
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 16px;
        transition: .2s;
    }

    .btn-back:hover {
        background: #1a2230;
        border-color: var(--primary);
        color: var(--primary-hover);
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .edit-title {
            font-size: 24px;
        }

        .edit-card-body {
            padding: 20px;
        }

        .d-flex.justify-content-between.align-items-center.mb-4 {
            align-items: flex-start !important;
            gap: 15px;
        }

    }

    @media (max-width: 500px) {

        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
        }

        .d-flex.justify-content-between.align-items-center.mb-4 .btn-back {
            width: 100%;
        }

    }

</style>


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="edit-title">
            Edit Produk
        </h3>

        <p class="edit-subtitle mb-0">
            Ubah informasi produk
        </p>

    </div>


    <a
        href="/produk/detail/{{ $produk->id }}"
        class="btn btn-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>



{{-- =========================
FORM
========================= --}}

<form
    action="/produk/{{ $produk->id }}"
    method="POST"
>

    @csrf

    @method('PUT')


    <div class="edit-card">

        <div class="edit-card-body">


            <h5 class="edit-section-title">
                Informasi Produk
            </h5>


            {{-- =========================
            NAMA PRODUK
            ========================= --}}

            <div class="mb-4">

                <label class="form-label">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ $produk->nama }}"
                    required
                >

            </div>


          {{-- KATEGORI --}}

<div class="mb-4">

    <label class="form-label">
        Kategori
    </label>

    <input
        type="text"
        name="kategori"
        class="form-control"
        list="kategoriList"
        value="{{ $produk->kategori }}"
        placeholder="Pilih atau ketik kategori..."
        required
    >

    <datalist id="kategoriList">

        <option value="Makanan">
        <option value="Minuman">
        <option value="Cemilan">
        <option value="Lainnya">

    </datalist>

</div>


            {{-- =========================
            HARGA
            ========================= --}}

            <div class="mb-4">

                <label class="form-label">
                    Harga Jual
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_jual"
                        class="form-control"
                        value="{{ $produk->harga_jual }}"
                        min="0"
                        required
                    >

                </div>

            </div>


            {{-- =========================
            BUTTON
            ========================= --}}

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="/produk/detail/{{ $produk->id }}"
                    class="btn btn-back"
                >

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-save"
                >

                    <i class="bi bi-check-circle me-1"></i>

                    Simpan Perubahan

                </button>

            </div>


        </div>

    </div>

</form>


@endsection