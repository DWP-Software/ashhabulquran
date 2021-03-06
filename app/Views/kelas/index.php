<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('kelas/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_kelas')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_kelas'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_kelas')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_kelas'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_kelas')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_kelas'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <?php if (session()->get('role') == 'Admin') { ?>
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" style="margin: 5px;" class="btn btn-success">
                                            <a href="<?php echo base_url('kelas/input'); ?>" style="color: white;">
                                                <i class="far fa-plus-square"> Tambah Data</i>
                                            </a>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="submit" style="margin: 5px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                            <i class="far fa-trash-alt"> Hapus Data Terpilih</i>
                                        </button>
                                    </li>
                                </ul>
                        </div>
                    <?php } ?>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="centangsemua">
                                    </th>
                                    <th>No</th>
                                    <th>ID Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Pengajar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getKelas as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_kelas[]" class="centang" value=" <?= $data['id_kelas']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['id_kelas']; ?></td>
                                        <td><?= $data['nama_kelas']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('/kelas/view/' . $data['id_kelas']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('kelas/edit/' . $data['id_kelas']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('kelas/delete/' . $data['id_kelas']); ?>" onclick="javascript:return confirm('Apakah Ingin Menghapus Data Ini?')" style="color: black;">
                                                <li class="far fa-trash-alt"></li>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th></th>
                                    <th style="width: 4vh;">No</th>
                                    <th>Nama</th>
                                    <th>Nama Kelas</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getKelasS as $data) {
                                ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['nama_kelas']; ?></td>
                                        <td></td>
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