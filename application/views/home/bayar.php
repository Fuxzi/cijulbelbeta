<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - CarBekasKu</title>
    <link rel="stylesheet" href="<?= base_url('jomo-html/jomo-html/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: #1a1a2e !important; }
        .navbar .nav-link { color: #fff !important; }
        .navbar-brand span { color: #e74c3b !important; font-weight: bold; }
        .card-rekening { border-left: 4px solid #007bff; }
        .metode-card { cursor: pointer; transition: 0.3s; border: 2px solid transparent; border-radius: 10px; }
        .metode-card:hover { border-color: #007bff; }
        .metode-card.active { border-color: #007bff; background: #f0f7ff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('home') ?>">
                <span><i class="fas fa-car mr-2"></i>CarBekasKu</span>
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('home/pesanan') ?>">Pesanan Saya</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h3 class="mb-4"><i class="fas fa-credit-card mr-2"></i>Pembayaran</h3>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i><?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <?php if ($pembayaran && $pembayaran->status_bayar == 'Dikonfirmasi'): ?>
            <!-- SUDAH DIKONFIRMASI -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                            <h4>Pembayaran Dikonfirmasi!</h4>
                            <p class="text-muted">Admin telah mengkonfirmasi pembayaran Anda.</p>
                            <a href="<?= site_url('home/pesanan') ?>" class="btn btn-primary">Lihat Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($pembayaran && $pembayaran->status_bayar == 'Menunggu'): ?>
            <!-- MENUNGGU KONFIRMASI -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-clock fa-5x text-info mb-3"></i>
                            <h4>Menunggu Konfirmasi</h4>
                            <p class="text-muted">Bukti bayar sudah terkirim. Admin akan segera memproses.</p>
                            <?php if ($pembayaran->metode != 'Tunai'): ?>
                                <img src="<?= base_url('assets/img/bukti/' . $pembayaran->bukti_bayar) ?>" class="img-fluid rounded mt-3" style="max-height:250px;">
                            <?php endif; ?>
                            <hr>
                            <p class="mb-1"><strong>Metode:</strong> <?= $pembayaran->metode ?></p>
                            <p><strong>Jumlah:</strong> Rp <?= number_format($pembayaran->jumlah, 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- FORM PEMBAYARAN -->
            <div class="row">
                <!-- Info Pesanan -->
                <div class="col-md-5">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">Detail Pesanan</h5>
                            <img src="<?= base_url('assets/img/' . $pesanan->foto) ?>" class="img-fluid rounded mb-3" style="max-height:180px;width:100%;object-fit:cover;">
                            <h6 class="font-weight-bold"><?= $pesanan->merk . ' ' . $pesanan->tipe ?></h6>
                            <table class="table table-sm table-borderless">
                                <tr><td>Kode</td><td>: <strong><?= $pesanan->id_pemesanan ?></strong></td></tr>
                                <tr><td>Tanggal</td><td>: <?= date('d M Y', strtotime($pesanan->tanggal)) ?></td></tr>
                            </table>
                            <hr>
                            <h4 class="text-primary font-weight-bold">Rp <?= number_format($pesanan->harga, 0, ',', '.') ?></h4>
                        </div>
                    </div>

                    <!-- Rekening (hanya muncul jika transfer) -->
                    <div class="card card-rekening shadow mb-4" id="cardRekening" style="display:none;">
                        <div class="card-body">
                            <h6 class="font-weight-bold"><i class="fas fa-university mr-2"></i>Transfer ke:</h6>
                            <div class="bg-light p-3 rounded mt-2">
                                <p class="mb-1"><strong>Bank BCA</strong></p>
                                <p class="mb-1">No. Rek: <strong>1234567890</strong></p>
                                <p class="mb-0">A/n: <strong>PT CarBekasKu Indonesia</strong></p>
                            </div>
                            <div class="bg-light p-3 rounded mt-2">
                                <p class="mb-1"><strong>Bank Mandiri</strong></p>
                                <p class="mb-1">No. Rek: <strong>0987654321</strong></p>
                                <p class="mb-0">A/n: <strong>PT CarBekasKu Indonesia</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Simulasi Kredit -->
                    <div class="card shadow mb-4" id="cardKredit" style="display:none;">
                        <div class="card-body">
                            <h6 class="font-weight-bold"><i class="fas fa-calculator mr-2"></i>Simulasi Kredit</h6>
                            <div class="form-group">
                                <label>Jangka Waktu</label>
                                <select id="tenor" class="form-control">
                                    <option value="12">1 Tahun (12x)</option>
                                    <option value="36">3 Tahun (36x)</option>
                                </select>
                            </div>
                            <div class="bg-light p-3 rounded">
                                <small>Angsuran per Bulan</small>
                                <h5 class="text-primary font-weight-bold" id="angsuran">Rp 0</h5>
                                <small class="text-muted">*Suku bunga 5% per tahun</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-7">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-4"><i class="fas fa-money-check-alt mr-2"></i>Konfirmasi Pembayaran</h5>

                            <form action="<?= site_url('home/proses_bayar') ?>" method="POST" enctype="multipart/form-data" id="formBayar">
                                <input type="hidden" name="id_pemesanan" value="<?= $pesanan->id_pemesanan ?>">
                                <input type="hidden" name="jumlah" id="jumlah_bayar" value="<?= $pesanan->harga ?>">

                                <!-- Pilih Metode -->
                                <label class="font-weight-bold">Pilih Metode Pembayaran</label>
                                <div class="row mb-4">
                                    <div class="col-4">
                                        <div class="card metode-card text-center p-3 active" data-metode="Transfer Bank" onclick="pilihMetode(this)">
                                            <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                            <small class="font-weight-bold">Transfer</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card metode-card text-center p-3" data-metode="Tunai" onclick="pilihMetode(this)">
                                            <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                            <small class="font-weight-bold">Tunai / COD</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card metode-card text-center p-3" data-metode="Kredit" onclick="pilihMetode(this)">
                                            <i class="fas fa-percentage fa-2x text-warning mb-2"></i>
                                            <small class="font-weight-bold">Kredit</small>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="metode" id="metode_input" value="Transfer Bank">

                                <!-- Upload Bukti (Transfer) -->
                                <div id="uploadSection">
                                    <div class="form-group">
                                        <label>Upload Bukti Transfer <span class="text-danger">*</span></label>
                                        <input type="file" name="bukti_bayar" class="form-control-file" accept="image/*" required>
                                        <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                                    </div>
                                </div>

                                <!-- Catatan COD -->
                                <div id="codNote" style="display:none;">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Pembayaran dilakukan saat mobil diantar. Admin akan menghubungi Anda untuk jadwal COD.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">
                                    <i class="fas fa-paper-plane mr-1"></i> Kirim Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="<?= base_url('jomo-html/jomo-html/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('jomo-html/jomo-html/js/bootstrap.js') ?>"></script>
    <script>
    var hargaMobil = <?= $pesanan->harga ?>;

    function pilihMetode(el) {
        // Hapus active dari semua
        document.querySelectorAll('.metode-card').forEach(c => c.classList.remove('active'));
        // Tambah active ke yang diklik
        el.classList.add('active');

        var metode = el.getAttribute('data-metode');
        document.getElementById('metode_input').value = metode;

        // Tampilkan/sembunyikan bagian terkait
        var uploadSection = document.getElementById('uploadSection');
        var cardRekening = document.getElementById('cardRekening');
        var cardKredit = document.getElementById('cardKredit');
        var codNote = document.getElementById('codNote');
        var formBayar = document.getElementById('formBayar');
        var buktiInput = document.querySelector('[name="bukti_bayar"]');

        if (metode === 'Transfer Bank') {
            uploadSection.style.display = 'block';
            cardRekening.style.display = 'block';
            cardKredit.style.display = 'none';
            codNote.style.display = 'none';
            buktiInput.required = true;
        } else if (metode === 'Tunai') {
            uploadSection.style.display = 'none';
            cardRekening.style.display = 'none';
            cardKredit.style.display = 'none';
            codNote.style.display = 'block';
            buktiInput.required = false;
        } else if (metode === 'Kredit') {
            uploadSection.style.display = 'none';
            cardRekening.style.display = 'none';
            cardKredit.style.display = 'block';
            codNote.style.display = 'none';
            buktiInput.required = false;
            hitungAngsuran();
        }
    }

    // Hitung angsuran kredit
    function hitungAngsuran() {
        var tenor = parseInt(document.getElementById('tenor').value);
        var bunga = 0.05; // 5% per tahun
        var tahun = tenor / 12;
        var total = hargaMobil + (hargaMobil * bunga * tahun);
        var angsuran = Math.ceil(total / tenor);
        document.getElementById('angsuran').innerHTML = 'Rp ' + angsuran.toLocaleString('id-ID');
        document.getElementById('jumlah_bayar').value = total;
    }

    document.getElementById('tenor').addEventListener('change', hitungAngsuran);

    // Set default: Transfer Bank
    pilihMetode(document.querySelector('.metode-card.active'));
    </script>
</body>
</html>