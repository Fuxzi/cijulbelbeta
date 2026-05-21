<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - CarBekasKu</title>
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
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home/pesanan') ?>">Pesanan Saya</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= site_url('home/profil') ?>">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h4 class="mb-4"><i class="fas fa-user-circle mr-2"></i>Profil Saya</h4>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= site_url('home/update_profil') ?>" method="POST">
                            <div class="form-group">
                                <label>ID Pembeli</label>
                                <input type="text" class="form-control" value="<?= $pembeli->id_pembeli ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="<?= $pembeli->username ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= $pembeli->nama ?>" required>
                            </div>
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control" value="<?= $pembeli->no_hp ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2"><?= $pembeli->alamat ?></textarea>
                            </div>
                            <hr>
                            <h6>Ganti Password <small class="text-muted">(kosongkan jika tidak diganti)</small></h6>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('jomo-html/jomo-html/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/bootstrap.js') ?>"></script>
</body>
</html>