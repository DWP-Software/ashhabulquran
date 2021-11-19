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
                            <form method="POST" action="<?php echo base_url('/laporan/juz'); ?>" enctype="multipart/form-data">
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
                                                <option <?php if ($b[1] == $i + 1 and $b != NULL and $y != NULL) {
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
                                                <option <?php if ($y == $i and $b != NULL and $y != NULL) {
                                                            echo 'selected';
                                                        } ?> value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                            <?php if ($b != NULL and $y != NULL) { ?>
                                <div class="col">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url('/laporan/cetak_juz'); ?>/<?= $b[1]; ?>/<?= $y; ?>" target="_blank" style="color: white;">
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
                    <?php if ($b != NULL and $y != NULL) { ?>
                        <div style="text-align: center;">
                            <h5><b>LAPORAN HAFALAN SANTRI PER JUZ</b></h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                Bulan : <?= $b[1] ?>
                            </div>
                            <div class="col">
                                Tahun : <?= $y ?>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr style="text-align: center;">
                                <th>Juz</th>
                                <th>Jumlah Santri</th>
                            </tr>
                            <?php for ($i = 0; $i < 30; $i++) { ?>
                                <tr style="text-align: center;">
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $santri[$i] ?> santri</td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?= $this->endSection(); ?>