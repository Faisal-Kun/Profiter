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
       CARD
    ========================= */

    .edit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .card-section-title {
        color: var(--text);
        font-weight: 600;
    }


    /* =========================
       FORM
    ========================= */

    .form-label {
        color: var(--text);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select,
    textarea.form-control {

        background: #111821;

        border: 1px solid var(--border);

        color: var(--text);

        border-radius: 10px;

        padding: 10px 12px;

        transition: .2s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea.form-control:focus {

        background: #111821;

        border-color: var(--primary);

        color: var(--text);

        box-shadow: 0 0 0 3px var(--primary-soft);
    }

    .form-control::placeholder,
    textarea.form-control::placeholder {
        color: #667386;
    }

    .form-select option {
        background: var(--card);
        color: var(--text);
    }


    input[type="date"] {
        color-scheme: dark;
    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {

        background: #111821;

        border: 1px solid var(--border);

        color: var(--muted);

        font-weight: 500;
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


    .btn-secondary-custom {

        background: var(--card);

        border: 1px solid #354154;

        color: var(--muted);

        font-weight: 500;

        border-radius: 10px;

        transition: .2s ease;
    }

    .btn-secondary-custom:hover {

        background: var(--card-hover);

        border-color: var(--primary);

        color: var(--primary-hover);
    }


    /* =========================
       INFO BOX
    ========================= */

    .info-box {

        background: #111821;

        border: 1px solid var(--border);

        border-radius: 12px;

        padding: 16px;
    }

    .info-icon {

        width: 38px;
        height: 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: var(--primary-soft);

        color: var(--primary-hover);

        border-radius: 10px;

        flex-shrink: 0;
    }


    /* =========================
       MOBILE
    ========================= */

    @media(max-width:768px) {

        .page-title {
            font-size: 24px;
        }

        .page-subtitle {
            font-size: 13px;
        }

    }

</style>


{{-- =========================
HEADER
========================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="page-title">

            Edit Produksi

        </h3>

        <p class="page-subtitle mb-0">

            Ubah data produksi

        </p>

    </div>


    <a
        href="/produksi/detail/{{ $produksi->id }}"
        class="btn btn-secondary-custom"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>


{{-- =========================
ERROR
========================= --}}

@if($errors->any())

    <div class="alert alert-danger mb-4">

        <strong>Data belum bisa disimpan:</strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- =========================
FORM
========================= --}}

<div class="edit-card">

    <div class="p-4">

        <h5 class="card-section-title mb-1">

            Informasi Produksi

        </h5>

        <p
            class="mb-4"
            style="color:var(--muted); font-size:13px;"
        >

            Perbarui informasi produksi yang sudah dicatat.

        </p>


        <form
            action="/produksi/{{ $produksi->id }}"
            method="POST"
        >

            @csrf

            @method('PUT')


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
                        value="{{ old('tanggal', $produksi->tanggal) }}"
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
                        class="form-select"
                        required
                    >

                        <option value="" disabled>

                            Pilih Produk

                        </option>


                        @foreach($produks as $produk)

                            <option
                                value="{{ $produk->id }}"
                                {{ old('produk_id', $produksi->produk_id) == $produk->id ? 'selected' : '' }}
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
                            class="form-control"
                            min="1"
                            step="1"
                            value="{{ old('jumlah_produksi', $produksi->jumlah_produksi) }}"
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
                        placeholder="Tambahkan catatan jika diperlukan"
                    >{{ old('catatan', $produksi->catatan) }}</textarea>

                </div>

            </div>


            {{-- =========================
            INFO
            ========================= --}}

            <div class="info-box mt-4">

                <div class="d-flex align-items-start gap-3">

                    <div class="info-icon">

                        <i class="bi bi-info-circle"></i>

                    </div>

                    <div>

                        <div
                            style="
                                color:var(--text);
                                font-size:13px;
                                font-weight:600;
                            "
                        >

                            Perubahan Jumlah Produksi

                        </div>

                        <div
                            style="
                                color:var(--muted);
                                font-size:12px;
                                margin-top:3px;
                            "
                        >

                            Pastikan jumlah produksi sesuai dengan
                            data produksi sebenarnya.

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
            BUTTON
            ========================= --}}

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="/produksi/detail/{{ $produksi->id }}"
                    class="btn btn-secondary-custom"
                >

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-primary-custom px-4"
                >

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection