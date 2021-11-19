<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $pengajar; ?></h3>
                        <p>Pengajar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <?php if (session()->get('role') != 'Pemilik') { ?>
                        <a href="<?= base_url() ?>/pengajar/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $santri; ?></h3>
                        <p>Santri</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <?php if (session()->get('role') != 'Pemilik') { ?>
                        <a href="<?= base_url() ?>/santri/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success" <?php if (session()->get('role') != 'Pemilik') { ?>style="height: 143px;" <?php } ?>>
                    <div class="inner">
                        <h3><?= $santri_pr; ?></h3>
                        <p>Santri Perempuan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning" <?php if (session()->get('role') != 'Pemilik') { ?>style="height: 143px;" <?php } ?>>
                    <div class="inner">
                        <h3><?= $santri_lk; ?></h3>
                        <p>Santri Laki - Laki</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php if (session()->get('role') != 'Pemilik') { ?>
            <div class="row" style="padding-bottom: 10px;">
                <?php foreach ($gambar as $g) { ?>
                    <div class="col-lg-3 col-6">
                        <img style="max-width: 100%;" src="<?= base_url() ?>/galeriimg/<?= $g['foto'] ?>" alt="">
                        <?= $g['nama_kegiatan'] ?>
                    </div>
                <?php } ?>
                <div class="col-lg-3 col-6" style="padding: 5px;">
                    <button type="button" class="btn btn-outline-dark">
                        <a href="<?= base_url() ?>/galeri/input" style="text-decoration: none;color:grey;">Tambah Foto <i class="fas fa-plus"></i></a>
                    </button>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">Jumlah Santri</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="bar" style="min-height: 305px; height: 305px; max-height: 305px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">Daftar Hafalan Santri</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="line" style="min-height: 305px; height: 305px; max-height: 305px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>