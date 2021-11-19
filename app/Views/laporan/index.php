<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_lap')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_lap'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_lap')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_lap'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_lap')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_lap'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <form method="POST" action="<?php echo base_url('/laporan/index'); ?>" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-control select2bs4" name="bulan" required style="width: 150px;">
                                            <option value="">Pilih Bulan </option>
                                            <?php
                                            $bulan = [
                                                'Januari', 'Februari', 'Maret', 'April', 'Mei',
                                                'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];
                                            for ($i = 0; $i < count($bulan); $i++) {
                                            ?>
                                                <option <?php if ($b[1] == $i + 1 and $santri != NULL and $pengajar != NULL) {
                                                            echo 'selected';
                                                        } ?> value="<?= $i + 1 ?>"><?php echo $bulan[$i] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control select2bs4" name="tahun" required style="width: 120px;">
                                            <option value="">Pilih Tahun </option>
                                            <?php
                                            for ($i = 2021; $i <= date('Y'); $i++) {
                                            ?>
                                                <option <?php if ($y == $i and $santri != NULL and $pengajar != NULL) {
                                                            echo 'selected';
                                                        } ?> value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control select2bs4" name="id_kelas" required style="width: 200px;">
                                            <option value="">Pilih Nama Kelas </option>
                                            <?php
                                            foreach ($kelas as $kls) {
                                            ?>
                                                <option <?php if ($idk == $kls['id_kelas'] and $santri != NULL and $pengajar != NULL) {
                                                            echo 'selected';
                                                        } ?> value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?> - <?= $kls['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                            <?php if ($santri != NULL and $pengajar != NULL) { ?>
                                <div class="col">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url('/laporan/cetak'); ?>/<?= $b[1]; ?>/<?= $y; ?>/<?= $idk; ?>" target="_blank" style="color: white;">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('warning')) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('warning'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($santri != NULL and $pengajar != NULL) { ?>
                        <div style="text-align: center;">
                            <h5><b>KELAS SANTRI TAHFIZH</b></h5>
                            <h5><b>RUMAH TAHFIZH SHOHIBUL QURAN</b></h5>
                            <h5><b>KELAS SANTRI TAHFIZH</b></h5>
                            <h5><b>Koto tinggi pandaisikek kec. X koto Kabupaten Tanah Datar Sumbar</b></h5>
                            <h5><b>TAHUN AJARAN <?= $y ?> BULAN <?= strtoupper($b[0]) ?></b></h5>
                        </div>
                        <div class="col">
                            <p>Pembimbing : <?= $pengajar ?></p>
                            <p>Kelas : <?= $k ?></p>
                        </div>
                        <table class="table table-bordered">
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Nama Santri</th>
                                <th>Usia</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>No. HP Ayah</th>
                                <th>No. HP Ibu</th>
                                <th>Jumlah Hafalan</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($santri as $s) { ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no ?></td>
                                    <td><?= $s['nama'] ?></td>
                                    <td><?php if ($s['tgl_lahir'] != NULL) {
                                            echo (date('Y') - $s['tgl_lahir']) . ' tahun';
                                        } ?></td>
                                    <td><?= $s['jk'] ?></td>
                                    <td><?= $s['alamat'] ?></td>
                                    <td><?= $s['nohp_ortu'] ?></td>
                                    <td><?= $s['nohp_ortu'] ?></td>
                                    <td><?php if ($s['jml_hafalan'] != NULL) {
                                            echo $s['jml_hafalan'] . ' juz';
                                        } ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?= $this->endSection(); ?>