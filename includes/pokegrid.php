<?php
//On affiche toutes les erreur sql et php 
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
require_once "connect.php";
require_once "fonctions.php";


/* ----------------PAGINATION--------------------- */
// On initialise les variables de pagination
$currentPage = isset($_GET['page']) && !empty($_GET['page']) ? (int) strip_tags($_GET['page']) : 1;
$parPage = 16;

// On Calcul le premier élément de la page pour la requête SQL
$premier = ($currentPage - 1) * $parPage;


// On détermine le nombre total de pokemon
$sqlCount = 'SELECT COUNT(*) AS nb_pokemon FROM `pokemon`';
$queryCount = $db->prepare($sqlCount);
$queryCount->execute();
$resultCount = $queryCount->fetch();
$nbPokemon = (int) $resultCount['nb_pokemon'];

// On calcul le nombre de pages total
$pages = ceil($nbPokemon / $parPage);


/* ----------------PAGINATION-END----------------- */



/* ----------------REQUÊTE POKÉMON----------------- */

// Si on a une requete get contennant une valeur dans la clé search :
if (!empty($_GET['search'])) {
    $search = testInput($_GET['search']);
    // Si $search contient un entier :
    if (is_numeric($search)) {
        $search = pNumeroCheck($search);
    }
    // Requête :
    $p_sql = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(t.type_name ORDER by t.type_name SEPARATOR ', ') AS types
    FROM pokemon p
    INNER JOIN pokemon_types pt ON p.id = pt.pokemon_id
    INNER JOIN types t ON pt.type_id = t.id
    WHERE (p.nom LIKE :search OR p.numero LIKE :search2 OR t.type_name LIKE :search3)
    GROUP BY p.id
    ORDER BY p.numero ASC";
    $p_query = $db->prepare($p_sql);
    $searchTerm = $search . '%';
    $p_query->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    $p_query->bindValue(':search2', $searchTerm, PDO::PARAM_STR);
    $p_query->bindValue(':search3', $searchTerm, PDO::PARAM_STR);
} else {
    // Requête par défaut
    $p_sql = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(types.type_name SEPARATOR ', ') as types
        FROM pokemon p
        INNER JOIN pokemon_types ON p.id = pokemon_types.pokemon_id
        INNER JOIN types ON pokemon_types.type_id = types.id
        GROUP BY p.id
        ORDER BY p.numero ASC
        LIMIT :premier, :parPage";
    $p_query = $db->prepare($p_sql);
    $p_query->bindValue(':premier', $premier, PDO::PARAM_INT);
    $p_query->bindValue(':parPage', $parPage, PDO::PARAM_INT);
}

// Exécution de la requête
$p_query->execute();
$p_result = $p_query->fetchAll(PDO::FETCH_ASSOC);

// Vérification des résultats :
if (count($p_result) === 0) {
    $error = "<h3>Aucun résultat trouvé pour votre recherche.</h3>";
}


?>
<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <form method="GET" class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
        <button class="btn btn-outline-success" id="btnReset" onclick="window.location.href='pokedex.php'" value='reset'>Reset</button>
    </div>
</nav>


<section class="paginations">
    <div class="currentPage pt-2">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">
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
                        <a href="pokedex.php?&page= <?= $page ?>"><?= $page ?></a>
                    <?php endfor ?>
                </div>
                <?php if ($currentPage < $pages) : ?>
                    <a class="inline" href="pokedex.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
                <?php else : ?>
                    <div class="inline">&nbsp</div>
                <?php endif ?>
    </div>
</section>

<section class="container-grid p-grid pb-5">
    <div class="d-flex flex-row flex-wrap justify-content-center gap-3">
        <?php foreach ($p_result as $pokemon) :
            $types = explode(', ', $pokemon['types']); // Transforme la chaîne des types en tableau
        ?>
            <a href="./pokemon.php?id=<?= $pokemon['id'] ?>">
                <div class="p-card p2">
                    <figure class="grid-p-img" data-p_type="<?= strtolower(trim($types[0])) ?>">
                        <div class="circle"></div><img src="./uploads/<?= $pokemon['nom'] ?>.png" alt="pokemon img">
                    </figure>
                    <figcaption class="grid-p-details">
                        <div class="grid-p-nbr">n°<?= $pokemon['numero'] ?></div>
                        <div class="grid-p-name"><?= $pokemon['nom'] ?></div>
                        <div class="p-type-wrapper pt-2">
                            <?php
                            foreach ($types as $type) {
                                echo '<div class="grid-p-type1">' . strtoupper(trim($type)) . '</div>'; // Affiche chaque type
                            }
                            ?>
                        </div>

                    </figcaption>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</section>

<section class="paginations">
    <div class="currentPage pt-2">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">
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
                        <a href="pokedex.php?&page= <?= $page ?>"><?= $page ?></a>
                    <?php endfor ?>
                </div>
                <?php if ($currentPage < $pages) : ?>
                    <a class="inline" href="pokedex.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
                <?php else : ?>
                    <div class="inline">&nbsp</div>
                <?php endif ?>
    </div>
</section>

<script src="./JS/poke-grid.js"></script>
<script src="./JS/pagination.js"></script>