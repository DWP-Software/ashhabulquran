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
            <form method="POST" action="<?php echo base_url('/user/update'); ?>">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Username" class="form-control" id="username" name="username" value="<?= $user->username ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password Baru </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Password Baru" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">No Telepon </label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan No Telepon" class="form-control" id="telp" name="telp" value="<?= $user->telp ?>">
                    </div>
                </div>
                <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?= $this->endSection(); ?>