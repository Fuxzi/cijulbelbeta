<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar mr-2"></i>Detail Transaksi</h1>
        <a href="<?= site_url('transaksi') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Info Transaksi -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Transaksi</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr><th width="40%">Kode Transaksi</th><td><strong><?= $transaksi->kode_transaksi ?></strong></td></tr>
                        <tr><th>Tanggal</th><td><?= date('d-m-Y', strtotime($transaksi->tgl_transaksi)) ?></td></tr>
                        <tr><th>Harga Deal</th><td class="text-success font-weight-bold">Rp <?= number_format($transaksi->harga_deal, 0, ',', '.') ?></td></tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php
                                $badge = ['Pending'=>'warning','Diproses'=>'info','Selesai'=>'success','Batal'=>'danger'];
                                $b = $badge[$transaksi->status] ?? 'secondary';
                                ?>
                                <span class="badge badge-<?= $b ?> p-2"><?= $transaksi->status ?></span>
                            </td>
                        </tr>
                        <tr><th>Catatan</th><td><?= $transaksi->catatan ?: '-' ?></td></tr>
                    </table>

                    <!-- Form Update Status -->
                    <hr>
                    <form action="<?= site_url('transaksi/update_status') ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $transaksi->id ?>">
                        <label class="font-weight-bold">Update Status Transaksi:</label>
                        <div class="input-group mt-2">
                            <select name="status" class="form-control">
                                <?php foreach (['Pending','Diproses','Selesai','Batal'] as $s): ?>
                                <option value="<?= $s ?>" <?= $transaksi->status == $s ? 'selected' : '' ?>><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <small class="text-muted">
                            * Status <strong>Selesai</strong> = mobil otomatis jadi <span class="text-danger">Terjual</span><br>
                            * Status <strong>Batal</strong> = mobil otomatis kembali jadi <span class="text-success">Tersedia</span>
                        </small>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Mobil & Pembeli -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Mobil</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('assets/uploads/mobil/' . $transaksi->foto) ?>"
                             class="img-mobil-thumb mr-3" style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                        <div>
                            <h6 class="font-weight-bold mb-0"><?= $transaksi->nama_mobil ?></h6>
                            <small class="text-muted"><?= $transaksi->merek ?></small>
                        </div>
                    </div>
                    <a href="<?= site_url('mobil/detail/' . $transaksi->id_mobil) ?>"
                       class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye mr-1"></i> Lihat Detail Mobil
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pembeli</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr><th width="35%">Nama</th><td><?= $transaksi->nama_pembeli ?></td></tr>
                        <tr><th>No HP</th><td><?= $transaksi->no_hp ?></td></tr>
                        <tr><th>Email</th><td><?= $transaksi->email ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
