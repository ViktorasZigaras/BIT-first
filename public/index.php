<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/app.css">
    <title>BIT FIRST</title>
</head>
<body>

<?php

require __DIR__.'/../vendor/autoload.php';


use BIT\controllers\Controller;
use BIT\models\Model;
    

    echo "<br/>";
    $test = new Model;
    echo "<br/>";
    $test2 = new Controller;

?>

<script src="./js/app.js"></script>
</body>
</html>
