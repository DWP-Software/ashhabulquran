<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3><?= $getDatapengajar->nama; ?></h3>
                        <hr style="border: 1px solid">
                        <table>
                            <tr>
                                <td><img src="/pengajarimg/<?= $getDatapengajar->foto; ?>" alt="" style="height: 250px; padding: 1ch;"></td>
                                <td>
                                    <table>
                                        <tr>
                                            <th>No. Pengajar </th>
                                            <td> : <?= $getDatapengajar->no_pengajar; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat / Tanggal lahir </th>
                                            <td> : <?= $getDatapengajar->tempat_lahir; ?>/ <?= date('d-m-Y', strtotime($getDatapengajar->tgl_lahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td> : <?= $getDatapengajar->jk; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan Terakhir</th>
                                            <td> : <?= $getDatapengajar->pendidikan_terakhir; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td> : <?= $getDatapengajar->alamat; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Hafalan</th>
                                            <td> : <?= $getDatapengajar->jml_hafalan; ?> Juz</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Bergabung</th>
                                            <td> : <?= $getDatapengajar->thn_masuk; ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td> : <?= $getDatapengajar->nohp; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status / Sertifikasi</th>
                                            <td> : <?= $getDatapengajar->status; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <?php if ($getDatapengajar->keterangan == "Active") { ?>
                                                <td>: <span class="right badge badge-success">Active</span></td>
                                            <?php } else { ?>
                                                <td>: <span class="right badge badge-danger">Passive</span></td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
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