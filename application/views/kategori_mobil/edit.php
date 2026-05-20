<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kategori Mobil</h1>
        <a href="<?= site_url('kategori_mobil') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('kategori_mobil/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $kategori->id ?>">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="<?= $kategori->nama_kategori ?>" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= $kategori->deskripsi ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="<?= site_url('kategori_mobil') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>
