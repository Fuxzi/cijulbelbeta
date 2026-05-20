<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penjual</h1>
        <a href="<?= site_url('penjual') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('penjual/simpan') ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama Lengkap / Nama Dealer <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tipe</label>
                        <select name="tipe" class="form-control">
                            <option value="Individu">Individu</option>
                            <option value="Dealer">Dealer</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xx...">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" class="form-control" placeholder="Jakarta, Bandung...">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                <a href="<?= site_url('penjual') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>
