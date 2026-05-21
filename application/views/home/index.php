<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarBekasKu - Jual Beli Mobil Bekas Berkualitas</title>
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <style>
    /* Navbar lebih solid */
    .header_section .navbar {
        background: #1a1a2e !important;
        padding: 10px 0;
    }
    .header_section .navbar .nav-link {
        color: #ffffff !important;
        font-weight: 500;
    }
    .header_section .navbar .nav-link:hover {
        color: #e74c3b !important;
    }
    .header_section .navbar-brand span {
        color: #e74c3b !important;
        font-weight: bold;
        font-size: 24px;
    }
    .header_section .btn-primary {
        background: #e74c3b !important;
        border-color: #e74c3b !important;
    }
    .header_section .btn-primary:hover {
        background: #c0392b !important;
        border-color: #c0392b !important;
    }

    /* Hero overlay lebih gelap biar teks jelas */
    .hero_section {
        position: relative;
    }
    .hero_section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.6);
    }
    .hero_section .container {
        position: relative;
        z-index: 1;
    }

    /* Card mobil */
    .car-card {
        transition: 0.3s;
        border-radius: 10px;
        overflow: hidden;
    }
    .car-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    /* Dropdown user */
    .dropdown-menu {
        border-radius: 8px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
</style>
</head>
<body>
    <!-- Header -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="<?= site_url('home') ?>">
                    <img src="<?= base_url('jomo-html/jomo-html/images/logo.png') ?>" alt="Logo" style="height:40px;">
                    <span>CarBekasKu</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="<?= site_url('home') ?>">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#cars">Mobil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                        <?php if ($this->session->userdata('logged_in_pembeli')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <i class="fas fa-user mr-1"></i><?= $this->session->userdata('nama_pembeli') ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= site_url('home/pesanan') ?>">
                                        <i class="fas fa-shopping-cart mr-2"></i>Pesanan Saya
                                    </a>
                                    <a class="dropdown-item" href="<?= site_url('home/profil') ?>">
                                        <i class="fas fa-user-cog mr-2"></i>Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link btn btn-primary text-white px-4 ml-2" href="<?= site_url('auth') ?>">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero_section" style="background: url('<?= base_url('jomo-html/jomo-html/images/hero-bg.jpg') ?>') center/cover no-repeat;">
        <div class="container">
            <div class="row align-items-center" style="min-height:80vh;">
                <div class="col-md-7 text-white">
                    <h1 class="display-4 font-weight-bold">Temukan Mobil Impianmu</h1>
                    <p class="lead mb-4">Pilihan mobil bekas berkualitas dengan harga terbaik dan kondisi terjamin</p>
                    <div class="d-flex">
                        <a href="#cars" class="btn btn-primary btn-lg mr-3">Lihat Mobil</a>
                        <a href="#about" class="btn btn-outline-light btn-lg">Selengkapnya</a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-4">
                            <h3 class="font-weight-bold"><?= $this->db->count_all('mobil') ?>+</h3>
                            <small>Mobil Tersedia</small>
                        </div>
                        <div class="col-4">
                            <h3 class="font-weight-bold"><?= $this->db->where('status','Terjual')->count_all_results('mobil') ?>+</h3>
                            <small>Mobil Terjual</small>
                        </div>
                        <div class="col-4">
                            <h3 class="font-weight-bold"><?= $this->db->count_all('pembeli') ?>+</h3>
                            <small>Pelanggan Puas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cars Section -->
    <section id="cars" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold">Mobil Tersedia</h2>
                <p class="text-muted">Pilih mobil bekas terbaik untuk kebutuhan Anda</p>
            </div>
            <div class="row">
                <?php if ($mobil): foreach ($mobil as $m): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card car-card shadow-sm h-100 border-0">
                        <div class="position-relative">
                            <img src="<?= base_url('assets/img/' . $m->foto) ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="<?= $m->merk ?>">
                            <span class="badge badge-<?= $m->status == 'Tersedia' ? 'success' : 'danger' ?> position-absolute" style="top:10px;right:10px;">
                                <?= $m->status ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"><?= $m->merk . ' ' . $m->tipe ?></h5>
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fas fa-calendar-alt mr-1"></i><?= $m->tahun ?></span>
                                <span><i class="fas fa-palette mr-1"></i><?= $m->warna ?></span>
                            </div>
                            <h4 class="text-primary font-weight-bold">Rp <?= number_format($m->harga, 0, ',', '.') ?></h4>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <div class="d-flex justify-content-between">
                               <a href="<?= site_url('home/detail/' . $m->id_mobil) ?>" class="btn btn-outline-primary btn-sm">
    <i class="fas fa-eye mr-1"></i>Detail
</a>
<?php if ($m->status == 'Tersedia'): ?>
    <?php if ($this->session->userdata('logged_in_pembeli')): ?>
        <a href="<?= site_url('home/pesan/' . $m->id_mobil) ?>" 
           class="btn btn-primary btn-sm"
           onclick="return confirm('Yakin ingin memesan mobil ini?')">
            <i class="fas fa-shopping-cart mr-1"></i>Pesan
        </a>
    <?php else: ?>
        <a href="<?= site_url('auth') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-in-alt mr-1"></i>Login
        </a>
    <?php endif; ?>
<?php else: ?>
    <button class="btn btn-secondary btn-sm" disabled>Terjual</button>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-car fa-4x text-muted mb-3"></i>
                    <h4>Belum ada mobil tersedia</h4>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="<?= base_url('jomo-html/jomo-html/images/about-bg.jpg') ?>" class="img-fluid rounded shadow" alt="About">
                </div>
                <div class="col-md-6">
                    <h2 class="font-weight-bold mb-4">Kenapa Memilih CarBekasKu?</h2>
                    <div class="d-flex mb-3">
                        <div class="mr-3"><i class="fas fa-check-circle fa-2x text-primary"></i></div>
                        <div>
                            <h5>Mobil Berkualitas</h5>
                            <p class="text-muted">Semua mobil melalui inspeksi ketat sebelum dijual</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="mr-3"><i class="fas fa-check-circle fa-2x text-primary"></i></div>
                        <div>
                            <h5>Harga Terbaik</h5>
                            <p class="text-muted">Harga kompetitif dan transparan tanpa biaya tersembunyi</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="mr-3"><i class="fas fa-check-circle fa-2x text-primary"></i></div>
                        <div>
                            <h5>Proses Mudah</h5>
                            <p class="text-muted">Proses pembelian cepat dan dokumen lengkap</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="mr-3"><i class="fas fa-check-circle fa-2x text-primary"></i></div>
                        <div>
                            <h5>Garansi</h5>
                            <p class="text-muted">Garansi mesin dan transmisi untuk ketenangan Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="font-weight-bold mb-3">Hubungi Kami</h2>
            <p class="lead mb-4">Punya pertanyaan? Tim kami siap membantu Anda</p>
            <div class="row justify-content-center">
                <div class="col-md-3 mb-3">
                    <i class="fas fa-phone fa-2x mb-2"></i>
                    <h5>Telepon</h5>
                    <p>+62 812-3456-7890</p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fas fa-envelope fa-2x mb-2"></i>
                    <h5>Email</h5>
                    <p>info@carbekasku.com</p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                    <h5>Alamat</h5>
                    <p>Jl. Mobil Raya No.88, Jakarta</p>
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h5>Jam Operasional</h5>
                    <p>Sen - Sab: 08:00 - 18:00</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>CarBekasKu</h5>
                    <p class="text-muted small">Platform jual beli mobil bekas terpercaya di Indonesia.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#cars" class="text-muted">Mobil Tersedia</a></li>
                        <li><a href="#about" class="text-muted">Tentang Kami</a></li>
                        <li><a href="#contact" class="text-muted">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="text-white mr-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center small text-muted">
                &copy; <?= date('Y') ?> CarBekasKu. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="<?= base_url('jomo-html/jomo-html/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/custom.js') ?>"></script>
</body>
</html>