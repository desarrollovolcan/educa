<?php
// -----------------------------------------------------------------------------
// Vista del dashboard inicial.
// Muestra métricas básicas y saludo al usuario.
// -----------------------------------------------------------------------------

// Definir título de la página.
$title = 'Dashboard - Go Educa';

// Incluir cabecera general.
include __DIR__ . '/../layouts/header.php';
?>
<body>

<!-- Wrapper principal -->
<div class="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . '/../layouts/sidebar.php'; ?>

    <!-- Contenido principal -->
    <div class="content-page">
        <!-- Navbar -->
        <?php include __DIR__ . '/../layouts/navbar.php'; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>

                <!-- Bienvenida -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Bienvenido <?php echo htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                <p class="mb-1">Rol: <?php echo htmlspecialchars($user['rol'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="mb-0">Último acceso: <?php echo htmlspecialchars($lastLoginAt ?? 'Sin registro', ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Métricas principales -->
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                                            <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"
                                                          class="fs-32 text-success avatar-title"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Usuarios</p>
                                        <h3 class="text-dark mt-1 mb-0"><?php echo (int)$totalUsers; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                                            <iconify-icon icon="solar:building-bold-duotone"
                                                          class="fs-32 text-primary avatar-title"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Tenants</p>
                                        <h3 class="text-dark mt-1 mb-0"><?php echo (int)$totalTenants; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                                            <iconify-icon icon="solar:key-minimalistic-bold-duotone"
                                                          class="fs-32 text-warning avatar-title"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Roles</p>
                                        <h3 class="text-dark mt-1 mb-0"><?php echo (int)$totalRoles; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-md bg-light bg-opacity-50 rounded">
                                            <iconify-icon icon="solar:shield-warning-bold-duotone"
                                                          class="fs-32 text-danger avatar-title"></iconify-icon>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="text-muted mb-0 text-truncate">Intentos fallidos (7 días)</p>
                                        <h3 class="text-dark mt-1 mb-0"><?php echo (int)$failedAttempts; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include __DIR__ . '/../layouts/footer.php'; ?>
    </div>
</div>
