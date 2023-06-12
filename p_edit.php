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

//On vérifie que le GET existe et qu'il n'est pas vide
if (isset($_GET['id']) && !empty($_GET['id'])) {
    //On stocke l'id récupérée dans le GET dans une variable :
    $p_id = $_GET['id'];
    //On prépare une requête SQL pour récupérer les infos du pokémon à éditer :
    $sql = "SELECT * FROM pokemon WHERE p_id = $p_id";
    //On execute la requête :
    $result = mysqli_query($conn, $sql);
    //On vérifie que la requête s'est bien executée :
    if ($result) {
        //Si oui, on stock les infos du pokémon dans une variable :
        $row = mysqli_fetch_assoc($result);
        //On stock les infos du pokémon dans des variables :
        $nom = $row['nom'];
        $numero = $row['numero'];
        $description = $row['p_description'];
        $taille = $row['taille'];
        $poids = $row['poids'];
        $type = $row['p_type'];
        $type2 = $row['p_type-2'];
        $evolutions = explode(",", $row['evolutions']);
    } else {
        //Si non, on stock un message d'erreur dans la session PHP :
        $_SESSION['action'] = [
            'ERROR EDIT' => "Une erreur est survenue inpossible de récupérer les données du Pokémon"
        ];
        die();
        header('Location: profil.php');
    }
} else {
    //Si l'id n'est pas récupérée, on stock un message d'erreur dans la session PHP :
    $_SESSION['action'] = [
        'ERROR ID' => "Une erreur est survenue lors de la récupération des données du Pokémon"
    ];
    die();
    header('Location: profil.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokeliste - Mon Profil</title>
</head>

<body>

    <?php
    include_once './includes/header.php';
    include_once './includes/nav.php';
    ?>

    <div class="ind-wrapper">
        <div class="ind-container">
            <div class="p-header-nav">
                <a href="" id="retour">Retour</a>
                <a href="" id="valider">Valider</a>
            </div>
            <form method="POST">
                <div class="p-header-title">
                    <input class="input-h1" type="text" value="<?= $nom ?>">
                </div>
        </div>
        <h4>n°<?= $numero ?></h4>
        <section id="section1">
            <img id="pokemon" src="./uploads/<?= $nom ?>.png" alt="<?= $nom ?>">
            <div class="desc">
                <p><?php echo $description; ?></p>

                <ul>
                    <li>Taille: <span class="vert"><?php echo $taille; ?>m</span></li>
                    <li>Poids: <span class="vert"><?php echo $poids; ?>kg</span></li>
                </ul>
                <div class="type-container">
                    <h6>Type</h6>
                    <div class="type <?= $type ?>"><?php echo $type ?></div>
                    <div class="type <?= $type2 ?>"><?php echo $type2 ?></div>
                </div>
            </div>
        </section>
        <section class="evolutions">
            <h2>Evolutions:</h2>
            <div class="evo-container">
                <?php
                foreach ($evolutions as $evo_nom) {
                    //requête SQL pour récupérer les informations de l'évolution courante
                    $query = "SELECT * FROM pokemon WHERE nom = :nom";
                    $sql = $db->prepare($query);
                    $sql->bindParam(':nom', $evo_nom);
                    $sql->execute();
                    $row = $sql->fetch(PDO::FETCH_ASSOC);


                    // Vérifiez si la requête SQL a renvoyé des résultats
                    if ($row !== false) {
                        // Récupérez les informations de l'évolution courante
                        $evo_id = $row['p_id'];
                        $evo_nom = $row['nom'];
                        $evo_numero = $row['numero'];
                        $evo_type = $row['p_type'];
                        $evo_type2 = $row['p_type-2'];
                        echo "<div class=\"evo\">";
                        echo "<a href='./pokemon.php?id=$evo_id'><img src=\"uploads/$evo_nom.png\">";
                        echo "<span class=\"poke\">$evo_nom</span></a>";
                        echo "<span class=\"evo-type $evo_type\">$evo_type</span>";
                        echo "<span class=\"evo-type $evo_type2\">$evo_type2</span>";
                        echo "</div>";
                    } else {
                        // La requête SQL n'a renvoyé aucun résultat
                        echo "Aucun résultat pour l'évolution '$evo_nom'.";
                    }
                    if (next($evolutions)) {
                        echo "<span class=\"arrow\">→</span>";
                    }
                }
                ?>
            </div>
            </form>
        </section>
    </div>

</body>

</html>