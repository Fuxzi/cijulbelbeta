<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - CarBekasKu Admin</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                            <h2 class="h4 text-gray-900 font-weight-bold">CarBekasKu</h2>
                            <p class="text-muted small">Admin Panel — Silakan login</p>
                        </div>

                        <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                        <?php endif; ?>

                        <form action="<?= site_url('auth/proses_login') ?>" method="POST">
                            <div class="form-group">
                                <label class="small text-muted">Username</label>
                                <input type="text" name="username" class="form-control form-control-user"
                                       placeholder="Masukkan username" required autofocus>
                            </div>
                            <div class="form-group">
                                <label class="small text-muted">Password</label>
                                <input type="password" name="password" class="form-control form-control-user"
                                       placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
