<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//on se connect à la db 
require_once "connect.php";
require_once "fonctions.php";
require_once "verify_session.php";


$user_id = $_SESSION['user']['user_id'];

if ($_SESSION['user']['user_role'] == 1) {
    $isadmin = true;
} else {
    $isadmin = false;
}


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
$parPage = 10;
//On calcule le nombre de pages total :
$pages = ceil($nbPokemon / $parPage);
// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;
/* ----------------PAGINATION-END----------------- */


/* ----------------Fetch des infos---------------- */
$error = "";


//Tableau des paramètres
$queryParams = array();


// si admin sans recherche :
if ($isadmin && empty($_GET['search'])) {
    $query = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(t.type_name ORDER by t.type_name SEPARATOR ', ') AS types,
    u.username FROM pokemon p
    LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id
    LEFT JOIN types t ON pt.type_id = t.id
    LEFT JOIN user_pokemon up ON p.id = up.pokemon_id
    LEFT JOIN users u ON up.user_id = u.user_id
    GROUP BY p.id, p.nom, p.numero, u.username
    ORDER BY p.numero ASC
    LIMIT :premier, :parPage";
} elseif ($isadmin && $_GET['search']) {
    $searchTerm =  $_GET['search'];
    $searchParam = "{$searchTerm}%";
    $query = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(t.type_name ORDER by t.type_name SEPARATOR ', ') AS types,
    u.username FROM pokemon p
    LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id
    LEFT JOIN types t ON pt.type_id = t.id
    LEFT JOIN user_pokemon up ON p.id = up.pokemon_id
    LEFT JOIN users u ON up.user_id = u.user_id
    WHERE (p.nom LIKE :search OR p.numero LIKE :search2 OR t.type_name LIKE :search3 OR u.username LIKE :search4)
    GROUP BY p.id, p.nom, p.numero, u.username
    ORDER BY p.numero ASC
    LIMIT :premier, :parPage";
    $queryParams[':search'] = testinput($searchParam);
    $queryParams[':search2'] = testinput($searchParam);
    $queryParams[':search3'] = testinput($searchParam);
    $queryParams[':search4'] = testinput($searchParam);
} elseif (!$isadmin && empty($_GET['search'])) {
    $query = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(t.type_name ORDER by t.type_name SEPARATOR ', ') AS types, u.username
    FROM pokemon p
    LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id
    LEFT JOIN types t ON pt.type_id = t.id
    LEFT JOIN user_pokemon up ON p.id = up.pokemon_id
    LEFT JOIN users u ON up.user_id = u.user_id
    WHERE up.user_id = :user_id
    GROUP BY p.id, p.nom, p.numero, u.username
    ORDER BY p.numero ASC
    LIMIT :premier, :parPage";
    $queryParams[':user_id'] = testinput($user_id);
} elseif (!$isadmin && $_GET['search']) {
    $searchTerm =  $_GET['search'];
    $searchParam = "{$searchTerm}%";
    $query = "SELECT p.id, p.nom, p.numero, GROUP_CONCAT(t.type_name ORDER by t.type_name SEPARATOR ', ') AS types, u.username
    FROM pokemon p
    LEFT JOIN pokemon_types pt ON p.id = pt.pokemon_id
    LEFT JOIN types t ON pt.type_id = t.id
    LEFT JOIN user_pokemon up ON p.id = up.pokemon_id
    LEFT JOIN users u ON up.user_id = u.user_id
    WHERE up.user_id = :user_id AND (p.nom LIKE :search1 OR p.numero LIKE :search2 OR t.type_name LIKE :search3)
    GROUP BY p.id, p.nom, p.numero, u.username
    ORDER BY p.numero ASC
    LIMIT :premier, :parPage";
    $queryParams[':user_id'] = testinput($user_id);
    $queryParams[':search1'] = testinput($searchParam);
    $queryParams[':search2'] = testinput($searchParam);
    $queryParams[':search3'] = testinput($searchParam);
}
$queryParams[':premier'] = testInput($premier);
$queryParams[':parPage'] = testinput($parPage);
$stmt = $db->prepare($query);
$stmt->execute($queryParams);

if ($stmt->rowCount() == 0) {
    $error = "<h4 style='text-align: center; padding-top: 150px; padding-bottom: 150px;'>Aucun Pokémon trouvé</h4>";
}


//On vérifie si la requête a retourné des résultats
$resultCheck = $stmt->rowCount(); // Obtenir le nombre de lignes affectées

if ($error != "") {
    echo $error;
} else {
    echo "<h1 style='text-align: center; padding-top: 15px;'>Tableau de bord</h1>";
?>

    <section class="paginations">
        <div class="currentPage pt-2">
            <form action="profil.php" method="get">
                Page<input type="text" id="inputPage" name="page" placeholder="<?= $currentPage ?>"> /<?= $pages ?>
            </form>
        </div>
        <div class="pagination">

            <?php if ($currentPage > 1) : ?>
                <a href="profil.php?page=<?= $currentPage - 1 ?>"><-- &nbsp</a>
                    <?php else : ?>
                        <div class="inline">&nbsp</div>
                    <?php endif ?>
                    <div>
                        <?php for ($page = max(1, $currentPage - 3); $page <= min($currentPage + 3, $pages); $page++) : ?>
                            <a href="profil.php?page=<?= $page ?>"><?= $page ?></a>
                        <?php endfor ?>
                    </div>
                    <?php if ($currentPage < $pages) : ?>
                        <a class="inline" href="profil.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
        </div>
    <?php else : ?>
        <div class="inline">&nbsp</div>
    <?php endif ?>
    </div>
    </section>

    <table class="table dash-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Pokémon</th>
                <th scope="col">Types</th>
                <?php if ($isadmin) : ?>
                    <th scope="col">Créé par</th>
                <?php endif; ?>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = htmlspecialchars($row['id']);
                    $nom = htmlspecialchars($row['nom']);
                    $username = testInput($row['username'] ?? "Inconnu");
            ?>
                    <tr class="dash-tr">
                        <th scope='row'><?= htmlspecialchars($row['numero']) ?></th>
                        <td><a href="/pokemon.php?id=<?= $id ?>"><img class='dash-p-img' src='./uploads/<?= $nom ?>.png' alt="Image du pokemon <?= $nom ?>"></a></td>
                        <td id="#td">
                            <div class="resp_th">Nom: </div><?= $nom ?>
                        </td>
                        <td class='type-td'>
                            <?= isset($row['types']) ? htmlspecialchars($row['types']) : 'N/A' ?>
                        </td>
                        <?php if ($isadmin) : ?>
                            <td>
                                <div class="resp_th">Créé par: </div><?= $username ?>
                            </td>
                        <?php endif; ?>
                        <div class="btn-wrapper">
                            <td><a href="p_edit.php?id=<?= $row['id'] ?>">Editer</a></td>
                            <td><button type="button" class="del-btn" data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Supprimer</button></td>
                        </div>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table>

    <!-- Modal START -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Suppression</h5>
                    </button>
                </div>
                <div class="modal-body">
                    Etes-vous sur de vouloir supprimer ce pokemon ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger go-del">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal END -->

    <section class="paginations">
        <div class="pagination">

            <?php if ($currentPage > 1) : ?>
                <a href="profil.php?page=<?= $currentPage - 1 ?>"><-- &nbsp</a>
                    <?php else : ?>
                        <div class="inline">&nbsp</div>
                    <?php endif ?>
                    <div>
                        <?php for ($page = max(1, $currentPage - 3); $page <= min($currentPage + 3, $pages); $page++) : ?>
                            <a href="profil.php?page=<?= $page ?>"><?= $page ?></a>
                        <?php endfor ?>
                    </div>
                    <?php if ($currentPage < $pages) : ?>
                        <a class="inline" href="profil.php?page=<?= $currentPage + 1 ?>">&nbsp--></a>
        </div>
    <?php else : ?>
        <div class="inline">&nbsp</div>
    <?php endif ?>
    </div>
    <div class="currentPage pt-2">
        <form action="profil.php" method="get">
            Page<input type="text" id="inputPage" name="page" placeholder="<?= $currentPage ?>"> /<?= $pages ?>
        </form>
    </div>
    </section>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
<script src="./JS/pagination.js"></script>
<script type="text/javascript" src="./JS/modal-profil.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="./CSS/style-main.css">
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: false,
            tokenSeparators: [',', ' '],
            placeholder: "Type(s)",
            maximumSelectionLength: 2
        });
    });
</script>