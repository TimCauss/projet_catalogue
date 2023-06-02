<?php
session_start();

require_once("./connect.php");

if ($_POST && !empty($_POST['nom']) && !empty($_POST['numero'])) {
    $_SESSION['er_msg01'] = null;
    $nom = strip_tags($_POST['nom']);
    $numero = strip_tags($_POST['numero']);
    $p_img = strip_tags($_POST['p_img']);
    $p_description = strip_tags($_POST['description']);
    $taille = strip_tags($_POST['taille']);
    $poids = strip_tags($_POST['poids']);
    $evolutions = strip_tags($_POST['evolutions']);
    $p_type = strip_tags($_POST['type']);

    $sql = "INSERT INTO `pokemon`(`nom`, `numero`, `p_img`, `p_description`, `taille`, `poids`, `evolutions`, `p_type`) VALUES (:nom, :numero, :p_img,:p_description, :taille, :poids, :evolutions, :p_type)";

    $query = $db->prepare($sql);

    var_dump($query);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':numero', $numero);
    $query->bindValue(':p_img', $p_img);
    $query->bindValue(':p_description', $p_description);
    $query->bindValue(':taille', $taille);
    $query->bindValue(':poids', $poids);
    $query->bindValue(':evolutions', $evolutions);
    $query->bindValue(':p_type', $p_type);

    $query->execute();
    header("Location: creer.php");
} else {
    $_SESSION['er_msg'] = [
        1 => "Remplissez les champs obligatoires"
    ];
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokeliste - Ajouter un Pokémon</title>
</head>

<body>
    <?php
    include_once "./header.php";
    include_once "./nav.php";
    ?>

    <a href="/img/img_not_found.png"></a>

    <section class="form-add-container container px-10">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card">
                    <div class="center-on-page">
                        <div class="pokeball">
                            <div class="pokeball__button"></div>
                        </div>
                    </div>
                    <div class="card-body">

                        <h1 class="mb-4 pb-2">Ajouter un Pokémon</h1>

                        <form method="POST">
                            <div class="row mb-4">
                                <div class="form-outline col col-form-r">
                                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du Pokémon">
                                    <label for="nom" class="form-label">Nom</label>
                                </div>
                                <div class="form-outline col">
                                    <input type="number" name="numero" id="numero" class="form-control" placeholder="Numéro officiel du Pokémon">
                                    <label for="numero" class="form-label">Numéro</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-outline">
                                    <input type="p_img" name="p_img" id="p_img" class="form-control" placeholder="Image URL of the Pokémon">
                                    <label for="p_img" class="form-label">Image</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-outline">
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Description rapide du Pokémon"></textarea>
                                    <label for="description" class="form-label">Description</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-outline col col-form-r">
                                    <input type="text" name="taille" id="taille" class="form-control" placeholder="Taille du Pokémon, en mètre (ex: 0.4)">
                                    <label for="taille" class="form-label">Taille</label>
                                </div>
                                <div class="form-outline col">
                                    <input type="text" name="poids" id="poids" class="form-control" placeholder="Poids du Pokémon en kg (ex: 6)">
                                    <label for="poids" class="form-label">Poids</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-outline">
                                    <input type="text" name="evolutions" id="evolutions" class="form-control" placeholder="Url de l'évolution">
                                    <label for="evolutions" class="form-label">Evolutions</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-outline">
                                    <input type="text" name="type" id="type" class="form-control">
                                    <label for="type" class="form-label">Type</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-form" value="Ajouter">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script type="text/javascript" src="./js/pokeball.js"></script>
</body>

</html>