<?php if (session()->get('role') == 'Pemilik') : ?>
    <li class="nav-item">
        <a href="<?php echo base_url('/home'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url() ?>/laporan/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Santri</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>/laporan/pengajar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Pengajar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>/laporan/hafalan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Hafalan Harian</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>/laporan/juz" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Hafalan per Juz</p>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>