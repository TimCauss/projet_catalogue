<?php

session_start();

//On vérifie que l'utilisateur est connecté et est administrateur :
if (!empty($_SESSION["user"]) && $_SESSION["user"]["user_role"] == 1) {
    $isadmin = true;
} else {
    header("Location: ./profil.php");
}

//on connect la db:
try {
    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}

//On récupères les logs de la db:
$sql = "SELECT * FROM logs ORDER BY l_id DESC";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style-main.css">
    <title>Pokeliste - Logs</title>
</head>

<body>
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";

    if ($resultCheck > 0) {
        //On stock toutes les valeurs de la bdd dans des variables :

        $rows = mysqli_fetch_all($result);
        $i = 0;
    ?>
        <table class="table table-log table-striped">
            <tbody>
                <?php
                foreach ($rows as $row) {
                    $l_id = $row[0];
                    $user_id = $row[1];
                    $log_description = $row[2];
                    $log_pokemon = $row[3];
                    $log_date = $row[4];

                    $logsSql = "SELECT user_id, prenom, lastname, `email` FROM users WHERE user_id = '$user_id' ";
                    $resultLog = mysqli_query($conn, $logsSql);
                    $loggerData = mysqli_fetch_assoc($resultLog);

                    $loggerInfos = $loggerData["prenom"] . " " . $loggerData["lastname"] . " [" . $loggerData["email"] . "]";

                    $pSql = "SELECT nom FROM pokemon WHERE p_id = '$log_pokemon' ";
                    $pResult = mysqli_query($conn, $pSql);
                    $pName = mysqli_fetch_assoc($pResult);

                    if (empty($pName["nom"])) {
                        $pName["nom"] = " Not found ";
                    }
                ?>

                    <tr>
                        <td scope="row"><?= $i ?></td>
                        <td><?php echo $log_date . " - " . $loggerInfos . " " . $row[2] . "[" . $log_pokemon . "]" ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<h1>Aucun Logs à afficher</h1>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>