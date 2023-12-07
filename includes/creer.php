<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once("connect.php");
require("./includes/fonctions.php");

/* Verification de la connexion de l'utilisateur */
if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
}

define('MB', 1048576); //on Définir la valeur d'un MB

include_once "./includes/fonctions.php";

// Requête pour récupérer tous les Pokémon
$query = "SELECT id, nom, numero FROM pokemon ORDER BY nom ASC";
$stmt = $db->prepare($query);
$stmt->execute();
$pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* Si on capture un POST:*/
if ($_POST) {

    /* On vérifie si les champs necessaire sont remplis : */
    if (
        !empty($_POST['nom']) && !empty($_POST['numero']) && !empty($_POST['description'])
        && !empty($_POST['taille']) && !empty($_POST['poids'] && !empty($_POST['type']))
    ) {

        /* On Vérifie que le Pokémon n'est pas déjà présent dans la base de donée
        Si le nom ou le numero existe déjà, on stock un message d'erreur
        dans la session PHP */

        /* On nettoies les post puis on stock le résultat de ce netoyage dans une variable */
        $nom = strip_tags($_POST['nom']);
        $numero = pNumeroCheck(strip_tags($_POST["numero"]));
        $description = strip_tags($_POST['description']);
        $taille = str_replace_comma(strip_tags($_POST['taille']));
        $poids = str_replace_comma(strip_tags($_POST['poids']));

        foreach ($pokemonList as $result) {

            //Si le nom ou le numéro existe déjà, un message d'erreur apparait.
            if (strtolower($result["nom"]) == strtolower($nom)) {
                die("Ce Pokémon existe déjà");
            }
            if ($result["numero"] == $numero) {
                die("Ce numéro de Pokémon existe déjà");
            }
        }

        if (isset($_FILES["p_img"]) && $_FILES["p_img"]["error"] != 0) {
            die("Erreur lors du téléchargement du fichier : " . $_FILES["p_img"]["error"]);
        }

        /* On vérifie ensuite la receptionde l'image, et s'il elle ne contient pas d'erreur:*/
        if (isset($_FILES["p_img"]) && $_FILES["p_img"]["error"] === 0) {

            /* On procède aux vérifications de l'image : */

            // On vérifie l'extension & le type MIME :
            $allowed = [
                "png" => "image/png"
            ];

            $filetype = mime_content_type($_FILES["p_img"]["tmp_name"]); //On stok le type MIME
            $filename = basename($_FILES["p_img"]["name"]); //On stock le nom du fichier dans une variable, on le nettoie au passage
            $filesize = $_FILES["p_img"]["size"]; //On stock la taille
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); //On récupère l'extension

            // On vérifie l'absence de l'extension dans les clé du tableau $allowed ou l'absence du type MIME:
            if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
                // ici soit l'extension soit le type n'est pas trouvable dans le tableau $allowed
                die("Erreur, format de fichier autorisé : .png");
            }

            // A ce stade, l'image est correct
            // on limite la taille de l'image à 1Mo
            if ($filesize > 1 * MB) {
                die("Fichier image trop volumineux (1mo max)");
            }

            //On génère le chemin complet de l'image
            $newfilename = "uploads/$nom.$extension";
            //On déplace le fichier tmp vers upload sous son nouveau nom :
            if (!move_uploaded_file($_FILES["p_img"]["tmp_name"], $newfilename)) {
                die("Le transfert de fichier a échoué. Erreur: " . error_get_last()['message']);
            }

            // On récupère l'id de l'utilisateur connecté
            $user_id = $_SESSION['user']['user_id'];

            $sql = "INSERT INTO `pokemon`(`nom`, `numero`, `description`, `taille`, `poids`, `evolves_from`) VALUES (:nom, :numero, :description, :taille, :poids, :evolves_from)";
            $query = $db->prepare($sql);

            $query->bindValue(':nom', $nom);
            $query->bindValue(':numero', $numero);
            $query->bindValue(':description', $description);
            $query->bindValue(':taille', $taille);
            $query->bindValue(':poids', $poids);

            // On vérifie si c'est une évolution et on lie la valeur ou NULL

            if (!empty($_POST['is_evolution']) && !empty($_POST['evolution_from'])) {
                $evolves_from = testInput($_POST['evolution_from']);
                $query->bindValue(':evolves_from', $evolves_from);
            } else {
                $query->bindValue(':evolves_from', null);
            }


            if ($query->execute()) {
                $pokemon_id = $db->lastInsertId(); // On récup la dernière id pokémon insérée en bdd

                if (!empty($_POST['type'])) {
                    foreach ($_POST['type'] as $type_name) {
                        // Récup de l'ID du type grâce au nom
                        $sql_type = "SELECT id FROM types WHERE type_name = :type_name";
                        $query_type = $db->prepare($sql_type);
                        $query_type->bindValue(':type_name', $type_name);
                        $query_type->execute();
                        $type_result = $query_type->fetch(PDO::FETCH_ASSOC);

                        if ($type_result) {
                            $type_id = $type_result['id']; // id du type
                            //insertion dans la table pokemon_types
                            $sql_pokemon_type = "INSERT INTO pokemon_types (pokemon_id, type_id) VALUES (:pokemon_id, :type_id)";
                            $query_pokemon_type = $db->prepare($sql_pokemon_type);
                            $query_pokemon_type->bindValue(':pokemon_id', $pokemon_id);
                            $query_pokemon_type->bindValue(':type_id', $type_id);
                            $query_pokemon_type->execute();
                        }
                    }
                }
                // On associe le Pokémon à l'utilisateur
                $sql_user_pokemon = "INSERT INTO user_pokemon (user_id, pokemon_id) VALUES (:user_id, :pokemon_id)";
                $query_user_pokemon = $db->prepare($sql_user_pokemon);
                $query_user_pokemon->bindValue(':user_id', $user_id);
                $query_user_pokemon->bindValue(':pokemon_id', $pokemon_id);
                $query_user_pokemon->execute();
                // On log l'action de l'utilisateur :
                $sql_log = "INSERT INTO user_logs (user_id, action_type, description) VALUES (:user_id, :action_type, :description)";
                $query_log = $db->prepare($sql_log);
                $query_log->bindValue(':user_id', $user_id);
                $query_log->bindValue(':action_type', 'Création');
                $query_log->bindValue(':description', $nom);
                $query_log->execute();
                //On ajoute un repère de l'action dans la Session
                $_SESSION['action'] = [
                    "Création Réussi" => "Pokémon " . $nom . " ajouté avec succès"
                ];
                //On vide les erreurs de la Session php
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
?>



<!-- Script de Prévisualisation de l'image : -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lorsque l'utilisateur sélectionne un fichier
        document.getElementById('p_img').addEventListener('change', function() {
            const fileInput = this;
            const file = fileInput.files[0];
            // Vérifier si un fichier est sélectionné
            if (file) {
                // Créer un objet FileReader pour lire le contenu du fichier
                const reader = new FileReader();
                // Définir une fonction de rappel pour exécuter lorsque la lecture est terminée
                reader.onload = function(e) {
                    // Afficher l'image prévisualisée
                    document.getElementById('image-preview').src = e.target.result;
                };
                // Lire le contenu du fichier en tant que Data URL (base64)
                reader.readAsDataURL(file);
            }
        });

        // Au chargement de la page
        checkLabelPositionForAllInputs();

        // À chaque fois que le contenu d'un input change
        document.querySelectorAll('.form-control').forEach(function(inputElement) {
            inputElement.addEventListener('input', function() {
                checkLabelPosition(inputElement);
            });
        });

        function checkLabelPositionForAllInputs() {
            // Récupérer tous les éléments d'étiquette
            document.querySelectorAll('.custom-label').forEach(function(labelElement) {
                // Récupérer l'élément d'input correspondant
                var inputElement = document.getElementById(labelElement.getAttribute('for'));
                // Appliquer la classe "active" si l'input a du texte, sinon la supprimer
                if (inputElement && inputElement.value.length > 0) {
                    labelElement.classList.add('active');
                } else {
                    labelElement.classList.remove('active');
                }
            });
        }

        function checkLabelPosition(inputElement) {
            // Récupérer l'élément d'étiquette correspondant
            var labelElement = document.querySelector('.custom-label[for="' + inputElement.id + '"]');

            if (labelElement) {
                if (inputElement.value.length > 0) {
                    labelElement.classList.add('active');
                } else {
                    labelElement.classList.remove('active');
                }
            }
        }
    });
</script>

<div class="overlay closer"></div>
<section class="form-add-container px-10">
    <div class="card">
        <div class="center-on-page">
            <div class="pokeball">
                <div class="pokeball__button"></div>
            </div>
        </div>
        <div class="card-body">
            <h1 class="mb-4 pb-2">Ajouter un Pokémon</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="form-outline col col-form-r">
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du Pokémon">
                        <label for="nom" class="custom-label">Nom</label>
                    </div>
                    <div class="form-outline col">
                        <input type="number" name="numero" id="numero" class="form-control" placeholder="Numéro officiel du Pokémon">
                        <label for="numero" class="custom-label">Numéro</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="form-label">
                        Image :
                    </label>
                    <div class="form-outline">
                        <input type="file" name="p_img" id="p_img" class="form-control" accept="image/png" value="Image" required>
                    </div>
                    <div class="image-preview mt-2">
                        <img id="image-preview" alt="Prévisualisation de l'image du Pokémon à ajouter">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-outline">
                        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Description rapide du Pokémon"></textarea>
                        <label for="description" class="custom-label">Description</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="form-outline col col-form-r">
                        <input type="text" name="taille" id="taille" class="form-control" placeholder="Taille du Pokémon, en mètre (ex: 0.4)">
                        <label for="taille" class="custom-label">Taille</label>
                    </div>
                    <div class="form-outline col">
                        <input type="text" name="poids" id="poids" class="form-control" placeholder="Poids du Pokémon en kg (ex: 6)">
                        <label for="poids" class="custom-label">Poids</label>
                    </div>
                </div>
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
                <div class="row mb-4">
                    <select class="js-example-basic-multiple custom-select create-type" name="type[]" id="type_create" multiple required>
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
                <div class="d-flex justify-content-center">
                    <input type="submit" id="submit" class="btn btn-form" value="Ajouter">
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript" src="./JS/modal-ajouter.js"></script>