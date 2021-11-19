<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_profil')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_profil'); ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="row">
                        <div class="col-lg-3 col-md-5" style="padding: 3vh;">
                            <img style="width: 40vh;" src="/santriimg/<?= $user->foto; ?>">
                        </div>
                        <div class="col" style="padding: 3vh;">
                            <h3><b><?= $user->nama; ?></b></h3>
                            <table class="table">
                                <tr>
                                    <td>Username Santri</td>
                                    <td> : <?= $isi->username; ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor Santri</td>
                                    <td> : <?= $user->no_santri; ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat / Tanggal lahir</td>
                                    <td> : <?= $user->tempat_lahir; ?>/<?= date('d-m-Y', strtotime($user->tgl_lahir)); ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td> : <?= $user->jk; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> : <?= $user->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Hafalan</td>
                                    <td> : <?= $user->jml_hafalan; ?></td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td> : <?= $user->nohp; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td> : <?= date('d-m-Y', strtotime($user->tgl_masuk)); ?></td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-success">
                                <a href="<?php echo base_url('/profil/edit'); ?>" style="color: white;">
                                    <i class="far fa-edit"> Edit Profil</i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- /.content -->

<?= $this->endSection(); ?>