<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('pengajar/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_pengajar')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_pengajar'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_pengajar')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_pengajar'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_pengajar')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_pengajar'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin: 5px;" class="btn btn-success">
                                        <a href="<?php echo base_url('pengajar/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="submit" style="margin: 5px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus Data Terpilih</i>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" style="margin: 5px;" class="btn btn-secondary">
                                        <a href="<?php echo base_url('pengajar/import'); ?>" style="color: white;">
                                            <i class="far fa-file"> Import Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="centangsemua">
                                    </th>
                                    <th>No</th>
                                    <th>No. Pengajar</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getDatapengajar as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_pengajar[]" class="centang" value=" <?= $data['id_pengajar']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['no_pengajar']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['nohp']; ?></td>
                                        <?php if ($data['keterangan'] == "Active") { ?>
                                            <td align="center"><span class="right badge badge-success">Active</span></td>
                                        <?php } else { ?>
                                            <td align="center"><span class="right badge badge-danger">Passive</span></td>
                                        <?php } ?>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('/pengajar/view/' . $data['id_pengajar']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('pengajar/edit/' . $data['id_pengajar']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('/pengajar/delete/' . $data['id_pengajar']); ?>" onclick="javascript:return confirm('Apakah Ingin Menghapus Data Ini?')" style="color: black;">
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
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>