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

    //On récupère le nom du pokemon à supprimer
    $sql = "SELECT p_name FROM pokemon WHERE p_id = $p_id";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $p_name = $row['p_name'];

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
            'ERROR RESULT' => "Une erreur est survenue lors de la suppression du Pokémon"
        ];
    }

    //on log la suppréssion en db :
    $user_id = $_SESSION['user']['user_id'];

    $log = "INSERT INTO `logs`(`user_id`,`log_description`, `log_pokemon` ,`log_date`) VALUES ('$user_id', ' a supprimé le Pokémon ', '$p_name', now())";
    $query_log = $conn->prepare($log);
    $query_log->execute();
} else {
    //Si l'id n'est pas récupérée, on stock un message d'erreur dans la session PHP :
    $_SESSION['action'] = [
        'ERROR ID' => "Une erreur est survenue lors de la suppression du Pokémon"
    ];
    die("Une erreur est survenue lors de la suppression du Pokémon");
}

//On redirige l'utilisateur vers la page précédente :
header('Location: ' . $_SERVER['HTTP_REFERER']);
