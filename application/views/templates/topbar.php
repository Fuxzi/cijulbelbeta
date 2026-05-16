<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?= $this->session->userdata('nama') ?>
                    <small class="text-muted">(<?= $this->session->userdata('role') ?>)</small>
                </span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/undraw_profile.svg') ?>" width="40">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <span class="dropdown-item text-muted small px-4">
                    Login sebagai: <strong><?= $this->session->userdata('username') ?></strong>
                </span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="<?= site_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>