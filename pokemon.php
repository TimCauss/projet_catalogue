<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>pokemon</title>
</head>

<body>
<?php
require_once "connect.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM pokemon WHERE id = :id";

    $sql = $db->prepare($query);

    $sql->bindParam(':id', $id);

    $sql->execute();

    
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $nom = $row['nom'];
        $numero = $row['numero'];
        $img = $row['img'];
        $description = $row['description'];
        $taille = $row['taille'];
        $poids = $row['poids'];
        $type = $row['type'];
    } else {
        echo "Aucun résultat.";
    }
} 
?>




    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    ?>
    <div class="contenaire">
        <a href="" id="precedent">Précédent</a> <a href="" id="suivant">Suivant</a>
        <h1><?php echo $nom; ?></h1>
    </div>
    <h4>n°<?php echo $numero; ?></h4>
    <section id="section1">
        <img id="bulbizarre" src="<?php echo $img; ?>" alt="bulbizarre">
        <div class="desc">
            <p><?php echo $description; ?></p>

            <ul>
                <li>Taille: <span class="vert"><?php echo $taille; ?></span></li>
                <li>Poids: <span class="vert"><?php echo $poids; ?></span></li>
                
            </ul>

            <h6>Type</h6>
            <div class="<?=$type?>"><?php echo $type; ?></div>
            
        </div>
    </section>
    <section class="evolutions">
        <h2>Evolutions:</h2>
        <div class="evo-container">
        <div class="evo">
            <img src="img/pokemon/001.png">
            <span class="poke">Bulbizarre</span> 
            <span class="plante">PLANTE </span>
            <span class="poison">POISON</span>
        </div>
        <span class="arrow">→</span>
        <div class="evo">
            <img src="img/pokemon/002.png">
            <span class="poke">Herbizarre</span>
            <span class="plante">PLANTE </span>
            <span class="poison">POISON</span>
        </div>
        <span class="arrow">→</span>
        <div class="evo">
            <img src="img/pokemon/003.png">
            <span class="poke">Florizarre</span>
            <span class="plante">PLANTE </span>
            <span class="poison">POISON</span>
        </div>
    </div>
    </section>

</body>

</html>
