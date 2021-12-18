<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-header">
            <!-- <div class="card-title"> -->
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>Jumlah Siswa</td>
                            <td> : <?= $jml; ?> orang</td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <td>Nama Kelas</td>
                            <td> : <?= $kelas->nama_kelas; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <a href="<?= base_url() . '/absens/edit/' . $kelas->id_kelas . '/' . $tgl ?>" class="btn btn-primary" role="button">Edit Data</a>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <div class="container-fluid card-body">
            <table id="table" class="table table-bordered">
                <thead class="" style="text-align: center;">
                    <tr>
                        <th>No</th>
                        <th>Nama Santri</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($absen as $data) {
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['keterangan']; ?></td>
                        </tr>
                        <input type="hidden" name="id_absen[]" value="<?= $data['id_absen']; ?>">
                        <input type="hidden" name="id_san[]" value="<?= $data['id_santri']; ?>">
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>