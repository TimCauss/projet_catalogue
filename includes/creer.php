<?php
session_start();

require_once("./connect.php");

define('MB', 1048576); //on Définir la valeur d'un MB

/** On fetch la base de donnée pour la comparer au données entrées dans le formulaire */

$sql_all = "SELECT * FROM pokemon";
$query_all = $db->prepare($sql_all);
$query_all->execute();
$result_all = $query_all->fetchAll(PDO::FETCH_ASSOC);



/* Si on capture un POST:*/
if ($_POST) {
    /* On vérifie si les champs necessaire sont remplis : */
    if (!empty($_POST['nom']) && !empty($_POST['numero'])) {
        /* On unset les potentiels précédents message d'erreur stockés dans la session php*/
        unset($_SESSION['er_msg']['form_01']);
        /* On Vérifie que le Pokémon n'est pas déjà présent dans la base de donée
        Si le nom ou le numero existe déjà, on stock un message d'erreur
        dans la session PHP */
        foreach ($result_all as $result) {
            if (strtoupper($result["nom"]) == strtoupper($_POST["nom"])) {
                $_SESSION['er_msg'] = [
                    'p_name' => "Ce nom de Pokemon est déjà pris"
                ];
            } elseif ($result["numero"] == $_POST["numero"]) {
                $_SESSION['er_msg'] = [
                    'p_nbr' => "Ce numéro de Pokémon est déjà pris"
                ];
            }
        }


        /* On vérifie ensuite la receptionde l'image, et s'il elle ne contient pas d'erreur:*/
        if (isset($_FILES["p_img"]) && $_FILES["p_img"]["error"] === 0) {
            /* On procède aux vérifications de l'image : */
            // On vérifie l'extension & le type MIME :
            $allowed = [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png"
            ];

            $filename = $_FILES["p_img"]["name"]; //On stock le nom du fichier dans une variable
            $filetype = $_FILES["p_img"]["type"]; //On stok le type
            $filesize = $_FILES["p_img"]["size"]; //On stock la taille
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); //On récupère l'extension

            //On vérifie l'absence de l'extension dans les clé du tableau $allowed ou l'absence du type MIME:
            if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
                //ici soit l'extension soit le type n'est pas trouvable dans le tableau $allowed
                die("Erreur, formats de fichier autorisés : .jpg, .jpeg ou .png");
            }

            //A ce stade, l'image est correct
            //on limite la taille de l'image à 1Mo
            if ($filesize > 1 * MB) {
                die("Fichier image trop volumineux (1mo max)");
            }

            /* On nettoies les post puis on stock le résultat de ce netooyage dans une variable */
            $nom = strip_tags($_POST['nom']);
            $numero = strip_tags($_POST['numero']);
            $p_description = strip_tags($_POST['description']);
            $taille = strip_tags($_POST['taille']);
            $poids = strip_tags($_POST['poids']);
            $evolutions = strip_tags($_POST['evolutions']);
            $p_type = strip_tags($_POST['type']);

            //On génère le chemin complet de l'image
            $newfilename = __DIR__ . "/uploads/$nom.$extension";
            //On déplace le fichier tmp vers upload sous son nouveau nom :
            if (!move_uploaded_file($_FILES["p_img"]["tmp_name"], $newfilename)) {
                die("Le transfert de fichier à échoué, veuillez contacter un administrateur");
            }

            $sql = "INSERT INTO `pokemon`(`nom`, `numero`, `p_description`, `taille`, `poids`, `evolutions`, `p_type`) VALUES (:nom, :numero, :p_description, :taille, :poids, :evolutions, :p_type)";

            $query = $db->prepare($sql);

            $query->bindValue(':nom', $nom);
            $query->bindValue(':numero', $numero);
            $query->bindValue(':p_description', $p_description);
            $query->bindValue(':taille', $taille);
            $query->bindValue(':poids', $poids);
            $query->bindValue(':evolutions', $evolutions);
            $query->bindValue(':p_type', $p_type);

            $query->execute();

            //On ajoute un repère de l'action dans la Session
            $_SESSION['action'] = [
                "add_pokemon" => "Pokémon ajouter avec succès"
            ];
            //On vide les erreurs de la Session php
            unset($_SESSION["er_msg"]);
            header("Location: creer.php");
        }
        /* Si on ne reçoit pas d'image ou que l'image contient des erreurs: */
    } else {
        $_SESSION['er_msg'] = [
            'form_img' => "Image envoyée non conforme"
        ];
    }
    /*Si on ne capture pas de POST */
} else {
    $_SESSION['er_msg'] = [
        'form_01' => "Remplissez les champs obligatoires"
    ];
}

?>
<div class="overlay "></div>
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

                    <form method="POST" enctype="multipart/form-data">
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
                            <label class="form-label">
                                Image :
                            </label>
                            <div class="form-outline">
                                <input type="file" name="p_img" id="p_img" class="form-control" accept="image/png, image/jpeg" value="Image">
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