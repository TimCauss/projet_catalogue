<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit;
}

$user_id = $_SESSION['user']['user_id'];
$user_token = $_SESSION['user']['user_token'];

require_once 'connect.php';
$query = "SELECT token, token_exp FROM users WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$exp = strtotime($row['token_exp']);

// On compare les 2 tokens
if ($row['token'] != $user_token) {
    unset($_SESSION['user']);
    $_SESSION["er_msg"] = "Session invalide";
    header("Location: ./login.php");
    exit;
}

// On vérifie si le token est expiré :
if ($exp < time()) {
    unset($_SESSION['user']);
    $_SESSION["er_msg"] = "Session expirée";
    header("Location: ./login.php");
    exit;
}
