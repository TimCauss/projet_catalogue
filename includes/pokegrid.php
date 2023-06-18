<?php

require_once "connect.php";



if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $p_sql = "SELECT * FROM pokemon WHERE (p_type = '$type') OR (`p_type-2` ='$type') ORDER BY numero ";
    unset($_GET);
} else {
    $p_sql = "SELECT * FROM pokemon ORDER BY numero ASC";
}

if (!empty($_GET['search'])) {
    try {
        $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
    } catch (PDOException $e) {
        echo "Echec de connexion à la BDD : " . $e->getMessage();
    }
    $search = $_GET['search'];
    $p_sql = "SELECT * FROM pokemon WHERE (nom LIKE '%$search%') OR (numero LIKE '%$search%') OR (`p_type` LIKE '%$search%') OR (`p_type-2` LIKE '%$search%') ORDER BY numero ASC";
    //si la recherche ne donne rien, on affiche un message d'erreur
    if (mysqli_num_rows(mysqli_query($conn, $p_sql)) == 0) {
        $error = "<h3>Aucun résultat pour votre recherche</h3>";
    }
    unset($_GET);
}


$p_query = $db->prepare($p_sql);
$p_query->execute();
$p_result = $p_query->fetchAll(PDO::FETCH_ASSOC);


?>
<nav class="navbar navbar-expand-xl navbar-light bg-light">

    <div class="collapse navbar-collapse">
        <form method="GET" class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
            <button class="btn btn-outline-success" id="btnReset" onclick="window.location.href='pokedex.php'">Reset</button>
        </form>
    </div>

</nav>

<section class="container-grid p-grid pb-5">
    <div class="d-flex flex-row flex-wrap justify-content-center gap-5">
        <?php foreach ($p_result as $pokemon) : ?>
            <a href="./pokemon.php?id=<?= $pokemon['p_id'] ?>">
                <div class="p-card p2">
                    <figure class="grid-p-img" data-p_type="<?= strtolower($pokemon['p_type']) ?>">
                        <div class="circle"></div><img src="./uploads/<?= $pokemon['nom'] ?>.png" alt="pokemon img">
                    </figure>
                    <figcaption class="grid-p-details">
                        <div class="grid-p-nbr">n°<?= $pokemon['numero'] ?></div>
                        <div class="grid-p-name"><?= $pokemon['nom'] ?></div>
                        <div class="p-type-wrapper pt-2">
                            <div class="grid-p-type1"><?= strtoupper($pokemon['p_type']) ?></div>
                            <div class="grid-p-type2"><?= strtoupper($pokemon['p_type-2']) ?></div>
                        </div>

                    </figcaption>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</section>

<script src="./JS/poke-grid.js"></script>