<?php

$envPath = __DIR__ . '/.env';

if (file_exists($envPath)) {
    $envVars = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envVars as $envVar) {
        putenv($envVar);
    }
}

try {
    $serverName = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');

    $db = new PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8mb4", $username, $password, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_TIMEOUT => 30
    ]);
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}
