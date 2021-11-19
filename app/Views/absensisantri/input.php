<?= $this->extend('template/index'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="card">
        <div class="container-fluid card-body">
            <form method="POST" action="<?php echo base_url('/absens/add'); ?>">
                <?= csrf_field(); ?>
                <table id="table" class="table table-bordered">
                    <thead class="" style="text-align: center;">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($santri as $data) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><input type="hidden" name="id_santri[]" value="<?= $data['id_santri']; ?>"><?= $data['nama']; ?></td>
                                <td>
                                    <input autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Hadir" checked> Hadir
                                    <input autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Alfa"> Alfa
                                    <input autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Sakit"> Sakit
                                    <input autocomplete="off" type="radio" name="ket<?= $data['id_santri']; ?>" value="Izin"> Izin
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>