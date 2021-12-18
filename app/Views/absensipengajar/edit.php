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
            <form method="POST" action="<?php echo base_url('/absen/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if (session()->get('role') == 'Admin') { ?>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-2 col-form-label">Nama Pengajar</label>
                        <div class="col-sm-10">
                            <select class="form-control select2bs4" name="id_kelas" required>
                                <option value="">Pilih Pengajar </option>
                                <?php
                                foreach ($pengajar as $p) {
                                ?>
                                    <option <?php if ($absen->id_kelas == $p['id_kelas']) {
                                                echo 'selected';
                                            } ?> value="<?= $p['id_kelas'] ?>"><?php echo $p['nama'] ?> - <?php echo $p['nama_kelas'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="ket" class="col-sm-2 col-form-label label">Status</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="radio" name="ket" value="Hadir" <?php if ($absen->keterangan == 'hadir') {
                                                                                            echo 'checked';
                                                                                        } ?>> Hadir
                        <input autocomplete="off" type="radio" name="ket" value="Alfa" <?php if ($absen->keterangan == 'alfa') {
                                                                                            echo 'checked';
                                                                                        } ?>> Alfa
                        <input autocomplete="off" type="radio" name="ket" value="Sakit" <?php if ($absen->keterangan == 'sakit') {
                                                                                            echo 'checked';
                                                                                        } ?>> Sakit
                        <input autocomplete="off" type="radio" name="ket" value="Izin" <?php if ($absen->keterangan == 'izin') {
                                                                                            echo 'checked';
                                                                                        } ?>> Izin
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url() ?>/absenimg/<?= $absen->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $absen->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey"><?= $absen->foto; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_absen" value="<?= $absen->id_absen ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>