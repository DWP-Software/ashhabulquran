<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('rumahtahfidz/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_rumahtahfidz')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_rumahtahfidz'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_rumahtahfidz')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_rumahtahfidz'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_rumahtahfidz')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_rumahtahfidz'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php
                foreach ($getRumahtahfidz as $rt) {
                ?>
                    <div style="height: 50px;">
                        <button type="button" class="btn btn-success">
                            <a href="<?php echo base_url('rumahtahfidz/edit/' . $rt['id_rumahtahfidz']); ?>" style="color: white;">
                                <li class="far fa-edit"> Edit Data</li>
                            </a>
                        </button>
                    </div>
                    <div class="row card">
                        <div class="col card-body">
                            <img src="/galeriimg/<?= $rt['foto']; ?>" alt="" style="height: 250px; padding: 1ch;">
                            <table class="table">
                                <tr>
                                    <td class="col-sm-2"></i> Rumah Tahfidz</td>
                                    <td> : </td>
                                    <td><?= $rt['namart'] ?></td>
                                </tr>
                                <tr>
                                    <td> Pemilik</td>
                                    <td> : </td>
                                    <td><?= $rt['pemilik'] ?></td>
                                </tr>
                                <tr>
                                    <td> Alamat</td>
                                    <td> : </td>
                                    <td><?= $rt['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td> Email</td>
                                    <td> : </td>
                                    <td><?= $rt['email'] ?></td>
                                </tr>
                                <tr>
                                    <td> No. Telepon 1 </td>
                                    <td> : </td>
                                    <td><?= $rt['telp1'] ?></td>
                                </tr>
                                <tr>
                                    <td> No. Telepon 2</td>
                                    <td> : </td>
                                    <td><?= $rt['telp2'] ?></td>
                                </tr>
                                <tr>
                                    <td> Maps</td>
                                    <td> : </td>
                                    <td><?= $rt['maps']; ?></td>
                                </tr>
                            <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>