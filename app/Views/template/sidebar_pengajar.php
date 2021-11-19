<?php if (session()->get('role') == 'Pengajar') : ?>
    <li class="nav-item">
        <a href="<?php echo base_url('/profil'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profil
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
        <a href="<?php echo base_url('/hafalan'); ?>" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
                Hafalan
            </p>
        </a>
    </li>
<?php endif; ?>