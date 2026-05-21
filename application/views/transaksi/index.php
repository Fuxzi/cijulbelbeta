<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar mr-2"></i>Data Transaksi</h1>
        <a href="<?= site_url('transaksi/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Buat Transaksi</a>
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
                    <tr><th>No</th><th>Kode</th><th>Mobil</th><th>Pembeli</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if ($transaksi): $no = 1; foreach ($transaksi as $t): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><code><?= $t->id_pemesanan ?></code></td>
                        <td><?= $t->merk . ' ' . $t->tipe ?></td>
                        <td><?= $t->nama_pembeli ?></td>
                        <td><?= date('d-m-Y', strtotime($t->tanggal)) ?></td>
                        <td>
                            <?php
                            $badge = ['Pending'=>'warning','Diproses'=>'info','Selesai'=>'success','Batal'=>'danger'];
                            $b = $badge[$t->status] ?? 'secondary';
                            ?>
                            <span class="badge badge-<?= $b ?>"><?= $t->status ?></span>
                        </td>
                        <td>
                            <a href="<?= site_url('transaksi/detail/' . $t->id_pemesanan) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="<?= site_url('transaksi/hapus/' . $t->id_pemesanan) ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus transaksi ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="7" class="text-center text-muted">Belum ada transaksi</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>