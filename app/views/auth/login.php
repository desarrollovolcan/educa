<?php
// -----------------------------------------------------------------------------
// Vista de login para Go Educa.
// Usa plantilla de autenticación existente.
// -----------------------------------------------------------------------------

// Definir título de la página.
$title = 'Login - Go Educa';

// Incluir cabecera general.
include __DIR__ . '/../layouts/header.php';
?>
<body class="authentication-bg">

<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="card auth-card">
                    <div class="card-body px-3 py-5">
                        <div class="mx-auto mb-4 text-center auth-logo">
                            <a href="/login" class="logo-dark">
                                <img src="/assets/images/logo-sm.png" height="30" class="me-1" alt="logo sm">
                                <img src="/assets/images/logo-dark.png" height="24" alt="logo dark">
                            </a>

                            <a href="/login" class="logo-light">
                                <img src="/assets/images/logo-sm.png" height="30" class="me-1" alt="logo sm">
                                <img src="/assets/images/logo-light.png" height="24" alt="logo light">
                            </a>
                        </div>

                        <h2 class="fw-bold text-center fs-18">Iniciar Sesión</h2>
                        <p class="text-muted text-center mt-1 mb-4">Ingresa tu RUT y contraseña para acceder.</p>

                        <div class="px-4">
                            <form method="POST" action="/login" class="authentication-form">
                                <!-- Token CSRF obligatorio -->
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">

                                <div class="mb-3">
                                    <label class="form-label" for="rut">RUT</label>
                                    <input type="text" id="rut" name="rut" class="form-control"
                                           placeholder="11.111.111-1"
                                           value="<?php echo htmlspecialchars($_POST['rut'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="Ingresa tu contraseña">
                                </div>

                                <?php if (!empty($error)) : ?>
                                    <div class="mb-3">
                                        <span class="text-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <p class="mb-0 text-center text-muted">Go Educa - Acceso seguro</p>
            </div>
        </div>
    </div>
</div>

<!-- Scripts comunes -->
<script src="/assets/js/vendor.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
