<?php
/** @var string $title */
/** @var string $contentView */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?> - Go Educa</title>
    <?php $assetBase = $assetBase ?? ''; ?>
    <link href="<?php echo $assetBase; ?>/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $assetBase; ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $assetBase; ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box">
                <h4 class="page-title mb-3"><?php echo htmlspecialchars($title); ?></h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php require $contentView; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $assetBase; ?>/assets/js/vendor.min.js"></script>
<script src="<?php echo $assetBase; ?>/assets/js/app.min.js"></script>
</body>
</html>
