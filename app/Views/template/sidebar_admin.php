<?php if (session()->get('role') == 'Admin') : ?>
    <li class="nav-item">
        <a href="<?php echo base_url('/pengajar'); ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
                Data Pengajar
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('/santri'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
                Data Santri
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('/kelas'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Data Kelas
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('/hafalan'); ?>" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
                Hafalan
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('/gaji'); ?>" class="nav-link">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
                Gaji
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
                Data Absensi
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/absen" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Absensi Pengajar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/absens" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Absensi Santri</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="<?= base_url() ?>/user/index" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
                Pengguna
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
                Website
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url() ?>/galeri/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Upload Galeri</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>/rumahtahfidz/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rumah Tahfidz</p>
                </a>
            </li>
        </ul>
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