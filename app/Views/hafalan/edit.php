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
            <form method="POST" action="<?php echo base_url('/hafalan/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if (session()->get('role') != 'Santri') { ?>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                        <div class="col-sm-10">
                            <select onchange="kelas()" class="form-control select2bs4" name="id_kelas" id="id_kelas" required>
                                <option value="">Pilih Nama Kelas </option>
                                <?php
                                foreach ($kelas as $kls) {
                                ?>
                                    <option <?php if ($k->id_kelas == $kls['id_kelas']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $kls['id_kelas'] ?>"><?php echo $kls['nama_kelas'] ?> - <?= $kls['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_santri" class="col-sm-2 col-form-label">Nama Santri</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_santri" id="id_santri" required>
                                <option value="">Pilih Nama Santri </option>
                                <?php
                                foreach ($santri as $s) {
                                ?>
                                    <option <?php if ($hafalan->id_santri == $s['id_santri']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $s['id_santri'] ?>"><?php echo $s['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="tgl_setor" class="col-sm-2 col-form-label">Tanggal Setor</label>
                    <div class="col-sm-10">
                        <input value="<?= $hafalan->tgl_setor; ?>" autocomplete="off" required type="date" placeholder="Masukkan Tanggal " class="form-control" id="tgl_setor" name="tgl_setor">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_surah" class="col-sm-2 col-form-label">Nama Surah</label>
                    <div class="col-sm-10">
                        <select onchange="surah()" class="form-control" name="id_surah" id="id_surah" required>
                            <option value="">Pilih Nama Surah </option>
                            <?php
                            foreach ($surah as $srh) {
                            ?>
                                <option <?php if ($hafalan->id_surah == $srh['id_surah']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $srh['id_surah'] ?>"><?php echo $srh['nama_surah'] ?> - Juz <?php echo $srh['juz'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="awal" class="col-sm-2 col-form-label">Awal Ayat</label>
                    <div class="col-sm-10">
                        <input value="<?= $hafalan->awal_hafalan; ?>" autocomplete="off" type="text" placeholder="Masukkan Awal Hafalan " class="form-control" id="awal" name="awal">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="akhir" class="col-sm-2 col-form-label">Akhir Ayat</label>
                    <div class="col-sm-10">
                        <input value="<?= $hafalan->akhir_hafalan; ?>" autocomplete="off" required type="text" placeholder="Masukkan Akhir Hafalan " class="form-control" id="akhir" name="akhir">
                    </div>
                </div>
                <?php if (session()->get('role') != 'Santri') { ?>
                    <div class="row mb-3">
                        <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="ket" class="form-control" id="ket" cols="30" rows="5"><?= $hafalan->keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="radio" name="status" value="Belum Selesai" <?php if ($hafalan->status == 'Belum Selesai') {
                                                                                                            echo 'checked';
                                                                                                        } ?>> Belum Selesai<br>
                            <input autocomplete="off" type="radio" name="status" value="Selesai" <?php if ($hafalan->status == 'Selesai') {
                                                                                                        echo 'checked';
                                                                                                    } ?>> Selesai<br>
                        </div>
                    </div>
                <?php } ?>
                <input type="hidden" name="id_hafalan" id="id_hafalan" value="<?= $hafalan->id_hafalan; ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<?= $this->endSection(); ?>