<?php
require "includes/verify_session.php";

//On vérifie que l'utilisateur est connecté et est administrateur :
if ($_SESSION["user"]["user_role"] == 1) {
    $isadmin = true;
} else {
    header("Location: ./profil.php");
}

require_once "./connect.php";
// Récupérez les logs
$sql = "SELECT user_logs.*, users.username FROM user_logs JOIN users ON user_logs.user_id = users.user_id ORDER BY user_logs.action_timestamp DESC";
$query = $db->prepare($sql);
$query->execute();
$logs = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Journal des actions</title>
    <link rel="stylesheet" href="./CSS/style-main.css">
</head>

<body>
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    ?>
    <div class="console">
        <?php foreach ($logs as $log) : ?>
            <p>
                [<?= $log['action_timestamp'] ?>] <?= htmlspecialchars($log['username']) ?>: <?= htmlspecialchars($log['action_type']) ?> - <?= htmlspecialchars($log['description']) ?>
            </p>
        <?php endforeach; ?>
    </div>

</body>

</html>