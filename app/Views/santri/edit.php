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
            <form method="POST" action="<?php echo base_url('/santri/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" value="<?= $santri->nama ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan tempat lahir" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $santri->tempat_lahir ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="date" placeholder="Masukkan tanggal lahir" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $santri->tgl_lahir ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="radio" name="jk" value="Laki - Laki" <?php if ($santri->jk == 'Laki - Laki') echo 'checked' ?>> Laki-laki<br>
                        <input type="radio" name="jk" value="Perempuan" <?php if ($santri->jk == 'Perempuan') echo 'checked' ?>> Perempuan<br>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pendidikan terakhir" class="form-control" id="pendidikan" name="pendidikan" value="<?= $santri->pendidikan ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat </label>
                    <div class="col-sm-10">
                        <textarea autocomplete="off" required placeholder="Masukkan alamat" class="form-control" id="alamat" name="alamat"><?= $santri->alamat ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nohp" class="col-sm-2 col-form-label">No. HP </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan no. hp" class="form-control" id="nohp" name="nohp" minlength="11" value="<?= $santri->nohp ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_hafalan" class="col-sm-2 col-form-label">Jumlah Hafalan </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="number" placeholder="Masukkan jumlah hafalan" class="form-control" id="jml_hafalan" name="jml_hafalan" value="<?= $santri->jml_hafalan ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="date" placeholder="Masukkan tanggal masuk" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $santri->tgl_masuk ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ayah" class="col-sm-2 col-form-label">Nama Ayah </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan nama ayah" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $santri->nama_ayah ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pekerjaan_ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pekerjaan ayah" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= $santri->pekerjaan_ayah ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan nama ibu" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $santri->nama_ibu ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pekerjaan_ibu" class="col-sm-2 col-form-label">Pekerjaan Ibu </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pekerjaan ibu" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= $santri->pekerjaan_ibu ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nohp_ortu" class="col-sm-2 col-form-label">No. HP Orang Tua</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan no. hp" class="form-control" id="nohp_ortu" minlength="11" name="nohp_ortu" value="<?= $santri->nohp_ortu ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url() ?>/santriimg/<?= $santri->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $santri->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey"><?= $santri->foto; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Nama Nelas</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="kelas" required>
                            <option value="">Pilih Kelas </option>
                            <?php
                            foreach ($kelas as $kelas) {
                            ?>
                                <option <?php if ($kls->id_kelas == $kelas['id_kelas']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $kelas['id_kelas'] ?>"><?php echo $kelas['nama_kelas'] ?> - <?php echo $kelas['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_santri" value="<?= $santri->id_santri ?>">
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>