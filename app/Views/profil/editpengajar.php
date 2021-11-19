<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <form method="POST" action="<?php echo base_url('/profil/update'); ?>" enctype="multipart/form-data">
        <div class="card">
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan Username" class="form-control" id="username" name="username" value="<?= $user->username ?>">
                    </div>
                </div>
                <?php if (password_verify('123', $user->password) or password_verify('12345678', $user->password)) { ?>
                    <div class="row mb-3">
                        <label for="pass" class="col-sm-2 col-form-label">Password Baru </label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" placeholder="Masukkan Password Baru" class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                <?php } ?>
                <input type="hidden" name="id_pengajar" value="<?= $pengajar->id_pengajar ?>">
            </div>
            <!-- /.row -->
        </div>
        <div class="card">
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="no_pengajar" class="col-sm-2 col-form-label">Nomor Pengajar </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" readonly type="text" placeholder="Masukkan Nomor Pengajar" class="form-control" id="no_pengajar" name="no_pengajar" value="<?= $pengajar->no_pengajar ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" value="<?= $pengajar->nama ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan tempat lahir" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $pengajar->tempat_lahir ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="date" placeholder="Masukkan tanggal lahir" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $pengajar->tgl_lahir ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="radio" name="jk" value="Laki - Laki" <?php if ($pengajar->jk == 'Laki - Laki') echo 'checked' ?>> Laki-laki<br>
                        <input type="radio" name="jk" value="Perempuan" <?php if ($pengajar->jk == 'Perempuan') echo 'checked' ?>> Perempuan<br>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pendidikan_terakhir" class="col-sm-2 col-form-label">Pendidikan Terakhir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pendidikan terakhir" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="<?= $pengajar->pendidikan_terakhir ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat </label>
                    <div class="col-sm-10">
                        <textarea autocomplete="off" required placeholder="Masukkan alamat" class="form-control" id="alamat" name="alamat"><?= $pengajar->alamat ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_hafalan" class="col-sm-2 col-form-label">Jumlah Hafalan </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="number" placeholder="Masukkan jumlah hafalan" class="form-control" id="jml_hafalan" name="jml_hafalan" value="<?= $pengajar->jml_hafalan ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="thn_masuk" class="col-sm-2 col-form-label">Tahun Masuk </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" readonly type="text" placeholder="Masukkan tahun masuk" class="form-control" id="thn_masuk" name="thn_masuk" value="<?= $pengajar->thn_masuk ?>" maxlength="4">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nohp" class="col-sm-2 col-form-label">No. HP </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan no. hp" class="form-control" id="nohp" name="nohp" minlength="11" value="<?= $pengajar->nohp ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url() ?>/pengajarimg/<?= $pengajar->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $pengajar->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey"><?= $pengajar->foto; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status / Sertifikasi </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan status / sertifikasi" class="form-control" id="status" name="status" value="<?= $pengajar->status ?>">
                    </div>
                </div>
                <input type="hidden" name="id_pengajar" value="<?= $pengajar->id_pengajar ?>">
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
            <!-- /.row -->
        </div>
    </form>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>