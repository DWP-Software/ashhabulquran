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
            <form method="POST" action="<?php echo base_url('/rumahtahfidz/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="namart" class="col-sm-2 col-form-label">Nama Rumah Tahfidz</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control" id="namart" name="namart" value="<?= $rumahtahfidz->namart ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pemilik" class="col-sm-2 col-form-label">Pemilik</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control" id="pemilik" name="pemilik" value="<?= $rumahtahfidz->pemilik ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" class="textarea" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $rumahtahfidz->alamat ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control" id="email" name="email" value="<?= $rumahtahfidz->email ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp1" class="col-sm-2 col-form-label">No. Telepon 1</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control" id="telp1" name="telp1" value="<?= $rumahtahfidz->telp1 ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp2" class="col-sm-2 col-form-label">No. Telpeon 2</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" class="form-control" id="telp2" name="telp2" value="<?= $rumahtahfidz->telp2 ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="maps" class="col-sm-2 col-form-label">Maps</label>
                    <div class="col-sm-10">
                        <textarea name="maps" id="maps" class="form-control" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $rumahtahfidz->maps ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url() ?>/galeriimg/<?= $rumahtahfidz->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $rumahtahfidz->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey"><?= $rumahtahfidz->foto; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_rumahtahfidz" value="<?= $rumahtahfidz->id_rumahtahfidz ?>">
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>