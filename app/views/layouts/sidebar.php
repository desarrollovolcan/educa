<?php
// -----------------------------------------------------------------------------
// Sidebar de navegación principal.
// Contiene accesos mínimos requeridos.
// -----------------------------------------------------------------------------
?>
<div class="leftside-menu">
    <!-- Logo en sidebar -->
    <a href="<?php echo BASE_URL; ?>/dashboard" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="<?php echo PUBLIC_URL; ?>/assets/images/logo-light.png" alt="logo" height="22">
        </span>
        <span class="logo-sm">
            <img src="<?php echo PUBLIC_URL; ?>/assets/images/logo-sm.png" alt="logo" height="24">
        </span>
    </a>

    <a href="<?php echo BASE_URL; ?>/dashboard" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="<?php echo PUBLIC_URL; ?>/assets/images/logo-dark.png" alt="logo" height="22">
        </span>
        <span class="logo-sm">
            <img src="<?php echo PUBLIC_URL; ?>/assets/images/logo-sm.png" alt="logo" height="24">
        </span>
    </a>

    <div class="h-100" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-title">Menú</li>
            <li class="side-nav-item">
                <a href="<?php echo BASE_URL; ?>/dashboard" class="side-nav-link">
                    <i class="bx bx-home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="<?php echo BASE_URL; ?>/logout" class="side-nav-link">
                    <i class="bx bx-log-out"></i>
                    <span> Cerrar sesión </span>
                </a>
            </li>
        </ul>
    </div>
</div>
