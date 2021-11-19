<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <?= form_open('user/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_user')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_user'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_user')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_user'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_user')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_user'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-newspaper mr-1"></i>
                            <?= $ket[0]; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#pemilik" data-toggle="tab">Pemilik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pengajar" data-toggle="tab">Pengajar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#santri" data-toggle="tab">Santri</a>
                                </li>
                                <li class="nav-item">
                                    <button type="submit" style="margin-left: 10px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus</i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane active" id="pemilik" style="position: relative; ">
                                <div style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('user/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </div>
                                <table id="example3" class="table table-bordered table-hover">
                                    <thead class="thead" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pemilik as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_user[]" class="centang" value="<?= $data['id_user']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id_user']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id_user']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="pengajar" style="position: relative; ">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="thead" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua2">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Nama</th>
                                            <th style="text-align:center">Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($pengajar as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_user[]" class="centang2" value="<?= $data['id_user']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <?php if ($data['nama'] == NULL) {
                                                    $x = '<span class="right badge badge-danger">User tidak terdaftar</span>';
                                                } else {
                                                    $x = $data['nama'];
                                                } ?>
                                                <td><?= $x ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id_user']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id_user']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="santri" style="position: relative; ">
                                <table id="kelas" class="table table-bordered table-hover">
                                    <thead class="thead" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua3">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Nama</th>
                                            <th style="text-align:center">Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($santri as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_user[]" class="centang3" value="<?= $data['id_user']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <?php if ($data['nama'] == NULL) {
                                                    $x = '<span class="right badge badge-danger">User tidak terdaftar</span>';
                                                } else {
                                                    $x = $data['nama'];
                                                } ?>
                                                <td><?= $x ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id_user']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id_user']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                        </div>
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
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>