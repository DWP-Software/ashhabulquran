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
        <div class="container-fluid card-body">
            <form method="POST" action="<?php echo base_url('/absens/update'); ?>">
                <?= csrf_field(); ?>
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
                                <td><input type="hidden" name="id_santri[]" value="<?= $data['id_santri']; ?>"><?= $data['nama']; ?></td>
                                <td>
                                    <input <?php if ($data['keterangan'] == 'hadir') {
                                                echo 'checked';
                                            } ?> autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Hadir"> Hadir
                                    <input <?php if ($data['keterangan'] == 'alfa') {
                                                echo 'checked';
                                            } ?> autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Alfa"> Alfa
                                    <input <?php if ($data['keterangan'] == 'sakit') {
                                                echo 'checked';
                                            } ?> autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Sakit"> Sakit
                                    <input <?php if ($data['keterangan'] == 'izin') {
                                                echo 'checked';
                                            } ?> autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Izin"> Izin
                                </td>
                            </tr>
                            <input type="hidden" name="id_absen[]" value="<?= $data['id_absen']; ?>">
                            <input type="hidden" name="id_san[]" value="<?= $data['id_santri']; ?>">
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>