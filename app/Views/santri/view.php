<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3><?= $getDatasantri->nama; ?></h3>
                        <hr style="border: 1px solid">
                        <table>
                            <tr>
                                <td><img src="/santriimg/<?= $getDatasantri->foto; ?>" alt="" style="height: 250px; padding: 1ch;"></td>
                                <td>
                                    <table>
                                        <tr>
                                            <th>No. Santri </th>
                                            <td> : <?= $getDatasantri->no_santri; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat / Tanggal lahir </th>
                                            <td> : <?= $getDatasantri->tempat_lahir; ?>/ <?= date('d-m-Y', strtotime($getDatasantri->tgl_lahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td> : <?= $getDatasantri->jk; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <td> : <?= $getDatasantri->pendidikan; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td> : <?= $getDatasantri->alamat; ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td> : <?= $getDatasantri->nohp; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Hafalan</th>
                                            <td> : <?= $getDatasantri->jml_hafalan; ?> Juz</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk</th>
                                            <td> : <?= date('d-m-Y', strtotime($getDatasantri->tgl_masuk)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Ayah</th>
                                            <td> : <?= $getDatasantri->nama_ayah; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan Ayah</th>
                                            <td> : <?= $getDatasantri->pekerjaan_ayah; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Ibu</th>
                                            <td> : <?= $getDatasantri->nama_ibu; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan Ibu</th>
                                            <td> : <?= $getDatasantri->pekerjaan_ibu; ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. HP Orang Tua</th>
                                            <td> : <?= $getDatasantri->nohp_ortu; ?></td>
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