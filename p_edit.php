<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    die();
}

include_once "./includes/fonctions.php";

//On se connecte à la base de donnée
try {
    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}

/* -------------------------GET----------------------- */
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
        $numero = pNumeroUncheck($row['numero']);
        $description = $row['p_description'];
        $taille = $row['taille'];
        $poids = $row['poids'];
        $type = $row['p_type'];
        $type2 = $row['p_type-2'];
        $evolutions = explode(",", $row['evolutions']);
    } else {
        //Si non, on stock un message d'erreur dans la session PHP :
        $_SESSION['action'] = [
            'ERROR EDIT' => "Une erreur est survenue impossible de récupérer les données du Pokémon"
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

/* -------------------------POST----------------------- */
if (isset($_POST['valider'])) {
    if (!empty($_GET['id']) && !empty($_POST['nom']) && !empty($_POST['numero']) && !empty($_POST['description']) && !empty($_POST['taille']) && !empty($_POST['poids']) && !empty($_POST['type1'])) {


        //On récupère les données du formulaire :
        $p_id = strip_tags($_GET['id']);
        $nom = strip_tags($_POST['nom']);
        $numero = pNumeroCheck(strip_tags($_POST['numero']));
        $description = strip_tags($_POST['description']);
        $taille = strip_tags($_POST['taille']);
        $poids = strip_tags($_POST['poids']);
        if ($_POST['type2'] == "Type") {
            $_POST['type2'] = NULL;
        } else {
            $type2 = strip_tags($_POST['type2']);
        }
        if ($_POST['type1'] == "Type") {
            die("Veuillez choisir un type pour le Pokémon");
        } else {
            $type = strip_tags($_POST['type1']);
        }

        //On récupère et trie les évolutions :
        if (isset($_POST['evo1'])) {
            $evo = $_POST['evo1'] . ",";
        }
        if (isset($_POST['evo2'])) {
            $evo .= $_POST['evo2'] . ",";
        }
        if (isset($_POST['evo3'])) {
            $evo .= $_POST['evo3'];
        }

        //On vérifie si un fichier à été posté :
        if (!empty($_FILES["p_img"]["name"])) {
            if (isset($_FILES["p_img"])) {
                //On set le path :
                $path = "uploads/" . $nom . ".png";
                //On supprime le fichier image s'il existe :
                if (file_exists($path)) {
                    unlink($path);
                }
                //On récupère le fichier image :
                $file = $_FILES["p_img"];

                //On récupère et on filtre les données du fichier :
                $fileName = $file['name'];
                $fileType = $file['type'];
                $fileTmpName = $file['tmp_name'];
                $fileExt = explode('.', $fileName);
                $fileExt = strtolower(end($fileExt));
                $allowedExt = 'png';
                //On vérifie si l'extension du fichier est autorisée :
                if ($fileExt == $allowedExt) {
                    //On génère un nom unique pour le fichier :
                    $fileNameNew = $nom . "." . $fileExt;
                    //On set le path du fichier :
                    $path = "uploads/" . $fileNameNew;
                    //On déplace le fichier dans le dossier uploads :
                    move_uploaded_file($fileTmpName, $path);
                } else {
                    die("Format de fichier non autorisé");
                }
            } else {
                die("Fail " . $path);
            }
        }

        //On prépare une requête SQL pour mettre à jour les données du pokémon :
        $sql = "UPDATE pokemon SET nom = '$nom', numero = '$numero', p_description = '$description', taille = $taille, poids = $poids, p_type = '$type', `p_type-2` = '$type2', evolutions = '$evo' WHERE p_id = $p_id";
        //on execute la requête :
        $result = mysqli_query($conn, $sql);
        //On vérifie que la requête s'est bien executée :
        if ($result) {
            //On ajoute un repère de l'action dans la Session
            $_SESSION['action'] = [
                "Edition Réussie" => "Pokémon modifié avec succès"
            ];
            //On logs l'action da,s la BDD logs :
            $user_id = $_SESSION['user']['user_id'];
            $log = "INSERT INTO `logs`(`user_id`,`log_description`, `log_pokemon` ,`log_date`) VALUES ($user_id, ' a modifié le Pokémon ', '$nom', now())";
            $logs = mysqli_query($conn, $log);

            //On redirige vers la page profil.php :
            header('Location: profil.php');
        } else {
            //Si non, on stock un message d'erreur dans la session PHP :
            die("Erreur SQL : " . $sql . "<br>" . mysqli_error($conn));
        }
    } else {
        die("Tous les champs ne sont pas remplis");
    }
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

    <form method="POST" enctype="multipart/form-data">
        <div class="ind-wrapper">

            <div class="ind-container">
                <div class="p-header-nav">
                    <input id="retour" onclick="window.location.href = 'profil.php'" value="Retour">
                    <input type="submit" id="valider" name="valider" value="Valider">
                </div>

                <div class="p-header-title">
                    <input class="input-h1" type="text" name="nom" class="input-nbr" value="<?= $nom ?>" required>
                </div>
            </div>
            <h4>n°<input type="number" name="numero" class="input-nbr" value="<?= $numero ?>"></h4>
            <section id="section1">

                <!-- Section image -->
                <div class="image-upload">
                    <label for="file-input">
                        <img id="pokemon" src="./uploads/<?= $nom ?>.png" alt="<?= $nom ?>">
                    </label>
                    <input name="p_img" type="file" onchange="readURL(this);" id="file-input" accept="image/png">
                </div>


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
                        <select class="type-select-size col" name="type1" id="type" required>
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
                        <select class="type-select-size col" name="type2" id="type">
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
                    $i = 0;
                    foreach ($evolutions as $evo_nom) {
                        $i++;
                        // Préparez une requête SQL pour récupérer les informations de l'évolution courante
                        $sql = "SELECT * FROM pokemon WHERE nom = '$evo_nom'";
                        // Exécutez la requête SQL
                        $result = mysqli_query($conn, $sql);
                        // Récupérez la ligne de résultat sous forme de tableau associatif
                        $row = mysqli_fetch_assoc($result);
                        // Vérifiez si la requête SQL a renvoyé des résultats
                        if ($row !== false && $row !== null) {
                            // Récupérez les informations de l'évolution courante
                            $evo_nom = $row['nom'];
                            // On prépare le tableau des evolutions pour l'édition :
                    ?>
                            <div class="evo">
                                <span class="poke"><input id="pInput" name="evo<?= $i ?>" value="<?= $evo_nom ?>"></span>
                            </div>
                        <?php

                        } else {
                            // La requête SQL n'a renvoyé aucun résultat
                        ?>
                            <div class="evo">
                                <span class="poke"><input value="Aucune Evolution"></span>
                            </div>
                    <?php
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

    <script src="./JS/edit.js"></script>
</body>

</html>