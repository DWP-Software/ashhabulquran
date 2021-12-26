<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
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
                                <form action="/absens/input" method="POST">
                                    <div class="row mb-6">
                                        <div class="col-md-10">
                                            <?php if (session()->role != 'Admin') { ?>
                                                <select class="form-control select2bs4" name="id_kelas" required>
                                                    <option value="">Pilih Kelas </option>
                                                    <?php
                                                    foreach ($kelas as $p) {
                                                    ?>
                                                        <option value="<?php echo $p['id_kelas'] ?>"><?php echo $p['nama_kelas'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } else { ?>
                                                <select class="form-control select2bs4" name="id_kelas" required>
                                                    <option value="">Pilih Kelas </option>
                                                    <?php
                                                    foreach ($kelas as $p) {
                                                    ?>
                                                        <option value="<?php echo $p['id_kelas'] ?>"><?= $p['nama']; ?> - <?php echo $p['nama_kelas'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" style="margin: 5px;" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead class="" style="text-align: center;">
                                <tr>
                                    <th>

                                    </th>
                                    <th>Tanggal</th>
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Santri</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Alfa</th>
                                    <th>Sakit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                // for ($i = 0; $i < count($kelas); $i++) {
                                foreach ($getAbsen as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">

                                        </td>
                                        <td><?= $data['tanggal'] ?></td>
                                        <td><?= $data['nama_kelas'] ?></td>
                                        <td><?= $jml[$no - 1] ?> orang</td>
                                        <td><?= $hadir[$no - 1]['jml']; ?></td>
                                        <td><?= $izin[$no - 1]['jml']; ?></td>
                                        <td><?= $alfa[$no - 1]['jml']; ?></td>
                                        <td><?= $sakit[$no - 1]['jml']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('absens/edit/' . $data['id_kelas'] . '/' . $data['tanggal']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('absens/view/' . $data['id_kelas'] . '/' . $data['tanggal']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('/absens/delete/' . $data['id_kelas'] . '/' . $data['tanggal']); ?>" onclick="javascript:return confirm('Apakah Ingin Menghapus Data Ini?')" style="color: black;">
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
    </div>
</section>

<?= $this->endSection(); ?>