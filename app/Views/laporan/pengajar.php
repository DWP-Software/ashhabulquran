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
                            <form method="POST" action="<?php echo base_url('/laporan/pengajar'); ?>" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-control select2bs4" name="tahun" required style="width: 120px;">
                                            <option value="">Pilih Tahun </option>
                                            <?php
                                            for ($i = 2010; $i <= date('Y'); $i++) {
                                            ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                            <?php if ($pengajar != NULL) { ?>
                                <div class="col">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url('/laporan/cetakpengajar'); ?>/<?= $t; ?>" target="_blank" style="color: white;">
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
                    <?php if ($pengajar != NULL) { ?>
                        <div style="text-align: center;">
                            <h5><b>DAFTAR PENGAJAR</b></h5>
                            <h5><b>RUMAH TAHFIZH SHOHIBUL QURAN</b></h5>
                            <h5><b>Koto tinggi pandaisikek kec. X koto Kabupaten Tanah Datar Sumbar</b></h5>
                            <h5><b>TAHUN AJARAN <?= $t ?> </b></h5>
                        </div>
                        <table class="table table-bordered">
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Tahun Masuk</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Jumlah Hafalan</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($pengajar as $p) { ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no ?></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= $p['jk'] ?></td>
                                    <td><?= $p['thn_masuk'] ?></td>
                                    <td><?= $p['alamat'] ?></td>
                                    <td><?= $p['nohp'] ?></td>
                                    <td><?php if ($p['jml_hafalan'] != NULL) {
                                            echo $p['jml_hafalan'] . ' juz';
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