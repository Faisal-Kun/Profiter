<div class="sidebar">

    <div class="logo">
        <span>Profiter</span>
    </div>

    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        <i class="bi bi-house"></i>
        Dashboard
    </a>

    <a href="/produk" class="{{ request()->is('produk*') ? 'active' : '' }}">
        <i class="bi bi-box"></i>
        Produk
    </a>

    <a href="/produksi" class="{{ request()->is('produksi*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i>
        Produksi
    </a>

    <a href="/penjualan" class="{{ request()->is('penjualan*') ? 'active' : '' }}">
        <i class="bi bi-cart"></i>
        Penjualan
    </a>

</div>