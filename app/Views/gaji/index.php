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
                            <form method="POST" action="<?php echo base_url('/gaji/index'); ?>" enctype="multipart/form-data">
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
                                                <option value="<?= $i + 1 ?>"><?php echo $bulan[$i] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control select2bs4" name="tahun" required style="width: 120px;">
                                            <option value="">Pilih Tahun </option>
                                            <?php
                                            for ($i = 2021; $i <= date('Y'); $i++) {
                                            ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control select2bs4" name="id_pengajar" required style="width: 200px;">
                                            <option value="">Pilih Nama Pengajar </option>
                                            <?php
                                            foreach ($pengajar as $p) {
                                            ?>
                                                <option value="<?= $p['id_pengajar'] ?>"><?= $p['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($guru != NULL and $b != NULL and $y != NULL) { ?>
                            <div style="text-align: center;">
                                <h5><b>GAJI PENGAJAR</b></h5>
                                <h5><b>TAHUN <?= $y ?> BULAN <?= strtoupper($b) ?></b></h5>
                            </div>
                            <div>
                                <p>Nama : <?= $guru->nama; ?></p>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Banyak Pertemuan.</th>
                                    <td>:</td>
                                    <td><?= $gaji; ?> pertemuan</td>
                                </tr>
                                <tr>
                                    <th>Hafalan</th>
                                    <td>:</td>
                                    <td><?= $guru->jml_hafalan; ?> juz </td>
                                </tr>
                                <tr>
                                    <th>Total Gaji</th>
                                    <td>:</td>
                                    <td><b><u>Rp<?= number_format($tot, 2, ',', '.') ?></u></b></td>
                                </tr>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>