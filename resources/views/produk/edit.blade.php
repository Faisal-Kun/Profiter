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
        --danger: #ef4444;
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
        margin-bottom: 20px;
    }

    .edit-card-body {
        padding: 28px;
    }

    .edit-section-title {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 22px;
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

    .form-control[type="file"] {
        padding: 9px 13px;
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
       HARGA
    ========================= */

    .price-input-group {
        width: 100%;
    }

    .price-input-group .form-control {
        min-width: 0;
        font-size: 15px;
        font-weight: 600;
    }


    /* =========================
       ITEM CARD
    ========================= */

    .item-card {
        background: #111720;
        border: 1px solid #273342;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 14px;
    }

    .item-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .item-title {
        color: var(--text);
        font-weight: 700;
        font-size: 14px;
        margin: 0;
    }


    /* =========================
       BUTTON REMOVE
    ========================= */

    .btn-remove {
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.25);
        color: #f87171;
        border-radius: 8px;
        padding: 7px 10px;
        transition: .2s;
    }

    .btn-remove:hover {
        background: rgba(239,68,68,.15);
        color: #fca5a5;
    }


    /* =========================
       ADD BUTTON
    ========================= */

    .btn-add {
        background: transparent;
        border: 1px dashed #3b82f6;
        color: #60a5fa;
        border-radius: 10px;
        padding: 10px 15px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-add:hover {
        background: var(--primary-soft);
        color: #93c5fd;
    }


    /* =========================
       BUTTON SAVE
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
       IMAGE
    ========================= */

    .current-image {
        margin-top: 12px;
    }

    .current-image img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .image-note {
        color: var(--muted);
        font-size: 12px;
        margin-top: 7px;
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
            Ubah informasi, komponen, dan biaya tambahan produk
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


<form
    action="/produk/{{ $produk->id }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    @method('PUT')


    {{-- =========================
    INFORMASI PRODUK
    ========================= --}}

    <div class="edit-card">

        <div class="edit-card-body">

            <h5 class="edit-section-title">
                Informasi Produk
            </h5>


            {{-- NAMA --}}

            <div class="mb-4">

                <label class="form-label">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $produk->nama) }}"
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
                    value="{{ old('kategori', $produk->kategori) }}"
                    placeholder="Pilih atau ketik kategori..."
                    required
                >

                <datalist id="kategoriList">

                    <option value="Makanan">
                    <option value="Minuman">
                    <option value="Cemilan">
                    <option value="Fashion">
                    <option value="Aksesoris">
                    <option value="Elektronik">
                    <option value="Lainnya">

                </datalist>

            </div>


            {{-- HARGA JUAL --}}

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
                        value="{{ old('harga_jual', $produk->harga_jual) }}"
                        min="0"
                        required
                    >

                </div>

            </div>


            {{-- GAMBAR --}}

            <div>

                <label class="form-label">
                    Gambar Produk
                </label>

                <input
                    type="file"
                    name="gambar"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                @if($produk->gambar)

                    <div class="current-image">

                        <img
                            src="{{ asset('storage/' . $produk->gambar) }}"
                            alt="{{ $produk->nama }}"
                        >

                        <div class="image-note">
                            Pilih gambar baru jika ingin mengganti gambar produk.
                        </div>

                    </div>

                @else

                    <div class="image-note">
                        Belum ada gambar produk.
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================
    KOMPONEN PRODUK
    ========================= --}}

    <div class="edit-card">

        <div class="edit-card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="edit-section-title mb-0">
                    Komponen Produk
                </h5>

                <button
                    type="button"
                    class="btn btn-add"
                    onclick="tambahBahan()"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Komponen
                </button>

            </div>


            <div id="bahan-container">

                @forelse($produk->bahan as $bahan)

                    <div class="item-card bahan-item">

                        <div class="item-header">

                            <p class="item-title">
                                Komponen
                            </p>

                            <button
                                type="button"
                                class="btn btn-remove"
                                onclick="hapusItem(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>


                        <input
                            type="hidden"
                            name="bahan_id[]"
                            value="{{ $bahan->id }}"
                        >


                        <div class="row g-3">


                            {{-- NAMA --}}

                            <div class="col-md-3">

                                <label class="form-label">
                                    Nama Komponen
                                </label>

                                <input
                                    type="text"
                                    name="bahan_nama[]"
                                    class="form-control"
                                    value="{{ old('bahan_nama.' . $loop->index, $bahan->nama) }}"
                                    placeholder="Contoh: Tepung / Kayu / Kain"
                                    required
                                >

                            </div>


                            {{-- DIGUNAKAN --}}

                            <div class="col-md-2">

                                <label class="form-label">
                                    Digunakan
                                </label>

                                <input
                                    type="number"
                                    name="bahan_jumlah[]"
                                    class="form-control"
                                    value="{{ old('bahan_jumlah.' . $loop->index, rtrim(rtrim($bahan->jumlah, '0'), '.')) }}"
                                    min="0"
                                    step="1"
                                    required
                                >

                            </div>


                            {{-- SATUAN --}}

                            <div class="col-md-2">

                                <label class="form-label">
                                    Satuan
                                </label>

                                <input
                                    type="text"
                                    name="bahan_satuan[]"
                                    class="form-control"
                                    value="{{ old('bahan_satuan.' . $loop->index, $bahan->satuan) }}"
                                    placeholder="Contoh: kg"
                                    required
                                >

                            </div>


                            {{-- ISI KEMASAN --}}

                            <div class="col-md-2">

                                <label class="form-label">
                                    Isi Kemasan
                                </label>

<input
    type="number"
    name="bahan_isi[]"
    class="form-control"
    min="1"
    value="{{ $bahan->isi_kemasan }}"
    placeholder="Opsional"
>

                            </div>


                            {{-- HARGA --}}

                            <div class="col-md-3">

                                <label class="form-label">
                                    Harga
                                </label>

                                <div class="input-group price-input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="bahan_harga[]"
                                        class="form-control"
                                        value="{{ old('bahan_harga.' . $loop->index, $bahan->harga_satuan) }}"
                                        min="0"
                                        step="1"
                                        required
                                    >

                                </div>

                            </div>


                        </div>

                    </div>

                @empty

                    <div id="empty-bahan" class="text-center py-3">

                        <span style="color: var(--muted); font-size: 14px;">
                            Belum ada komponen.
                        </span>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================
    BIAYA TAMBAHAN
    ========================= --}}

    <div class="edit-card">

        <div class="edit-card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="edit-section-title mb-0">
                    Biaya Tambahan
                </h5>

                <button
                    type="button"
                    class="btn btn-add"
                    onclick="tambahBiaya()"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Biaya
                </button>

            </div>


            <div id="biaya-container">

                @forelse($produk->biayaTambahan as $biaya)

                    <div class="item-card biaya-item">

                        <div class="item-header">

                            <p class="item-title">
                                Biaya Tambahan
                            </p>

                            <button
                                type="button"
                                class="btn btn-remove"
                                onclick="hapusItem(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>


                        <input
                            type="hidden"
                            name="biaya_id[]"
                            value="{{ $biaya->id }}"
                        >


                        <div class="row g-3">


                            {{-- NAMA --}}

                            <div class="col-md-5">

                                <label class="form-label">
                                    Nama Biaya
                                </label>

                                <input
                                    type="text"
                                    name="biaya_nama[]"
                                    class="form-control"
                                    value="{{ old('biaya_nama.' . $loop->index, $biaya->nama) }}"
                                    placeholder="Contoh: Gas"
                                >

                            </div>


                            {{-- JUMLAH --}}

                            <div class="col-md-2">

                                <label class="form-label">
                                    Jumlah
                                </label>

                                <input
                                    type="number"
                                    name="biaya_jumlah[]"
                                    class="form-control"
                                    value="{{ old('biaya_jumlah.' . $loop->index, $biaya->jumlah) }}"
                                    min="0"
                                    step="1"
                                >

                            </div>


                            {{-- SATUAN --}}

                            <div class="col-md-2">

                                <label class="form-label">
                                    Satuan
                                </label>

                                <input
                                    type="text"
                                    name="biaya_satuan[]"
                                    class="form-control"
                                    value="{{ old('biaya_satuan.' . $loop->index, $biaya->satuan) }}"
                                    placeholder="Contoh: kali"
                                >

                            </div>


                            {{-- HARGA --}}

                            <div class="col-md-3">

                                <label class="form-label">
                                    Harga
                                </label>

                                <div class="input-group price-input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="biaya_harga[]"
                                        class="form-control"
                                        value="{{ old('biaya_harga.' . $loop->index, $biaya->harga_satuan) }}"
                                        min="0"
                                        step="1"
                                    >

                                </div>

                            </div>


                        </div>

                    </div>

                @empty

                    <div id="empty-biaya" class="text-center py-3">

                        <span style="color: var(--muted); font-size: 14px;">
                            Belum ada biaya tambahan.
                        </span>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================
    BUTTON
    ========================= --}}

    <div class="d-flex justify-content-end gap-2 mb-4">

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


</form>


<script>


    /* =========================
       HAPUS ITEM
    ========================= */

    function hapusItem(button)
    {
        const item = button.closest('.item-card');

        if (item) {
            item.remove();
        }
    }


    /* =========================
       TAMBAH KOMPONEN
    ========================= */

    function tambahBahan()
    {
        const container =
            document.getElementById('bahan-container');

        const empty =
            document.getElementById('empty-bahan');

        if (empty) {
            empty.remove();
        }

        const html = `

            <div class="item-card bahan-item">

                <div class="item-header">

                    <p class="item-title">
                        Komponen
                    </p>

                    <button
                        type="button"
                        class="btn btn-remove"
                        onclick="hapusItem(this)"
                    >
                        <i class="bi bi-trash"></i>
                    </button>

                </div>


                <input
                    type="hidden"
                    name="bahan_id[]"
                    value=""
                >


                <div class="row g-3">


                    <div class="col-md-3">

                        <label class="form-label">
                            Nama Komponen
                        </label>

                        <input
                            type="text"
                            name="bahan_nama[]"
                            class="form-control"
                            placeholder="Contoh: Tepung / Kayu / Kain"
                            required
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Digunakan
                        </label>

                        <input
                            type="number"
                            name="bahan_jumlah[]"
                            class="form-control"
                            min="0"
                            step="1"
                            required
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="bahan_satuan[]"
                            class="form-control"
                            placeholder="Contoh: kg"
                            required
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Isi Kemasan
                        </label>

<input
    type="number"
    name="bahan_isi[]"
    class="form-control"
    min="1"
    value="{{ $bahan->isi_kemasan }}"
    placeholder="Opsional"
>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <div class="input-group price-input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="bahan_harga[]"
                                class="form-control"
                                min="0"
                                step="1"
                                required
                            >

                        </div>

                    </div>


                </div>

            </div>

        `;

        container.insertAdjacentHTML(
            'beforeend',
            html
        );
    }


    /* =========================
       TAMBAH BIAYA
    ========================= */

    function tambahBiaya()
    {
        const container =
            document.getElementById('biaya-container');

        const empty =
            document.getElementById('empty-biaya');

        if (empty) {
            empty.remove();
        }

        const html = `

            <div class="item-card biaya-item">

                <div class="item-header">

                    <p class="item-title">
                        Biaya Tambahan
                    </p>

                    <button
                        type="button"
                        class="btn btn-remove"
                        onclick="hapusItem(this)"
                    >
                        <i class="bi bi-trash"></i>
                    </button>

                </div>


                <input
                    type="hidden"
                    name="biaya_id[]"
                    value=""
                >


                <div class="row g-3">


                    <div class="col-md-5">

                        <label class="form-label">
                            Nama Biaya
                        </label>

                        <input
                            type="text"
                            name="biaya_nama[]"
                            class="form-control"
                            placeholder="Contoh: Gas"
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            name="biaya_jumlah[]"
                            class="form-control"
                            min="0"
                            step="1"
                        >

                    </div>


                    <div class="col-md-2">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="biaya_satuan[]"
                            class="form-control"
                            placeholder="Contoh: kali"
                        >

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <div class="input-group price-input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="biaya_harga[]"
                                class="form-control"
                                min="0"
                                step="1"
                            >

                        </div>

                    </div>


                </div>

            </div>

        `;

        container.insertAdjacentHTML(
            'beforeend',
            html
        );
    }

</script>

@endsection