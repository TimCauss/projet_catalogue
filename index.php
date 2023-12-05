<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- META --->

    <meta charset="UTF-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pokédex Complet - Explorez le Monde des Pokémon</title>


    <meta name="description" content="Découvrez notre Pokédex en ligne avec des informations détaillées sur chaque Pokémon,
    y compris leurs types, statistiques et évolutions. Parfait pour les fans et les dresseurs !">

    
    <meta name="keywords" content="Pokédex, Pokémon, Guide Pokémon, Stats Pokémon, Types Pokémon, Évolutions Pokémon">


    <meta property="og:title" content="Pokédex Complet en Ligne - Découvrez le Monde des Pokémon">

    <meta property="og:description" content="Explorez notre Pokédex en ligne pour
    des informations détaillées sur chaque Pokémon, y compris leurs types, statistiques et évolutions.">

    <meta property="og:type" content="website">

    <meta property="og:image" content="./img/OG.png">


    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./CSS/style-main.css">
    <link rel="stylesheet" href="./CSS/flickity.css">
    <link rel="stylesheet" href="./CSS/type-card.css">



</head>

<body>

    <!-- /** includes Header and Nav */ -->
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    include_once "./includes/slider.php";
    include_once "./includes/types.php";
    include_once "./includes/footer.php"
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./JS/flickity.pkgd.js"></script>
</body>

</html>