<?php

session_start();


//On vérifie que l'utilisateur est connecté
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

//On récupère l'id du pokemon à supprimer

if (isset($_GET['p_id'])) {
    //On stock l'id récupérée dans le GET dans une variable :
    $p_id = $_GET['p_id'];
    //On prépare la requête SQL :
    $sql = "DELETE FROM pokemon WHERE p_id = $p_id";
    //On execute la requête :
    $result = mysqli_query($conn, $sql);
    //On vérifie que la requête s'est bien executée :
    if ($result) {
        //Si oui, on stock un message de succès dans la session PHP :
        $_SESSION['action'] = [
            'Suppression' => "Le Pokémon a bien été supprimé"
        ];
    } else {
        //Si non, on stock un message d'erreur dans la session PHP :
        $_SESSION['action'] = [
            'ERROR' => "Une erreur est survenue lors de la suppression du Pokémon"
        ];
    }
}

//On redirige l'utilisateur vers la page précédente :
header('Location: ' . $_SERVER['HTTP_REFERER']);
