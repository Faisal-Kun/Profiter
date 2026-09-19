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

    .edit-title {
        color: var(--text);
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .edit-subtitle {
        color: var(--muted);
        font-size: 14px;
    }

    .edit-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .edit-card-body {
        padding: 22px;
    }

    .edit-section-title {
        color: var(--text);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .form-label {
        color: var(--muted);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .optional-label {
        color: #66758a;
        font-size: 11px;
        font-weight: 500;
        margin-left: 4px;
    }

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
        box-shadow: 0 0 0 3px var(--primary-soft);
    }

    .form-control::placeholder {
        color: #66758a;
    }

    .form-select option {
        background: #1a2230;
        color: var(--text);
    }

    .form-control[type="file"] {
        padding: 8px 10px;
    }

    .form-control[type="file"]::file-selector-button {
        background: #273342;
        border: none;
        color: var(--text);
        border-radius: 7px;
        padding: 7px 12px;
        margin-right: 10px;
        cursor: pointer;
    }

    .price-input-group .input-group-text {
        background: #202a38;
        border: 1px solid #293647;
        border-right: none;
        color: #8fa0b5;
        border-radius: 10px 0 0 10px;
        font-size: 13px;
        font-weight: 600;
    }

    .price-input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .item-card {
        background: #111720;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 14px;
    }

    .item-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .item-title {
        color: var(--text);
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    .btn-add {
        background: var(--primary-soft);
        border: 1px solid rgba(59,130,246,.25);
        color: #60a5fa;
        border-radius: 9px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-add:hover {
        background: rgba(59,130,246,.16);
        color: #93c5fd;
    }

    .btn-remove {
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.18);
        color: var(--danger);
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-remove:hover {
        background: rgba(239,68,68,.15);
        color: #f87171;
    }

    .btn-back {
        background: #1a2230;
        border: 1px solid var(--border);
        color: #aeb9c8;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #222c3a;
        color: var(--text);
    }

    .btn-save {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: white;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white;
    }

    .alert-danger-custom {
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.2);
        color: #fca5a5;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .form-text {
        color: #66758a;
        font-size: 11px;
        margin-top: 6px;
    }

    @media (max-width: 768px) {
        .edit-title {
            font-size: 20px;
        }

        .edit-card-body {
            padding: 17px;
        }

        .item-card {
            padding: 14px;
        }
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="edit-title">Tambah Produk</h3>
        <p class="edit-subtitle mb-0">
            Masukkan informasi, komponen, dan biaya tambahan produk
        </p>
    </div>

    <a href="/produk" class="btn btn-back">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

<form action="/produk" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert-danger-custom">
            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-circle me-1"></i>
                Ada data yang belum benar:
            </div>

            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFORMASI PRODUK --}}
    <div class="edit-card">
        <div class="edit-card-body">

            <h5 class="edit-section-title">
                Informasi Produk
            </h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Ayam Crispy"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="kategori"
                        class="form-control"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Makanan"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Harga Jual
                    </label>

                    <div class="input-group price-input-group">
                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga_jual"
                            class="form-control"
                            value="{{ old('harga_jual') }}"
                            placeholder="15000"
                            min="0"
                            step="1"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Gambar Produk
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/*"
                    >

                    <div class="form-text">
                        Maksimal ukuran gambar 5MB.
                    </div>
                </div>

            </div>

        </div>
    </div>


    {{-- KOMPONEN PRODUK --}}
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

                {{-- KOMPONEN PERTAMA --}}
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
                                value="{{ old('bahan_nama.0') }}"
                                placeholder="Contoh: Tepung / Kayu / Kain"
                                required
                            >

                        </div>


                        {{-- JUMLAH --}}
                        <div class="col-md-2">

                            <label class="form-label">
                                Jumlah
                            </label>

                            <input
                                type="number"
                                name="bahan_jumlah[]"
                                class="form-control"
                                value="{{ old('bahan_jumlah.0') }}"
                                placeholder="1"
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
                                value="{{ old('bahan_satuan.0') }}"
                                placeholder="Contoh: kg"
                                required
                            >

                        </div>


                        {{-- ISI KEMASAN --}}
                        <div class="col-md-2">

                            <label class="form-label">
                                Isi Kemasan
                                <span class="optional-label">
                                    (opsional)
                                </span>
                            </label>

                            <input
                                type="number"
                                name="bahan_isi[]"
                                class="form-control"
                                value="{{ old('bahan_isi.0') }}"
                                min="1"
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
                                    value="{{ old('bahan_harga.0') }}"
                                    placeholder="5000"
                                    min="0"
                                    step="1"
                                    required
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>


    {{-- BIAYA TAMBAHAN --}}
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

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Nama Biaya
                            </label>

                            <input
                                type="text"
                                name="biaya_nama[]"
                                class="form-control"
                                value="{{ old('biaya_nama.0') }}"
                                placeholder="Contoh: Gas / Listrik / Ongkir"
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
                                value="{{ old('biaya_jumlah.0') }}"
                                placeholder="1"
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
                                value="{{ old('biaya_satuan.0') }}"
                                placeholder="Contoh: kali / hari"
                            >

                        </div>


                        <div class="col-md-4">

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
                                    value="{{ old('biaya_harga.0') }}"
                                    placeholder="5000"
                                    min="0"
                                    step="1"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="d-flex justify-content-end gap-2 mb-4">

        <a
            href="/produk"
            class="btn btn-back"
        >
            Batal
        </a>

        <button
            type="submit"
            class="btn btn-save"
        >
            <i class="bi bi-check-circle me-1"></i>
            Simpan Produk
        </button>

    </div>

</form>


<script>

    // Hapus komponen / biaya
    function hapusItem(button) {

        const item = button.closest('.item-card');

        if (item) {
            item.remove();
        }

    }


    // Tambah komponen produk
    function tambahBahan() {

        const container =
            document.getElementById('bahan-container');

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
                            Jumlah
                        </label>

                        <input
                            type="number"
                            name="bahan_jumlah[]"
                            class="form-control"
                            placeholder="1"
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
                            <span class="optional-label">
                                (opsional)
                            </span>
                        </label>

                        <input
                            type="number"
                            name="bahan_isi[]"
                            class="form-control"
                            min="1"
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
                                placeholder="5000"
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


    // Tambah biaya tambahan
    function tambahBiaya() {

        const container =
            document.getElementById('biaya-container');

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

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Nama Biaya
                        </label>

                        <input
                            type="text"
                            name="biaya_nama[]"
                            class="form-control"
                            placeholder="Contoh: Gas / Listrik / Ongkir"
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
                            placeholder="1"
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
                            placeholder="Contoh: kali / hari"
                        >

                    </div>


                    <div class="col-md-4">

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
                                placeholder="5000"
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