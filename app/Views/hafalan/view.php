<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <hr style="border: 1px solid">
                        <table>
                            <tr>
                                <td>Hafalan</td>
                                <td> : </td>
                                <td><?= $hafalan->nama_surah; ?> : <?= $hafalan->awal_hafalan; ?> - <?= $hafalan->akhir_hafalan; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Setor</td>
                                <td> : </td>
                                <td><?= $hafalan->tgl_setor; ?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td> : </td>
                                <td><?= $hafalan->keterangan; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td> : </td>
                                <td><b><u><?= $hafalan->status; ?></u></b></td>
                            </tr>
                            <tr>
                                <td>Ditambahkan</td>
                                <td> : </td>
                                <td><b><u><?= $hafalan->dibuat; ?></u></b></td>
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