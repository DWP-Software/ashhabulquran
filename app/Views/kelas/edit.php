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
            <form method="POST" action="<?php echo base_url('/kelas/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan Nama Kelas" class="form-control" id="nama" name="nama" value="<?= $kelas->nama_kelas ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="ket" id="ket" class="textarea" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $kelas->keterangan_kelas ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengajar" class="col-sm-2 col-form-label">Nama Pengajar</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="pengajar" id="pengajar" required>
                            <option value="">Pilih Pengajar </option>
                            <?php
                            foreach ($pengajar as $pengajar) {
                            ?>
                                <option value="<?php echo $pengajar['id_pengajar'] ?>" <?php if ($kelas->id_pengajar == $pengajar['id_pengajar']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $pengajar['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas ?>">
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>