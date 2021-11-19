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
            <form method="POST" action="<?php echo base_url('/santri/add'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan tempat lahir" class="form-control" id="tempat_lahir" name="tempat_lahir">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="date" placeholder="Masukkan tanggal lahir" class="form-control" id="tgl_lahir" name="tgl_lahir">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="radio" name="jk" value="Laki - Laki" checked> Laki-laki<br>
                        <input autocomplete="off" type="radio" name="jk" value="Perempuan"> Perempuan<br>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pendidikan terakhir" class="form-control" id="pendidikan" name="pendidikan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat </label>
                    <div class="col-sm-10">
                        <textarea autocomplete="off" required placeholder="Masukkan alamat" class="form-control" id="alamat" name="alamat"> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nohp" class="col-sm-2 col-form-label">No. HP </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan no. hp" class="form-control" id="nohp" name="nohp" minlength="11">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jml_hafalan" class="col-sm-2 col-form-label">Jumlah Hafalan </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="number" placeholder="Masukkan jumlah hafalan" class="form-control" id="jml_hafalan" name="jml_hafalan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal Masuk </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="date" placeholder="Masukkan tanggal masuk" class="form-control" id="tgl_masuk" name="tgl_masuk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ayah" class="col-sm-2 col-form-label">Nama Ayah </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan nama ayah" class="form-control" id="nama_ayah" name="nama_ayah">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pekerjaan_ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pekerjaan ayah" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan nama ibu" class="form-control" id="nama_ibu" name="nama_ibu">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pekerjaan_ibu" class="col-sm-2 col-form-label">Pekerjaan Ibu </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan pekerjaan ibu" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nohp_ortu" class="col-sm-2 col-form-label">No. HP Orang Tua</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" required type="text" placeholder="Masukkan no. hp" class="form-control" id="nohp_ortu" minlength="11" name="nohp_ortu">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="/img/default.jpg" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey">Masukkan Gambar</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="kelas" required>
                            <option value="">Pilih Kelas </option>
                            <?php
                            foreach ($kelas as $kls) {
                            ?>
                                <option value="<?php echo $kls['id_kelas'] ?>"><?php echo $kls['nama_kelas'] ?> - <?php echo $kls['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>