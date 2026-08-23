@extends('layouts.app')

@section('content')

<style>

    /* =========================
       COLOR SYSTEM
    ========================= */

    :root {
        --bg-main: #0d1117;

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
       FORM CARD
    ========================= */

    .edit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }


    /* =========================
       CARD TITLE
    ========================= */

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

        transition: all .2s ease;
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


    /* SELECT */

    .form-select {

        color: var(--text);

    }

    .form-select option {

        background: #151b24;
        color: var(--text);

    }


    /* DATE INPUT */

    input[type="date"] {

        color-scheme: dark;

    }


    /* =========================
       BUTTON PRIMARY
    ========================= */

    .btn-warning {

        background: var(--primary);

        border: 1px solid var(--primary);

        color: #fff;

        font-weight: 600;

        border-radius: 10px;

        transition: all .2s ease;
    }


    .btn-warning:hover {

        background: var(--primary-hover);

        border-color: var(--primary-hover);

        color: #fff;

        transform: translateY(-1px);

    }


    /* =========================
       BUTTON SECONDARY
    ========================= */

    .btn-secondary {

        background: #151b24;

        border: 1px solid #353f4d;

        color: var(--muted);

        font-weight: 500;

        border-radius: 10px;

        transition: all .2s ease;
    }


    .btn-secondary:hover {

        background: #1a2230;

        border-color: var(--primary);

        color: var(--primary);

    }


    /* =========================
       INPUT GROUP
    ========================= */

    .input-group-text {

        background: #111821;

        border: 1px solid var(--border);

        color: var(--muted);

    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width: 768px) {

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
        class="btn btn-secondary"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>



{{-- =========================
FORM
========================= --}}

<div class="edit-card">

    <div class="card-body p-4">

        <h5 class="card-section-title mb-4">

            Informasi Produksi

        </h5>


        <form
            action="/produksi/{{ $produksi->id }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- =========================
            TANGGAL
            ========================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Tanggal Produksi

                </label>


                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ $produksi->tanggal }}"
                    required
                >

            </div>



            {{-- =========================
            PRODUK
            ========================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Produk

                </label>


                <select
                    name="produk_id"
                    class="form-select"
                    required
                >

                    <option
                        value=""
                        disabled
                    >

                        Pilih Produk

                    </option>


                    @foreach($produks as $produk)

                        <option
                            value="{{ $produk->id }}"
                            {{ $produksi->produk_id == $produk->id ? 'selected' : '' }}
                        >

                            {{ $produk->nama }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- =========================
            JUMLAH
            ========================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Jumlah Produksi

                </label>


                <input
                    type="number"
                    name="jumlah_produksi"
                    class="form-control"
                    min="1"
                    value="{{ $produksi->jumlah_produksi }}"
                    required
                >

            </div>



            {{-- =========================
            CATATAN
            ========================= --}}

            <div class="mb-4">

                <label class="form-label">

                    Catatan

                </label>


                <textarea
                    name="catatan"
                    class="form-control"
                    rows="4"
                    placeholder="Tambahkan catatan jika diperlukan"
                >{{ $produksi->catatan }}</textarea>

            </div>



            {{-- =========================
            BUTTON
            ========================= --}}

            <div class="d-flex justify-content-end gap-2">


                <a
                    href="/produksi/detail/{{ $produksi->id }}"
                    class="btn btn-secondary"
                >

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-warning"
                >

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

                </button>


            </div>


        </form>

    </div>

</div>

@endsection