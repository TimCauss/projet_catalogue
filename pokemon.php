<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


session_start();


// Connexion BDD
require_once "connect.php";
require './includes/fonctions.php';

// Initialisation des variables
$nom = $numero = $description = $taille = $poids = $types = "";
$evolutions = [];
$found = false; // flag pour check si un pokémon à été trouvé

// On récupère la requête GET, on la filtre pour n'accepter que les entier :
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];
    $query = "SELECT p.*, GROUP_CONCAT(t.type_name ORDER BY t.type_name SEPARATOR ', ') as types
        FROM pokemon p LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id LEFT JOIN types t ON pt.type_id = t.id
        WHERE p.id = :id GROUP BY p.id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    $evoChainQuery = "WITH RECURSIVE ancestor AS
                    (SELECT p.id, p.nom, p.evolves_from FROM pokemon p WHERE p.id = :id
                    UNION ALL SELECT p.id, p.nom, p.evolves_from FROM pokemon p INNER JOIN ancestor ON p.id = ancestor.evolves_from),
                    descendant AS (SELECT p.id, p.nom, p.evolves_from FROM pokemon p WHERE p.evolves_from = :id2 
                    UNION ALL SELECT p.id, p.nom, p.evolves_from FROM pokemon p INNER JOIN descendant ON p.evolves_from = descendant.id),
                    combined AS (SELECT id, nom FROM ancestor UNION SELECT id, nom FROM descendant)
                    SELECT c.id, c.nom, GROUP_CONCAT(t.type_name ORDER BY t.type_name SEPARATOR ', ') AS types
                    FROM combined c LEFT JOIN pokemon_types pt ON pt.pokemon_id = c.id LEFT JOIN types t ON t.id = pt.type_id
                    GROUP BY c.id, c.nom ORDER BY c.id";
    $evoStmt = $db->prepare($evoChainQuery);
    $evoStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $evoStmt->bindParam(':id2', $id, PDO::PARAM_INT);
    $evoStmt->execute();
    $evoChain = $evoStmt->fetchAll(PDO::FETCH_ASSOC);

    if ($row) {
        $nom = $row['nom'];
        $numero = $row['numero'];
        $description = $row['description'];
        $taille = $row['taille'];
        $poids = $row['poids'];
        $types = $row['types'];
        $found = true;

        // Trouver l'ID du Pokémon précédent
        $prevQuery = "SELECT id FROM pokemon WHERE id < :currentId ORDER BY id DESC LIMIT 1";
        $prevStmt = $db->prepare($prevQuery);
        $prevStmt->bindParam(':currentId', $id, PDO::PARAM_INT);
        $prevStmt->execute();
        $prevRow = $prevStmt->fetch(PDO::FETCH_ASSOC);
        $url_prev = $prevRow ? "pokemon.php?id=" . $prevRow['id'] : "#";

        // Trouver l'ID du Pokémon suivant
        $nextQuery = "SELECT id FROM pokemon WHERE id > :currentId ORDER BY id ASC LIMIT 1";
        $nextStmt = $db->prepare($nextQuery);
        $nextStmt->bindParam(':currentId', $id, PDO::PARAM_INT);
        $nextStmt->execute();
        $nextRow = $nextStmt->fetch(PDO::FETCH_ASSOC);
        $url_next = $nextRow ? "pokemon.php?id=" . $nextRow['id'] : "#";


        // Trouver l'ID max et min pour la navigation en boucle
        $maxMinQuery = "SELECT MAX(id) as maxId, MIN(id) as minId FROM pokemon";
        $maxMinStmt = $db->query($maxMinQuery);
        $maxMinRow = $maxMinStmt->fetch(PDO::FETCH_ASSOC);

        if ($prevRow) {
            $url_prev = "pokemon.php?id=" . $prevRow['id'];
        } else if ($maxMinRow) {
            $url_prev = "pokemon.php?id=" . $maxMinRow['maxId'];
        }

        if ($nextRow) {
            $url_next = "pokemon.php?id=" . $nextRow['id'];
        } else if ($maxMinRow) {
            $url_next = "pokemon.php?id=" . $maxMinRow['minId'];
        }
    } else {
        echo "<p class='erreur'>Aucun résultat pour le Pokémon demandé, <a href='profil.php'>ajoutez-le!</a></p>";
        exit;
    }
}
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
    //affichage header/navbar
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    ?>

    <?php if ($found) : ?>
        <div class="ind-wrapper">
            <div class="ind-container">
                <div class="p-header-nav">
                    <a href="<?= htmlspecialchars($url_prev) ?>" id="precedent">Précédent</a>
                    <a href="<?= htmlspecialchars($url_next) ?>" id="suivant">Suivant</a>
                </div>
                <div class="p-header-title">
                    <h1><?= htmlspecialchars($nom) ?></h1>
                </div>
            </div>
            <h4>n°<?= htmlspecialchars($numero) ?></h4>
            <section id="section1">
                <img id="pokemon" src="./uploads/<?= htmlspecialchars($nom) ?>.png" alt="<?= htmlspecialchars($nom) ?>">
                <div class="desc">
                    <p><?= htmlspecialchars($description) ?></p>
                    <ul class="p-input-det-wrapper">
                        <li>Taille: <span class="vert"><?= htmlspecialchars($taille) ?>m</span></li>
                        <li>Poids: <span class="vert"><?= htmlspecialchars($poids) ?>kg</span></li>
                    </ul>
                    <div class="type-container">
                        <h6>Type</h6>
                    </div>
                    <div class="type-container">
                        <?php foreach (explode(', ', $types) as $type) : ?>
                            <div class="type type-colors-<?= htmlspecialchars(strtolower(trim($type))) ?>">
                                <span><?= htmlspecialchars(strtoupper(trim($type))) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <section class="evolutions">
                <h2>Evolutions:</h2>
                <div class="arrow-container">
                    <div class="evo-container">
                        <?php foreach ($evoChain as $index => $evo) : ?>
                            <div class='evo'>
                                <a href='./pokemon.php?id=<?= $evo['id']; ?>'>
                                    <img src='uploads/<?= htmlspecialchars($evo['nom']); ?>.png' alt='<?= htmlspecialchars($evo['nom']); ?>' />
                                    <span class='poke'><?= htmlspecialchars($evo['nom']); ?></span>
                                </a>
                                <?php foreach (explode(', ', $evo['types']) as $type) : ?>
                                    <span class='evo-type type-colors-<?= strtolower($type); ?>'><?= htmlspecialchars($type); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($index < count($evoChain) - 1) : ?>
                                <span class='arrow'>→</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>

    <?php else : ?>
        <p class='erreur'>Aucun résultat pour le Pokémon demandé, <a href='profil.php'>ajoutez-le!</a></p>
    <?php endif; ?>
    <?php
    include_once "./includes/footer.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>