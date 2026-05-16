<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-car mr-2"></i>Detail Mobil</h1>
        <div>
            <a href="<?= site_url('mobil/edit/' . $mobil->id) ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="<?= site_url('mobil') ?>" class="btn btn-secondary btn-sm ml-1">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/uploads/mobil/' . $mobil->foto) ?>"
                         class="img-fluid rounded" style="max-height:250px; object-fit:cover; width:100%;" alt="foto mobil">
                    <hr>
                    <h5 class="font-weight-bold"><?= $mobil->nama_mobil ?></h5>
                    <h4 class="text-primary font-weight-bold">Rp <?= number_format($mobil->harga, 0, ',', '.') ?></h4>
                    <span class="badge badge-<?= strtolower($mobil->status) ?> badge-lg p-2">
                        <?= $mobil->status ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Spesifikasi Lengkap</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tr><th width="35%">Kode Mobil</th><td><?= $mobil->kode_mobil ?></td></tr>
                        <tr><th>Merek</th><td><?= $mobil->merek ?></td></tr>
                        <tr><th>Model / Tipe</th><td><?= $mobil->model ?> / <?= $mobil->tipe ?></td></tr>
                        <tr><th>Tahun</th><td><?= $mobil->tahun ?></td></tr>
                        <tr><th>Warna</th><td><?= $mobil->warna ?></td></tr>
                        <tr><th>Transmisi</th><td><?= $mobil->transmisi ?></td></tr>
                        <tr><th>Bahan Bakar</th><td><?= $mobil->bahan_bakar ?></td></tr>
                        <tr><th>Kapasitas Mesin</th><td><?= $mobil->kapasitas_mesin ?></td></tr>
                        <tr><th>KM Tempuh</th><td><?= number_format($mobil->km_tempuh, 0, ',', '.') ?> km</td></tr>
                        <tr><th>Kondisi</th><td><?= $mobil->kondisi ?></td></tr>
                        <tr><th>Kategori</th><td><?= $mobil->nama_kategori ?? '-' ?></td></tr>
                        <tr><th>Penjual</th><td><?= $mobil->nama_penjual ?? '-' ?></td></tr>
                        <tr><th>Tanggal Masuk</th><td><?= date('d-m-Y', strtotime($mobil->tgl_masuk)) ?></td></tr>
                    </table>
                    <?php if ($mobil->deskripsi): ?>
                    <div class="mt-3">
                        <strong>Deskripsi:</strong>
                        <p class="mt-2 text-gray-700"><?= nl2br($mobil->deskripsi) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>