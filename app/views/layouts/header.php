<?php
// -----------------------------------------------------------------------------
// Layout de cabecera HTML.
// Incluye meta tags y hojas de estilo del template.
// -----------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title><?php echo htmlspecialchars($title ?? APP_NAME, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Go Educa" name="description" />
    <meta content="Go Educa" name="author" />

    <!-- Vendor css (Require in all Page) -->
    <link href="<?php echo PUBLIC_URL; ?>/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="<?php echo PUBLIC_URL; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="<?php echo PUBLIC_URL; ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="<?php echo PUBLIC_URL; ?>/assets/js/config.min.js"></script>
</head>
