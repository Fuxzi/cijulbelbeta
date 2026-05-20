<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-store mr-2"></i>Penjual / Dealer</h1>
        <a href="<?= site_url('penjual/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Tambah Penjual</a>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered dataTable">
                <thead class="thead-light">
                    <tr><th>No</th><th>Nama</th><th>No HP</th><th>Email</th><th>Kota</th><th>Tipe</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if ($penjual): $no = 1; foreach ($penjual as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->nama ?></td>
                        <td><?= $p->no_hp ?></td>
                        <td><?= $p->email ?></td>
                        <td><?= $p->kota ?></td>
                        <td><span class="badge badge-info"><?= $p->tipe ?></span></td>
                        <td><span class="badge badge-<?= $p->status == 'Aktif' ? 'success' : 'secondary' ?>"><?= $p->status ?></span></td>
                        <td>
                            <a href="<?= site_url('penjual/edit/' . $p->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="<?= site_url('penjual/hapus/' . $p->id) ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus penjual ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="8" class="text-center text-muted">Belum ada data penjual</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
