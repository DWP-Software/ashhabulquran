<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('hafalan/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_hafalan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_hafalan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_hafalan')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_hafalan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_hafalan')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_hafalan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin: 5px;" class="btn btn-success">
                                        <a href="<?php echo base_url('hafalan/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="submit" style="margin: 5px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus Data Terpilih</i>
                                    </button>
                                </li>
                                <?php if (session()->get('role') == 'Santri') { ?>
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-secondary" style="margin:5px">
                                            <a href="<?php echo base_url('hafalan/hafalansantri'); ?>" style="color: white;">
                                                <i class="far fa-diagrams"> Perkembangan</i>
                                            </a>
                                        </button>
                                    </li>
                                <?php } ?>
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
                                    <th>Nama Santri</th>
                                    <th>Tanggal Setor</th>
                                    <th>Surah (Juz)</th>
                                    <th>Akhir Hafalan</th>
                                    <th>Status</th>
                                    <th>Ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getHafalan as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_hafalan[]" class="centang" value=" <?= $data['id_hafalan']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['tgl_setor']; ?></td>
                                        <td><?= $data['nama_surah']; ?> (Juz <?= $data['juz']; ?>)</td>
                                        <td><?= $data['akhir_hafalan']; ?></td>
                                        <td><?= $data['status']; ?></td>
                                        <td><?= $data['dibuat']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('/hafalan/view/' . $data['id_hafalan']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('hafalan/edit/' . $data['id_hafalan']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('hafalan/delete/' . $data['id_hafalan']); ?>" onclick="javascript:return confirm('Apakah Ingin Menghapus Data Ini?')" style="color: black;">
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