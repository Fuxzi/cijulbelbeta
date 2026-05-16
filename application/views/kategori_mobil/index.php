<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tags mr-2"></i>Kategori Mobil</h1>
        <a href="<?= site_url('kategori_mobil/tambah') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Kategori
        </a>
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
                    <tr><th>No</th><th>Nama Kategori</th><th>Deskripsi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if ($kategori): $no = 1; foreach ($kategori as $k): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $k->nama_kategori ?></td>
                        <td><?= $k->deskripsi ?></td>
                        <td>
                            <a href="<?= site_url('kategori_mobil/edit/' . $k->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="<?= site_url('kategori_mobil/hapus/' . $k->id) ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus kategori ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="4" class="text-center text-muted">Belum ada kategori</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>