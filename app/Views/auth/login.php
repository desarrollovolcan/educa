<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="card auth-card">
                    <div class="card-body px-3 py-5">
                        <div class="mx-auto mb-4 text-center auth-logo">
                            <a href="./" class="logo-dark">
                                <img src="<?php echo $assetBase; ?>/assets/images/logo-sm.svg" height="30" class="me-1" alt="logo sm">
                                <img src="<?php echo $assetBase; ?>/assets/images/logo-dark.svg" height="24" alt="logo dark">
                            </a>

                            <a href="./" class="logo-light">
                                <img src="<?php echo $assetBase; ?>/assets/images/logo-sm.svg" height="30" class="me-1" alt="logo sm">
                                <img src="<?php echo $assetBase; ?>/assets/images/logo-light.svg" height="24" alt="logo light">
                            </a>
                        </div>

                        <h2 class="fw-bold text-center fs-18">Ingreso a Go Educa</h2>
                        <p class="text-muted text-center mt-1 mb-4">Ingresa tu RUT y contraseña para continuar.</p>

                        <?php if (isset($dbStatus, $dbName)): ?>
                            <div class="alert <?php echo $dbStatus === 'ok' ? 'alert-success' : 'alert-danger'; ?> text-center" role="alert">
                                <div class="fw-semibold">Base de datos: <?php echo htmlspecialchars($dbName); ?></div>
                                <div>
                                    <?php echo $dbStatus === 'ok' ? 'Conexión exitosa.' : htmlspecialchars($dbError ?? 'Error de conexión.'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="px-4">
                            <form method="POST" action="/auth/login" class="authentication-form">
                                <div class="mb-3">
                                    <label class="form-label" for="rut">RUT</label>
                                    <input type="text" id="rut" name="rut" class="form-control" placeholder="12.345.678-9" required>
                                </div>
                                <div class="mb-3">
                                    <a href="/auth/password-request" class="float-end text-muted text-unline-dashed ms-1">¿Olvidaste tu contraseña?</a>
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember">
                                        <label class="form-check-label" for="remember">Recordarme</label>
                                    </div>
                                </div>

                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Ingresar</button>
                                </div>
                            </form>

                            <p class="mt-3 fw-semibold no-span">Acceso con soporte</p>

                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class="bx bxs-help-circle fs-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class="bx bxs-envelope fs-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class="bx bxs-phone fs-20"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="mb-0 text-center text-muted">¿Problemas de acceso? Contacta a soporte.</p>
            </div>
        </div>
    </div>
</div>
