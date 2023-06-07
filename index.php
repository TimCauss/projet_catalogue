<?php
session_start()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/style-main.css">
    <link rel="stylesheet" href="./CSS/flickity.css">
    <title>Pokeliste - Home</title>
</head>

<body>

    <!-- /** includes Header and Nav */ -->
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    include_once "./includes/slider.php";
    include_once "./includes/types.php";
    ?>

    <script src="./JS/flickity.pkgd.js"></script>
</body>

</html>