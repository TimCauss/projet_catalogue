<?php
session_start()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="CSS/style-main.css">
    <title>pokemon</title>
</head>

<body>
    <?php
    //connexion bdd
    require_once "connect.php";

    //récupération de l'id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //requête sql
        $query = "SELECT * FROM pokemon WHERE p_id = $id";
    } elseif (isset($_GET['numero'])) {
        $numero = $_GET['numero'];
        $query = "SELECT * FROM pokemon WHERE numero = $numero";
    }
        else {
            echo "<p class='erreur'>Aucun résultat pour le pokemon demandé, <a href='profil.php'>ajoutez le!</a></p>";
            exit;
        }
        $sql = $db->prepare($query);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        //récupération des informations du pokemon
        if ($row !== false) {
            $nom = $row['nom'];
            $numero = $row['numero'];
            $description = $row['p_description'];
            $taille = $row['taille'];
            $poids = $row['poids'];
            $type = $row['p_type'];
            $type2 = $row['p_type-2'];
            $evolutions = explode(",", $row['evolutions']);
            $num_prev = $numero - 1;
            $num_next = $numero + 1;
            $url_prev = "pokemon.php?numero=$num_prev";
            $url_next = "pokemon.php?numero=$num_next";

        }
        else {
            include_once "./includes/header.php";
            include_once "./includes/nav.php";
            echo "<p class='erreur'>Aucun résultat pour le pokemon demandé, <a href='profil.php'>ajoutez le!</a></p>";
            exit;
        }
            
        
    
   

    //affichage header/navbar
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    ?>

    <div class="ind-wrapper">
        <div class="ind-container">
            <div class="p-header-nav">
                <a href="<?= $url_prev ?>" id="precedent">Précédent</a>
                <a href="<?= $url_next ?>" id="suivant">Suivant</a>
            </div>
            <div class="p-header-title">
                <h1><?= $nom ?></h1>
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
                </div>
                <div class="type-container">
                    <div class="type type-colors-<?= $type ?>"><?php echo "<span>" . $type . "</span>" ?></div>
                    <div class="type type-colors-<?= $type2 ?>"><?php echo "<span>" . $type2 . "</span>" ?></div>
                </div>
            </div>
        </section>
        <section class="evolutions">
            <h2>Evolutions:</h2>
            <div class="arrow-container">
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
                            echo "<span class=\"evo-type type-colors-$evo_type\">$evo_type</span>";
                            echo "<span class=\"evo-type type-colors-$evo_type2\">$evo_type2</span>";
                            echo "</div> ";
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
        </section>
    </div>

    <?php
    include_once "./includes/footer.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>