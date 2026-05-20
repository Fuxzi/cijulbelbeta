            </div><!-- end #content -->
        </div><!-- end #content-wrapper -->
    </div><!-- end #wrapper -->

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <script>
        // Inisialisasi DataTable jika ada tabel dengan class .dataTable
        $(document).ready(function() {
            if ($('.dataTable').length) {
                $('.dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                    }
                });
            }
        });
    </script>

    <?php // Slot untuk script tambahan per halaman ?>
    <?php if (isset($extra_js)) echo $extra_js; ?>

</body>
</html>
