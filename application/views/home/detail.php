<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mobil->merk . ' ' . $mobil->tipe ?> - CarBekasKu</title>
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: #1a1a2e !important; }
        .navbar .nav-link { color: #fff !important; }
        .navbar-brand span { color: #e74c3b !important; font-weight: bold; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('home') ?>">
                <span><i class="fas fa-car mr-2"></i>CarBekasKu</span>
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home') ?>"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= base_url('assets/img/' . $mobil->foto) ?>" class="img-fluid rounded shadow" style="width:100%;max-height:400px;object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="font-weight-bold"><?= $mobil->merk . ' ' . $mobil->tipe ?></h2>
                
                <?php if ($mobil->status == 'Tersedia'): ?>
                    <span class="badge badge-success px-3 py-2 mb-3">Tersedia</span>
                <?php elseif ($mobil->status == 'Dipesan'): ?>
                    <span class="badge badge-warning px-3 py-2 mb-3">Dipesan</span>
                <?php else: ?>
                    <span class="badge badge-danger px-3 py-2 mb-3">Terjual</span>
                <?php endif; ?>

                <h3 class="text-primary font-weight-bold mb-4">Rp <?= number_format($mobil->harga, 0, ',', '.') ?></h3>
                
                <table class="table table-bordered">
                    <tr><th width="35%">Merk</th><td><?= $mobil->merk ?></td></tr>
                    <tr><th>Tipe</th><td><?= $mobil->tipe ?></td></tr>
                    <tr><th>Tahun</th><td><?= $mobil->tahun ?></td></tr>
                    <tr><th>Warna</th><td><?= $mobil->warna ?></td></tr>
                    <tr><th>Stok</th><td><?= $mobil->stock ?></td></tr>
                </table>

                <?php if ($mobil->status == 'Tersedia'): ?>
                    <?php if ($this->session->userdata('logged_in_pembeli')): ?>
                        <a href="<?= site_url('home/pesan/' . $mobil->id_mobil) ?>" 
                           class="btn btn-primary btn-lg btn-block"
                           onclick="return confirm('Yakin ingin memesan mobil ini?')">
                            <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('auth') ?>" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Memesan
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg btn-block" disabled>
                        <i class="fas fa-ban mr-2"></i>Mobil Tidak Tersedia
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= base_url('jomo-html/jomo-html/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/bootstrap.js') ?>"></script>
</body>
</html>