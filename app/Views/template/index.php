<?= $this->include('template/link_css'); ?>
<?= $this->include('template/header'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="/" class="brand-link" style="text-decoration: none;">
    <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Shohibul<b>Qur'an</b></span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if (session()->get('role') == 'Admin') { ?>
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php } ?>
        <?= $this->include('template/sidebar_admin'); ?>
        <?= $this->include('template/sidebar_pengajar'); ?>
        <?= $this->include('template/sidebar_santri'); ?>
        <?= $this->include('template/sidebar_pemilik'); ?>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a href="/auth/logout" class="nav-link">
            <i class="nav-icon fas fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 3000);
</script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $ket[0]; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <?php if (session()->get('role') == 'Admin') { ?>
              <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
            <?php } else { ?>
              <li class="breadcrumb-item"><a href="/profil">Profile</a></li>
            <?php }
            for ($i = 1; $i < count($ket); $i++) {
            ?>
              <?= $ket[$i]; ?>
            <?php } ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <?= $this->renderSection('content'); ?>
</div>
<?= $this->include('template/footer'); ?>
<?= $this->include('template/link_js'); ?>
<?php if (isset($link) and $link == 'chart') { ?>
  <?= $this->include('template/chart'); ?>
<?php } ?>
<?= $this->include('template/ambil'); ?>