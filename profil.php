<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokeliste - Mon Profil</title>
</head>

<body>
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    include_once "./includes/profil_nav.php";
    include_once "./includes/creer.php";

    if ($_SESSION['user']['role'] == 1) {
        include_once "./includes/users.php";
    }
    ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script type="text/javascript" src="./js/modal-ajouter.js"></script>
</body>

</html>