<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - CarBekasKu</title>
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: #1a1a2e !important; }
        .navbar .nav-link { color: #fff !important; }
        .navbar-brand span { color: #e74c3b !important; font-weight: bold; }
        .status-badge { font-size: 12px; padding: 5px 10px; border-radius: 20px; }
        .card-pesanan { transition: 0.3s; border-radius: 12px; }
        .card-pesanan:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('home') ?>">
                <span><i class="fas fa-car mr-2"></i>CarBekasKu</span>
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= site_url('home/pesanan') ?>">Pesanan Saya</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home/profil') ?>">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h3 class="mb-4"><i class="fas fa-shopping-cart mr-2"></i>Pesanan Saya</h3>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if ($pesanan): ?>
            <div class="row">
                <?php foreach ($pesanan as $p): ?>
                <div class="col-md-6 mb-4">
                    <div class="card card-pesanan shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?= base_url('assets/img/' . $p->foto) ?>" class="mr-3 rounded" style="width:80px;height:60px;object-fit:cover;">
                                <div>
                                    <h6 class="mb-0 font-weight-bold"><?= $p->merk . ' ' . $p->tipe ?></h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt mr-1"></i><?= $p->tahun ?? '-' ?> | 
                                        <i class="fas fa-palette mr-1"></i><?= $p->warna ?? '-' ?>
                                    </small>
                                </div>
                            </div>
                            <div class="bg-light p-2 rounded mb-3">
                                <small class="text-muted">Total Harga</small>
                                <h5 class="text-primary font-weight-bold mb-0">Rp <?= number_format($p->harga, 0, ',', '.') ?></h5>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Kode: <strong><?= $p->id_pemesanan ?></strong></small><br>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i><?= date('d M Y', strtotime($p->tanggal)) ?></small>
                                </div>
                                <div class="text-right">
                                    <?php
                                    $badge = ['Pending'=>'warning','Diproses'=>'info','Selesai'=>'success','Batal'=>'danger'];
                                    $b = $badge[$p->status] ?? 'secondary';
                                    ?>
                                    <span class="badge badge-<?= $b ?> status-badge mb-1"><?= $p->status ?></span>
                                    <?php if ($p->status == 'Pending'): ?>
                                        <br>
                                        <a href="<?= site_url('home/bayar/' . $p->id_pemesanan) ?>" class="btn btn-primary btn-sm mt-1">
                                            <i class="fas fa-credit-card mr-1"></i>Bayar Sekarang
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($p->status == 'Diproses'): ?>
                                        <br>
                                        <a href="<?= site_url('home/bayar/' . $p->id_pemesanan) ?>" class="btn btn-info btn-sm mt-1">
                                            <i class="fas fa-eye mr-1"></i>Lihat Pembayaran
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h5>Belum ada pesanan</h5>
                <p class="text-muted">Yuk, pilih mobil impianmu sekarang!</p>
                <a href="<?= site_url('home') ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-car mr-1"></i> Lihat Mobil
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="<?= base_url('jomo-html/jomo-html/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/bootstrap.js') ?>"></script>
</body>
</html>