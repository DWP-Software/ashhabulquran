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
                            <form method="POST" action="<?php echo base_url('/laporan/hafalan'); ?>" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col">
                                        <input value="<?= $date; ?>" type="date" name="tgl" class="form-control">
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
                                </div>
                            </form>
                            <?php if ($santri != NULL and $pengajar != NULL) { ?>
                                <div class="col">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url('/laporan/cetak_haf'); ?>/<?= $idk; ?>/<?= $date; ?>" target="_blank" style="color: white;">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </button>
                                </div>
                            <?php } ?>
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
                                <h5><b>LAPORAN HAFALAN SANTRI TIAP PERTEMUAN</b></h5>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    Kelas : <?= $k ?>
                                </div>
                                <div class="col">
                                    Bulan : <?= $b ?>
                                </div>
                                <div class="col">
                                    Tahun : <?= $y ?>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tr style="text-align: center;">
                                    <th>No.</th>
                                    <th>Nama Santri</th>
                                    <?php $no = 1;
                                    if ($tgl != NULL) {
                                        foreach ($tgl as $s) { ?>
                                            <th>Tanggal <?= $s ?></th>
                                    <?php }
                                        $no++;
                                    } ?>
                                </tr>
                                <?php $no = 1;
                                foreach ($san as $s) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $no ?></td>
                                        <td><?= $s['nama'] ?></td>
                                        <?php if ($data_san[$no - 1] != NULL) {
                                            foreach ($data_san[$no - 1] as $s) { ?>
                                                <td><?= $s['nama_surah'] ?> : <?= $s['awal_hafalan'] ?> - <?= $s['akhir_hafalan'] ?></td>
                                            <?php }
                                        } else {
                                            for ($i = 0; $i < count($tgl); $i++) {
                                            ?>
                                                <td><?= '-'; ?></td>
                                        <?php }
                                        } ?>
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