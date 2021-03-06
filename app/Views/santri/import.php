<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('warning_santri')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_santri'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-import mr-1"></i>
                            <?= $ket[0]; ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <h4><b>Format Excel</b></h4>
                            <p>No | Nama | Jenis Kelamin | No HP | Tanggal Masuk | ID Kelas</p>
                        </div>
                        <?php
                        echo form_open_multipart('santri/proses');
                        ?>
                        <div class="form-group">
                            <label>Import File Excel (.xls atau .xlsx)</label>
                            <input type="file" name="file_excel" class="form-control" accept=".xls, .xlsx" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Import Data</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>