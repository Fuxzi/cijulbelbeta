<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CarBekasKu</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Master Data</div>

    <li class="nav-item <?= (strpos(uri_string(), 'mobil') !== false) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('mobil') ?>">
            <i class="fas fa-fw fa-car"></i>
            <span>Data Mobil</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos(uri_string(), 'kategori_mobil') !== false) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('kategori_mobil') ?>">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori Mobil</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos(uri_string(), 'penjual') !== false) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('penjual') ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Penjual / Dealer</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos(uri_string(), 'pembeli') !== false) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('pembeli') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Pembeli</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Transaksi</div>

    <li class="nav-item <?= (strpos(uri_string(), 'transaksi') !== false) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('transaksi') ?>">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Data Transaksi</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">