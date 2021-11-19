<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3><?= $kelas->nama_kelas; ?></h3>
                        <hr style="border: 1px solid">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 20%;">Nama Pengajar</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td><?= $kelas->nama; ?></td>
                                <td><?= $kelas->keterangan_kelas; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>