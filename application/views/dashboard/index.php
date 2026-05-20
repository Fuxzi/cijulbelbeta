<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</h1>
    </div>

    <!-- Kartu Statistik -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mobil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mobil ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-car fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mobil Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_tersedia ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_transaksi ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mobil Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_terjual ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-handshake fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart + Tabel Terbaru -->
    <div class="row">
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Mobil per Merek</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartMerek" height="80"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Penjual / Dealer</span>
                        <span class="font-weight-bold"><?= $total_penjual ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Pembeli Terdaftar</span>
                        <span class="font-weight-bold"><?= $total_pembeli ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Mobil Tersedia</span>
                        <span class="badge badge-success"><?= $total_tersedia ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Mobil Terjual</span>
                        <span class="badge badge-danger"><?= $total_terjual ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Mobil Terbaru -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Mobil Terbaru Masuk</h6>
            <a href="<?= site_url('mobil') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Mobil</th>
                            <th>Merek</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($mobil_terbaru): foreach ($mobil_terbaru as $m): ?>
                        <tr>
                            <td><?= $m->nama_mobil ?></td>
                            <td><?= $m->merek ?></td>
                            <td><?= $m->tahun ?></td>
                            <td>Rp <?= number_format($m->harga, 0, ',', '.') ?></td>
                            <td>
                                <span class="badge badge-<?= strtolower($m->status) ?>">
                                    <?= $m->status ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center text-muted">Belum ada data mobil</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!-- end container-fluid -->

<script>
var ctx = document.getElementById('chartMerek').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= $chart_label ?>,
        datasets: [{
            label: 'Jumlah Mobil',
            data: <?= $chart_data ?>,
            backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e','#e74a3b','#858796','#5a5c69'],
        }]
    },
    options: { responsive: true, scales: { yAxes: [{ ticks: { beginAtZero: true } }] } }
});
</script>
