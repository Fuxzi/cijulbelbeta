<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-car mr-2"></i>Detail Mobil</h1>
        <div>
            <a href="<?= site_url('mobil/edit/' . $mobil->id_mobil) ?>" class="btn btn-warning btn-sm shadow-sm">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
            <a href="<?= site_url('mobil') ?>" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Foto -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/' . $mobil->foto) ?>" 
                         class="img-fluid rounded" alt="Foto Mobil" style="max-height: 300px;">
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <?= $mobil->merk . ' ' . $mobil->tipe ?>
                    </h6>
                </div>
                <div class="card-body">
                    <h4 class="text-primary font-weight-bold">
                        Rp <?= number_format($mobil->harga, 0, ',', '.') ?>
                    </h4>
                    <p>
                        <?php if ($mobil->status == 'Tersedia'): ?>
                            <span class="badge badge-success">Tersedia</span>
                        <?php elseif ($mobil->status == 'Terjual'): ?>
                            <span class="badge badge-danger">Terjual</span>
                        <?php elseif ($mobil->status == 'Dipesan'): ?>
                            <span class="badge badge-warning">Dipesan</span>
                        <?php else: ?>
                            <span class="badge badge-secondary"><?= $mobil->status ?></span>
                        <?php endif; ?>
                    </p>

                    <hr>
                    <h6 class="font-weight-bold">Spesifikasi</h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="150">Kode Mobil</td>
                            <td>: <?= $mobil->id_mobil ?></td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>: <?= $mobil->merk ?></td>
                        </tr>
                        <tr>
                            <td>Tipe</td>
                            <td>: <?= $mobil->tipe ?></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>: <?= $mobil->tahun ?></td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td>: <?= $mobil->warna ?></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td>: <?= $mobil->stock ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>: <?= $mobil->status ?></td>
                        </tr>
                    </table>

                    <?php if (!empty($mobil->deskripsi)): ?>
                    <hr>
                    <h6 class="font-weight-bold">Deskripsi</h6>
                    <p><?= nl2br($mobil->deskripsi) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>