<?php


require_once("./connect.php");

if ($_POST && isset($_POST['nom']) && isset($_POST['numero'])) {
    $nom = strip_tags($_POST['nom']);
    $numero = strip_tags($_POST['numero']);
    $p_description = strip_tags($_POST['description']);
    $taille = strip_tags($_POST['taille']);
    $poids = strip_tags($_POST['poids']);
    $evolutions = strip_tags($_POST['evolutions']);
    $p_type = strip_tags($_POST['type']);

    $sql = "INSERT INTO `pokemon`(`nom`, `numero`, `p_description`, `taille`, `poids`, `evolutions`, `p_type`) VALUES (:nom, :numero, :p_description, :taille, :poids, :evolutions, :p_type)";

    $query = $db->prepare($sql);

    var_dump($query);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':numero', $numero);
    $query->bindValue(':p_description', $p_description);
    $query->bindValue(':taille', $taille);
    $query->bindValue(':poids', $poids);
    $query->bindValue(':evolutions', $evolutions);
    $query->bindValue(':p_type', $p_type);

    $query->execute();
    header("Location: creer.php");
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokeliste - Ajouter un Pokémon</title>
</head>

<body>
    <?php
    include_once "./header.php";
    include_once "./nav.php";
    ?>

    <form method="POST">
        <div class="form-outline mb-4">
            <input type="text" name="nom" id="nom" placeholder="Nom du Pokémon">
            <label for="nom">Nom</label>
        </div>
        <div>
            <label for="numero">Numéro</label>
            <input type="text" name="numero" id="numero" placeholder="Numéro du Pokémon">
        </div>
        <div>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Description rapide du Pokémon">
        </div>
        <div>
            <label for="taille">Taille</label>
            <input type="text" name="taille" id="taille" placeholder="Taille du Pokémon">
        </div>
        <div>
            <label for="poids">Poids</label>
            <input type="text" name="poids" id="poids" placeholder="Poids du Pokémon">
        </div>
        <div>
            <label for="evolutions">Evolutions</label>
            <input type="text" name="evolutions" id="evolutions" placeholder="Url Evolutions">
        </div>

        <div>
            <label for="type">Type</label>
            <input type="text" name="type" id="type" placeholder="Type du Pokémon">
        </div>

        <input type="submit" value="Ajouter">

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>