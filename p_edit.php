<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    die();
}

//On se connecte à la base de donnée
try {
    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}

//On vérifie que le GET existe et qu'il n'est pas vide
if (isset($_GET['id']) && !empty($_GET['id'])) {
    //On stocke l'id récupérée dans le GET dans une variable :
    $p_id = $_GET['id'];
    //On prépare une requête SQL pour récupérer les infos du pokémon à éditer :
    $sql = "SELECT * FROM pokemon WHERE p_id = $p_id";
    //On execute la requête :
    $result = mysqli_query($conn, $sql);
    //On vérifie que la requête s'est bien executée :
    if ($result) {
        //Si oui, on stock les infos du pokémon dans une variable :
        $row = mysqli_fetch_assoc($result);
        //On stock les infos du pokémon dans des variables :
        $nom = $row['nom'];
        $numero = $row['numero'];
        $description = $row['p_description'];
        $taille = $row['taille'];
        $poids = $row['poids'];
        $type = $row['p_type'];
        $type2 = $row['p_type-2'];
        $evolutions = explode(",", $row['evolutions']);
    } else {
        //Si non, on stock un message d'erreur dans la session PHP :
        $_SESSION['action'] = [
            'ERROR EDIT' => "Une erreur est survenue inpossible de récupérer les données du Pokémon"
        ];
        die();
        header('Location: profil.php');
    }
} else {
    //Si l'id n'est pas récupérée, on stock un message d'erreur dans la session PHP :
    $_SESSION['action'] = [
        'ERROR ID' => "Une erreur est survenue lors de la récupération des données du Pokémon"
    ];
    die();
    header('Location: profil.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokeliste - Editer <?= $nom ?></title>
</head>

<body>

    <?php
    include_once './includes/header.php';
    include_once './includes/nav.php';
    ?>

    <form method="POST">
        <div class="ind-wrapper">

            <div class="ind-container">
                <div class="p-header-nav">
                    <input type="submit" id="retour" name="retour" value="Retour">
                    <input type="submit" id="valider" name="valider" value="Valider">
                </div>

                <div class="p-header-title">
                    <input class="input-h1" type="text" class="input-nbr" value="<?= $nom ?>" required>
                </div>
            </div>
            <h4>n°<input type="text" class="input-nbr" value="<?= $numero ?>"></h4>
            <section id="section1">
                <img id="pokemon" src="./uploads/<?= $nom ?>.png" alt="<?= $nom ?>">
                <div class="desc">
                    <div class="p-input-wrapper">
                        <textarea class="p-input-desc" name="description" rows="5" cols="35" required maxlength="255"><?= $description ?></textarea>
                    </div>
                    <div class="p-input-det-wrapper">
                        <ul>
                            <li>Taille: <input name="taille" class="input-taille" value="<?= $taille ?>"><span>m</span></li>
                            <li>Poids: <input name="poids" class="input-poids" value="<?= $poids ?>"><span>kg</span></li>
                        </ul>
                    </div>
                    <div class="type-container">
                        <h6>Type</h6>
                        <select class="type-select-size col" name="type" id="type" required>
                            <option selected><?= $type ?></option>
                            <option value="feu">Feu</option>
                            <option value="plante">Plante</option>
                            <option value="eau">Eau</option>
                            <option value="glace">Glace</option>
                            <option value="insecte">Insecte</option>
                            <option value="normal">Normal</option>
                            <option value="electrik">Electrik</option>
                            <option value="poison">Poison</option>
                            <option value="psy">Psy</option>
                            <option value="combat">Combat</option>
                            <option value="acier">Acier</option>
                            <option value="tenebres">Tenèbres</option>
                            <option value="spectre">Spectre</option>
                            <option value="sol">Sol</option>
                            <option value="roche">Roche</option>
                            <option value="vol">Vol</option>
                        </select>
                        <select class="type-select-size col" name="type" id="type">
                            <option selected><?= $type2 ?></option>
                            <option value="feu">Feu</option>
                            <option value="plante">Plante</option>
                            <option value="eau">Eau</option>
                            <option value="glace">Glace</option>
                            <option value="insecte">Insecte</option>
                            <option value="normal">Normal</option>
                            <option value="electrik">Electrik</option>
                            <option value="poison">Poison</option>
                            <option value="psy">Psy</option>
                            <option value="combat">Combat</option>
                            <option value="acier">Acier</option>
                            <option value="tenebres">Tenèbres</option>
                            <option value="spectre">Spectre</option>
                            <option value="sol">Sol</option>
                            <option value="roche">Roche</option>
                            <option value="vol">Vol</option>
                        </select>
                    </div>
                </div>
            </section>
            <section class="evolutions">
                <h2>Evolutions:</h2>
                <div class="evo-container">
                    <?php
                    foreach ($evolutions as $evo_nom) {
                        // Préparez une requête SQL pour récupérer les informations de l'évolution courante
                        $sql = "SELECT * FROM pokemon WHERE nom = '$evo_nom'";
                        // Exécutez la requête SQL
                        $result = mysqli_query($conn, $sql);
                        // Récupérez la ligne de résultat sous forme de tableau associatif
                        $row = mysqli_fetch_assoc($result);

                        // Vérifiez si la requête SQL a renvoyé des résultats
                        if ($row !== false) {
                            // Récupérez les informations de l'évolution courante
                            $evo_id = $row['p_id'];
                            $evo_nom = $row['nom'];
                            $evo_numero = $row['numero'];
                            $evo_type = $row['p_type'];
                            $evo_type2 = $row['p_type-2'];
                    ?>
                            <div class="evo">
                                <img src="uploads/<?= $evo_nom ?>.png">
                                <span class="poke"><input value="<?= $evo_nom ?>"></span>
                            </div>
                    <?php
                        } else {
                            // La requête SQL n'a renvoyé aucun résultat
                            echo "Aucun résultat pour l'évolution '$evo_nom'.";
                        }
                        if (next($evolutions)) {
                            echo "<span class=\"arrow\">→</span>";
                        }
                    }
                    ?>
                </div>

            </section>
        </div>
    </form>
</body>

</html>