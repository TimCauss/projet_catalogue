<?php

session_start();

// on vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // on vérifie si l'utilisateur est un admin
    if (!$_SESSION['user']['role'] == 1) {
        // s'il n'est pas admin, on le redirige vers la page d'accueil
        header('Location: index.php');
    }
} else {
    // on redirige vers la page de connexion
    header('Location: login.php');
}

?>

<h1>Liste des utilisateurs :</h1>