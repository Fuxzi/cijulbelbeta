<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pembeli</h1>
        <a href="<?= site_url('pembeli') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('pembeli/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $pembeli->id ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $pembeli->nama ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $pembeli->no_hp ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $pembeli->email ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kota</label>
                        <input type="text" name="kota" class="form-control" value="<?= $pembeli->kota ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= $pembeli->alamat ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="<?= site_url('pembeli') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>