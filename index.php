<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
<?php

include './Components/product-tile.php';
$label = 'Harry Potter and the Philosopher Stone';
$authorName = 'J.K. Rowling';
$price = '100 zł';
$img = "Universal/harry-potter-and-the-philosopher-stone.jpg";

generateProductTile($label,
$authorName,
$price,
$img);?>
</body>
</html>