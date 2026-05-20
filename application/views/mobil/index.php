<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-car mr-2"></i>Data Mobil</h1>
        <a href="<?= site_url('mobil/tambah') ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm mr-1"></i> Tambah Mobil
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Mobil</th>
                            <th>Merek / Model</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>KM</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($mobil): $no = 1; foreach ($mobil as $m): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="<?= base_url('assets/uploads/mobil/' . $m->foto) ?>"
                                     class="img-mobil-thumb" alt="foto">
                            </td>
                            <td><?= $m->nama_mobil ?></td>
                            <td><?= $m->merek ?> <?= $m->model ?></td>
                            <td><?= $m->tahun ?></td>
                            <td>Rp <?= number_format($m->harga, 0, ',', '.') ?></td>
                            <td><?= number_format($m->km_tempuh, 0, ',', '.') ?> km</td>
                            <td>
                                <span class="badge badge-<?= strtolower($m->status) ?>">
                                    <?= $m->status ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= site_url('mobil/detail/' . $m->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="<?= site_url('mobil/edit/' . $m->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="<?= site_url('mobil/hapus/' . $m->id) ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus data mobil ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="9" class="text-center text-muted">Belum ada data mobil</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
