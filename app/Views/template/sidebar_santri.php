<?php if (session()->get('role') == 'Santri') : ?>
    <li class="nav-item">
        <a href="<?php echo base_url('/profil'); ?>" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profil
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
<?php endif; ?>