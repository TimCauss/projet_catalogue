<?php
// On affiche toutes les erreurs :
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    die();
}
include_once "./connect.php";
include_once "./includes/fonctions.php";


$user_id = $_SESSION['user']['user_id'];

/* -------------------------GET----------------------- */
//On vérifie que le GET existe et qu'il n'est pas vide
if (isset($_GET['id']) && !empty($_GET['id'])) {
    //On stocke l'id récupérée dans le GET dans une variable :
    $p_id = strip_tags($_GET['id']);
    //On vérifie si l'utilisateur est lié au pokémon:
    $sql_user = "SELECT user_id, pokemon_id FROM user_pokemon WHERE pokemon_id = :id";
    $reqUser = $db->prepare($sql_user);
    $reqUser->bindValue(':id', $p_id, PDO::PARAM_INT);
    $reqUser->execute();
    $array_user_pokemon = $reqUser->fetch(PDO::FETCH_ASSOC);
    if (!empty($array_user_pokemon) && $user_id == $array_user_pokemon['user_id']) {

        // Requête pour récupérer tous les Pokémon
        $query = "SELECT id, nom, numero FROM pokemon ORDER BY nom ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //On prépare une requête SQL pour récupérer les infos du pokémon à éditer :
        $sql = "SELECT p.*, GROUP_CONCAT(t.type_name ORDER BY t.type_name SEPARATOR ', ') AS types,
                e.evolves_from FROM pokemon p LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id
                LEFT JOIN types t ON pt.type_id = t.id LEFT JOIN evolutions e ON p.id = e.pokemon_id
                WHERE p.id = :id GROUP BY p.id, e.evolves_from";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $p_id, PDO::PARAM_INT);
        $stmt->execute();

        //On vérifie que la requête s'est bien executée :
        if ($stmt) {
            //Si oui, on stock les infos du pokémon dans une variable :
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //On stock les infos du pokémon dans des variables :
            if ($row) {
                $nom = strip_tags($row['nom']);
                $numero = strip_tags(pNumeroUncheck($row['numero']));
                $description = strip_tags($row['description']);
                $taille = strip_tags($row['taille']);
                $poids = strip_tags($row['poids']);
                $typeArray = explode(', ', $row['types']);
                if ($row['evolves_from']) {
                    $evolutions = strip_tags($row['evolves_from']);
                }
            }
        } else {
            //Si non, on stock un message d'erreur dans la session PHP :
            $_SESSION['action'] = [
                'ERROR EDIT' => "Une erreur est survenue impossible de récupérer les données du Pokémon"
            ];
            header('Location: profil.php');
        }
    } else {
        $_SESSION['action'] = [
            'ERROR' => "Vous n'ête pas lié à ce Pokémon"
        ];
        header('Location: profil.php');
    }
} else {
    //Si l'id n'est pas récupérée, on stock un message d'erreur dans la session PHP :
    $_SESSION['action'] = [
        'ERROR ID' => "Une erreur est survenue lors de la récupération des données du Pokémon"
    ];
    header('Location: profil.php');
}

/* -------------------------POST----------------------- */
if (isset($_POST['valider'])) {
    if (
        !empty($_GET['id']) && !empty($_POST['nom']) && !empty($_POST['numero'])
        && !empty($_POST['description']) && !empty($_POST['taille'])
        && !empty($_POST['poids']) && !empty($_POST['type'])
    ) {
        //On récupère les données du formulaire :
        $p_id = strip_tags($_GET['id']);
        $nom = strip_tags($_POST['nom']);
        $numero = pNumeroCheck(strip_tags($_POST['numero']));
        $description = strip_tags($_POST['description']);
        $taille = strip_tags($_POST['taille']);
        $poids = strip_tags($_POST['poids']);
        $type = $_POST['type'];

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

        // On met les modification dans un try pour pouvoir annuler les modification si on catch une erreur
        try {

            /* Mise à jour table principale des Pokemon: */
            $db->beginTransaction(); // On début ici la transaction avec la bdd 
            $stmt = $db->prepare("UPDATE pokemon SET nom = :nom, numero = :numero, description = :description, taille = :taille, poids = :poids WHERE id = :id");
            $stmt->execute([':nom' => $nom, ':numero' => $numero, ':description' => $description, ':taille' => $taille, ':poids' => $poids, ':id' => $p_id]);

            /* Mise à jour de la table des types
            On doit d'abord supprimer les jointures du pokémon afin d'en insérer de nouveaux */
            $stmt = $db->prepare("DELETE FROM pokemon_types WHERE pokemon_id = :p_id");
            $stmt->execute([':p_id' => $p_id]);

            foreach ($type as $type_name) {
                //requête pour récup l'id correspondant au type_name
                $type_stmt = $db->prepare("SELECT id FROM types WHERE type_name = :type_name");
                $type_stmt->execute([':type_name' => $type_name]);
                $type_id = $type_stmt->fetch(PDO::FETCH_ASSOC)['id']; // On stocke l'id du type dans cette variable
                // On insère les données dans la tables pokémon_types :
                $stmt = $db->prepare('INSERT INTO pokemon_types (pokemon_id, type_id) VALUES(:pokemon_id, :type_id)');
                $stmt->execute([':pokemon_id' => $p_id, ':type_id' => $type_id]);
            }

            /* Mise à jour des évolutions */
            if (!empty($_POST['evolution_from'])) {
                $evolves_from = strip_tags($_POST['evolution_from']);
                $evolve_del_stmt = $db->prepare("DELETE FROM evolutions WHERE pokemon_id = :p_id");
                $evolve_del_stmt->execute([':p_id' => $p_id]);
                $evolve_stmt = $db->prepare("INSERT INTO evolutions (pokemon_id, evolves_from) VALUES(:pokemon_id,  :evolves_from)");
                $evolve_stmt->execute([':pokemon_id' => $p_id, ':evolves_from' => $evolves_from]);
            }
        } catch (Exception $e) {
            // Annuler la transaction si une erreur survient
            $db->rollBack();
            $e->getMessage();
            $_SESSION['action'] = [
                'ERROR RESULT' => "Erreur: . $e"
            ];
            //On redirige l'utilisateur vers la page profil:
            header('Location: profil.php');
        }

        // Pas d'erreur, on commit les changement à la db:
        $db->commit();

        //On ajoute un repère de l'action dans la Session
        $_SESSION['action'] = [
            "Edition Réussie" => "Pokémon . $nom . modifié avec succès"
        ];

        // On log l'action de l'utilisateur :
        $sql_log = "INSERT INTO user_logs (user_id, action_type, description) VALUES (:user_id, :action_type, :description)";
        $query_log = $db->prepare($sql_log);
        $query_log->bindValue(':user_id', $user_id);
        $query_log->bindValue(':action_type', 'Création');
        $query_log->bindValue(':description', $nom);
        $query_log->execute();

        //On redirige vers la page profil.php :
        header('Location: profil.php');
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
    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                        <textarea class="p-input-desc form-outline custom-select" name="description" rows="5" cols="35" required maxlength="255"><?= $description ?></textarea>
                    </div>
                    <div class="p-input-det-wrapper">
                        <ul>
                            <li>Taille: <input name="taille" class="input-taille" value="<?= $taille ?>"><span>m</span></li>
                            <li>Poids: <input name="poids" class="input-poids" value="<?= $poids ?>"><span>kg</span></li>
                        </ul>
                    </div>
                    <div class="type-container">
                        <h6>Type</h6>
                        <select class="js-example-basic-multiple form-outline custom-select" name="type[]" id="type" multiple required>
                            <?php foreach ($typeArray as $type) : ?>
                                <option value="<?= htmlspecialchars($type) ?>" selected><?= htmlspecialchars($type) ?></option>
                            <?php endforeach; ?>
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
                            <option value="tenebres">Tenebres</option>
                            <option value="spectre">Spectre</option>
                            <option value="sol">Sol</option>
                            <option value="roche">Roche</option>
                            <option value="vol">Vol</option>
                            <option value="fée">Fée</option>
                            <option value="dragon">Dragon</option>
                        </select>
                    </div>
                </div>
            </section>
            <section class="evolutions">
                <h2>Evolutions:</h2>
                <div class="evo-container">
                    <div class="row mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_evolution" name="is_evolution">
                            <label class="form-check-label" for="is_evolution">Est une évolution</label>
                        </div>
                    </div>
                    <div class="row mb-4" id="evolution_from_container" style="display: none;">
                        <label for="evolution_from" class="form-label">Évolution de :</label>
                        <select class="form-control centered" name="evolution_from" id="evolution_from">
                        </select>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let checkbox = document.getElementById('is_evolution');
                            let container = document.getElementById('evolution_from_container');
                            let select = document.getElementById('evolution_from');
                            checkbox.addEventListener('change', function() {
                                if (checkbox.checked) {
                                    container.style.display = 'block';
                                    select.innerHTML = '';
                                    let pokemonList = <?php echo json_encode($pokemonList); ?>;
                                    pokemonList.forEach(function(pokemon) {
                                        let option = document.createElement('option');
                                        option.value = pokemon.id;
                                        option.textContent = pokemon.nom;
                                        select.appendChild(option);
                                    });
                                } else {
                                    container.style.display = 'none';
                                }
                            });
                        });
                    </script>
                </div>
            </section>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                tags: false,
                tokenSeparators: [',', ' '],
                placeholder: "Type(s)",
                maximumSelectionLength: 2
            })
        });
    </script>
    <script src="./JS/edit.js"></script>
</body>

</html>