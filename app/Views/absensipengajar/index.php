<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('absen/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_absen')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_absen'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_absen')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_absen'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_absen')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_absen'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin: 5px;" class="btn btn-success">
                                        <a href="<?php echo base_url('absen/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th>Tanggal</th>
                                    <!-- <th>Deskripsi</th> -->
                                    <th>Nama</th>
                                    <th>Nama Kelas</th>
                                    <th>Status</th>
                                    <?php if (session()->get('role') == 'Admin') { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getAbsen as $data) {
                                ?>
                                    <tr>
                                        <td><?= $data['tanggal']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['nama_kelas']; ?></td>
                                        <td><?= $data['keterangan']; ?></td>
                                        <?php if (session()->get('role') == 'Admin') { ?>
                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url('absen/edit/' . $data['id_absen']); ?>" style="color: black;">
                                                    <li class="far fa-edit"></li>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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