<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('hafalan/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Perkembangan Hafalan Santri</h4>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Setor</th>
                                    <th>Surah (Juz)</th>
                                    <th>Awal Hafalan</th>
                                    <th>Akhir Hafalan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getHafalan as $data) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['tgl_setor']; ?></td>
                                        <td><?= $data['nama_surah']; ?> (Juz <?= $data['juz']; ?>)</td>
                                        <td><?= $data['awal_hafalan']; ?></td>
                                        <td><?= $data['akhir_hafalan']; ?></td>
                                        <td><?= $data['status']; ?></td>
                                    </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
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

<?= $this->endSection(); ?>