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
