<?php

require_once "connect.php";


/* ----------------PAGINATION--------------------- */
// On determine sur quelle page nous sommes :
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

// On détermine le nombre total de pokemon
$sql = 'SELECT COUNT(*) AS nb_pokemon FROM `pokemon`';
$query = $db->prepare($sql);
$query->execute();
$nbResult = $query->fetch();
$nbPokemon = (int) $nbResult['nb_pokemon'];

// On détermine le nombre de pokemon par page
$parPage = 15;

//On calcule le nombre de pages total :
$pages = ceil($nbPokemon / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


/* ----------------PAGINATION-END----------------- */


if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $p_sql = "SELECT * FROM pokemon WHERE (p_type = '$type') OR (`p_type-2` ='$type') ORDER BY numero ASC";
    unset($_GET);
} else {
    $p_sql = "SELECT * FROM pokemon ORDER BY numero ASC LIMIT $premier, $parPage";
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


<div class="currentPage pt-2">
    <form action="pokedex.php" method="get">
        Page<input type="text" id="inputPage" name="page" placeholder="<?= $currentPage ?>"> /<?= $pages ?>
    </form>
</div>
<div class="pagination">

    <?php if ($currentPage > 1) : ?>
        <a href="pokedex.php?page=<?= $currentPage - 1 ?>"><-- &nbsp</a>
            <?php else : ?>
                <div class="inline">&nbsp</div>
            <?php endif ?>
            <div>
                <?php for ($page = max(1, $currentPage - 3); $page <= min($currentPage + 3, $pages); $page++) : ?>
                    <a href="pokedex.php?page=<?= $page ?>"><?= $page ?></a>
                <?php endfor ?>
            </div>
            <?php if ($currentPage < $pages) : ?>
                <a class="inline" href="pokedex.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
</div>
<?php else : ?>
    <div class="inline">&nbsp</div>
<?php endif ?>
</div>

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

<div class="pagination">

    <div class="pagination">

        <?php if ($currentPage > 1) : ?>
            <a href="pokedex.php?page=<?= $currentPage - 1 ?>"><-- &nbsp</a>
                <?php else : ?>
                    <div class="inline">&nbsp</div>
                <?php endif ?>
                <div>
                    <?php for ($page = max(1, $currentPage - 3); $page <= min($currentPage + 3, $pages); $page++) : ?>
                        <a href="pokedex.php?page=<?= $page ?>"><?= $page ?></a>
                    <?php endfor ?>
                </div>
                <?php if ($currentPage < $pages) : ?>
                    <a class="inline" href="pokedex.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
    </div>
<?php else : ?>
    <div class="inline">&nbsp</div>
<?php endif ?>
</div>

<div class="currentPage pb-5">
    <form action="pokedex.php" method="get">
        Page<input type="text" id="inputPage" name="page" placeholder="<?= $currentPage ?>"> /<?= $pages ?>
    </form>
</div>

<script src="./JS/poke-grid.js"></script>