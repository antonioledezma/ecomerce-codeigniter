<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        /* Estilos básicos para la página de error */
    </style>
</head>
<body>
    <h1>¡Se ha producido un error!</h1>
    <p><?php echo $message; ?></p>
    <?php if (ENVIRONMENT === 'development'): ?>
        <h3><?php echo $title; ?></h3>
        <pre><?php echo $trace; ?></pre>
    <?php endif; ?>
</body>
</html>