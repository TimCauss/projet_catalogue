<?php

try {
    $server_name = "localhost";
    $dbname = "projet_catalogue";

    $username = "root";
    $password = "";

    $db = new PDO("mysql:host=$server_name;dbname=$dbname;charset=utf8mb4", $username, $password);
    
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}
