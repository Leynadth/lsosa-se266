<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach ($task as $key => $feature) : ?>
            <li><strong><?= $key; ?></storng><?= $feature; ?></li>
        <?php endforeach; ?>
</ul>
</body>
</html>