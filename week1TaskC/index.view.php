<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: lightgrey;
        }
        h1{
            background-color: gray;
            border-style: solid;
            border-color:black;
            text-align: center;
        }

    </style>
</head>
<body>
    <h1><?= "I like to eat ", htmlspecialchars($_GET['favoriteFood']); ?></h1>
    <div>
        <?php foreach ($animals as $animals) : ?>
            <li><?= $animals; ?></li>
        <?php endforeach; ?>
    </div>
</body>
</html>