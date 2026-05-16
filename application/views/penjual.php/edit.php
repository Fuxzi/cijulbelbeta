<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Penjual</h1>
        <a href="<?= site_url('penjual') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('penjual/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $penjual->id ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $penjual->nama ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tipe</label>
                        <select name="tipe" class="form-control">
                            <option value="Individu" <?= $penjual->tipe == 'Individu' ? 'selected' : '' ?>>Individu</option>
                            <option value="Dealer" <?= $penjual->tipe == 'Dealer' ? 'selected' : '' ?>>Dealer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Aktif" <?= $penjual->status == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Nonaktif" <?= $penjual->status == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $penjual->no_hp ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $penjual->email ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= $penjual->alamat ?></textarea>
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" class="form-control" value="<?= $penjual->kota ?>">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="<?= site_url('penjual') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>