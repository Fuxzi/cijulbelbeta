<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus mr-2"></i>Tambah Mobil</h1>
        <a href="<?= site_url('mobil') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('mobil/simpan') ?>" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary mb-3">Informasi Umum</h6>
                        <div class="form-group">
                            <label>Nama Mobil <span class="text-danger">*</span></label>
                            <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Toyota Avanza G 2020" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Merk <span class="text-danger">*</span></label>
                                <input type="text" name="merk" class="form-control" placeholder="Toyota, Honda..." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tipe</label>
                                <input type="text" name="tipe" class="form-control" placeholder="Avanza, Jazz...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" placeholder="2020" min="1990" max="<?= date('Y') ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Warna</label>
                                <input type="text" name="warna" class="form-control" placeholder="Putih, Hitam...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>KM Tempuh</label>
                            <input type="number" name="km_tempuh" class="form-control" placeholder="50000" value="0">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary mb-3">Spesifikasi & Harga</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Transmisi</label>
                                <select name="transmisi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Otomatis">Otomatis</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Bahan Bakar</label>
                                <select name="bahan_bakar" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Bensin">Bensin</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Listrik">Listrik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kapasitas Mesin</label>
                                <input type="text" name="kapasitas_mesin" class="form-control" placeholder="1500cc">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kondisi</label>
                                <select name="kondisi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Sangat Baik">Sangat Baik</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Cukup">Cukup</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" placeholder="150000000" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k->id ?>"><?= $k->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Penjual / Dealer</label>
                                <select name="id_penjual" class="form-control">
                                    <option value="">-- Pilih Penjual --</option>
                                    <?php foreach ($penjual as $p): ?>
                                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Kondisi detail, kelengkapan dokumen, dll..."></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Foto Mobil <span class="text-muted small">(jpg/png, max 2MB)</span></label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*"
                               onchange="previewFoto(this)">
                        <img id="preview" src="#" class="img-fluid mt-2 rounded" style="display:none; max-height:120px;">
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="<?= site_url('mobil') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>