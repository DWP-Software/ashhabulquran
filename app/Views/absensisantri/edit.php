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
            <form method="POST" action="<?php echo base_url('/absens/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if (session()->get('role') == 'Admin') { ?>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-2 col-form-label">Nama Santri</label>
                        <div class="col-sm-10">
                            <select class="form-control select2bs4" name="id_kelas" required>
                                <option value="">Pilih Santri </option>
                                <?php
                                foreach ($santri as $p) {
                                ?>
                                    <option <?php if ($absen->id_kelas == $p['id_kelas']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $p['id_kelas'] ?>"><?php echo $p['nama'] ?> - <?php echo $p['nama_kelas'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="ket" class="col-sm-2 col-form-label label">Status</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="radio" name="ket" value="Hadir" <?php if ($absen->keterangan == 'Hadir') {
                                                                                            echo 'checked';
                                                                                        } ?>> Hadir
                        <input autocomplete="off" type="radio" name="ket" value="Alfa" <?php if ($absen->keterangan == 'Alfa') {
                                                                                            echo 'checked';
                                                                                        } ?>> Alfa
                        <input autocomplete="off" type="radio" name="ket" value="Sakit" <?php if ($absen->keterangan == 'Sakit') {
                                                                                            echo 'checked';
                                                                                        } ?>> Sakit
                        <input autocomplete="off" type="radio" name="ket" value="Izin" <?php if ($absen->keterangan == 'Izin') {
                                                                                            echo 'checked';
                                                                                        } ?>> Izin
                    </div>
                </div>
                <input type="hidden" name="id_absen" value="<?= $absen->id_absen ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>