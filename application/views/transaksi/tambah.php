<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus mr-2"></i>Buat Transaksi</h1>
        <a href="<?= site_url('transaksi') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= site_url('transaksi/simpan') ?>" method="POST">

                <div class="form-group">
                    <label>Pilih Mobil <span class="text-danger">*</span></label>
                    <select name="id_mobil" id="id_mobil" class="form-control" required>
                        <option value="">-- Pilih Mobil Tersedia --</option>
                        <?php foreach ($mobil as $m): ?>
                        <option value="<?= $m->id_mobil ?>" data-harga="<?= $m->harga ?>">
                            <?= $m->merk . ' ' . $m->tipe ?> (<?= $m->tahun ?>) - Rp <?= number_format($m->harga, 0, ',', '.') ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Pembeli <span class="text-danger">*</span></label>
                    <select name="id_pembeli" class="form-control" required>
                        <option value="">-- Pilih Pembeli --</option>
                        <?php foreach ($pembeli as $p): ?>
                        <option value="<?= $p->id_pembeli ?>"><?= $p->nama ?> - <?= $p->no_hp ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga Deal (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_deal" id="harga_deal" class="form-control"
                           placeholder="Akan terisi otomatis saat pilih mobil" required>
                    <small class="text-muted">Bisa diubah sesuai hasil negosiasi</small>
                </div>

                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"
                              placeholder="Catatan tambahan..."></textarea>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Buat Transaksi
                </button>
                <a href="<?= site_url('transaksi') ?>" class="btn btn-secondary ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('id_mobil').addEventListener('change', function() {
    var selected = this.options[this.selectedIndex];
    var harga = selected.getAttribute('data-harga');
    if (harga) {
        document.getElementById('harga_deal').value = harga;
    }
});
</script>