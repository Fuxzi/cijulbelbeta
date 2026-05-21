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
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Transaksi</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr><th width="40%">Kode Transaksi</th><td><strong><?= $transaksi->id_pemesanan ?></strong></td></tr>
                        <tr><th>Tanggal</th><td><?= date('d-m-Y', strtotime($transaksi->tanggal)) ?></td></tr>
                        <tr><th>Status</th>
                            <td>
                                <?php
                                $badge = ['Pending'=>'warning','Diproses'=>'info','Selesai'=>'success','Batal'=>'danger'];
                                $b = $badge[$transaksi->status] ?? 'secondary';
                                ?>
                                <span class="badge badge-<?= $b ?> p-2"><?= $transaksi->status ?></span>
                            </td>
                        </tr>
                    </table>

                    <hr>
                    <form action="<?= site_url('transaksi/update_status') ?>" method="POST">
                        <input type="hidden" name="id_pemesanan" value="<?= $transaksi->id_pemesanan ?>">
                        <label class="font-weight-bold">Update Status:</label>
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
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Info Mobil & Pembeli</h6>
                </div>
                <div class="card-body">
                    <p><strong>Mobil:</strong> <?= $transaksi->merk . ' ' . $transaksi->tipe ?> (<?= $transaksi->tahun ?? '-' ?>)</p>
                    <p><strong>Harga:</strong> Rp <?= number_format($transaksi->harga, 0, ',', '.') ?></p>
                    <hr>
                    <p><strong>Pembeli:</strong> <?= $transaksi->nama_pembeli ?></p>
                    <p><strong>No HP:</strong> <?= $transaksi->no_hp ?></p>
                    <p><strong>Alamat:</strong> <?= $transaksi->alamat ?? '-' ?></p>
                </div>
            </div>
        </div>
    </div>
</div>