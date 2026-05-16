<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2"></i>Edit Mobil</h1>
        <a href="<?= site_url('mobil') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('mobil/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $mobil->id ?>">

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary mb-3">Informasi Umum</h6>
                        <div class="form-group">
                            <label>Nama Mobil</label>
                            <input type="text" name="nama_mobil" class="form-control" value="<?= $mobil->nama_mobil ?>" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Merek</label>
                                <input type="text" name="merek" class="form-control" value="<?= $mobil->merek ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Model</label>
                                <input type="text" name="model" class="form-control" value="<?= $mobil->model ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tipe</label>
                                <input type="text" name="tipe" class="form-control" value="<?= $mobil->tipe ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tahun</label>
                                <input type="number" name="tahun" class="form-control" value="<?= $mobil->tahun ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Warna</label>
                                <input type="text" name="warna" class="form-control" value="<?= $mobil->warna ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>KM Tempuh</label>
                                <input type="number" name="km_tempuh" class="form-control" value="<?= $mobil->km_tempuh ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary mb-3">Spesifikasi & Harga</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Transmisi</label>
                                <select name="transmisi" class="form-control">
                                    <option value="Manual" <?= $mobil->transmisi == 'Manual' ? 'selected' : '' ?>>Manual</option>
                                    <option value="Otomatis" <?= $mobil->transmisi == 'Otomatis' ? 'selected' : '' ?>>Otomatis</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Bahan Bakar</label>
                                <select name="bahan_bakar" class="form-control">
                                    <?php foreach (['Bensin','Diesel','Hybrid','Listrik'] as $bb): ?>
                                    <option value="<?= $bb ?>" <?= $mobil->bahan_bakar == $bb ? 'selected' : '' ?>><?= $bb ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kapasitas Mesin</label>
                                <input type="text" name="kapasitas_mesin" class="form-control" value="<?= $mobil->kapasitas_mesin ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kondisi</label>
                                <select name="kondisi" class="form-control">
                                    <?php foreach (['Sangat Baik','Baik','Cukup'] as $k): ?>
                                    <option value="<?= $k ?>" <?= $mobil->kondisi == $k ? 'selected' : '' ?>><?= $k ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="<?= $mobil->harga ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($kategori as $kat): ?>
                                    <option value="<?= $kat->id ?>" <?= $mobil->id_kategori == $kat->id ? 'selected' : '' ?>><?= $kat->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <?php foreach (['Tersedia','Dipesan','Terjual'] as $s): ?>
                                    <option value="<?= $s ?>" <?= $mobil->status == $s ? 'selected' : '' ?>><?= $s ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Penjual</label>
                            <select name="id_penjual" class="form-control">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($penjual as $p): ?>
                                <option value="<?= $p->id ?>" <?= $mobil->id_penjual == $p->id ? 'selected' : '' ?>><?= $p->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= $mobil->deskripsi ?></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Foto Mobil <span class="text-muted small">(kosongkan jika tidak diganti)</span></label>
                        <img src="<?= base_url('assets/uploads/mobil/' . $mobil->foto) ?>"
                             class="img-fluid mb-2 rounded" style="max-height:100px;" id="preview">
                        <input type="file" name="foto" class="form-control-file" accept="image/*"
                               onchange="previewFoto(this)">
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="<?= site_url('mobil') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { $('#preview').attr('src', e.target.result); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>