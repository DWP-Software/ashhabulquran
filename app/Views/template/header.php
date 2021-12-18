<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <?php if (session()->get('role') == 'Admin') {
                        $link = 'home';
                    } else {
                        $link = 'profil';
                    } ?>
                    <a href="/<?= $link; ?>" class="nav-link">Rumah Tahfidz <b>Shohibul Qur'an</b></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <?= session()->get('nama') ?>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url(); ?>/profil" class="dropdown-item">View Profile </a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="<?= base_url() ?>/auth/logout" class="dropdown-item">Logout</a></li>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->