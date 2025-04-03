<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $title ?></h1>
    <p><?= $description ?></p>
    <h2>Our Team</h2>
    <ul>
        <?php foreach ($team as $member): ?>
            <li><?= $member ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>