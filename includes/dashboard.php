<?php

$user_id = $_SESSION['user']['user_id'];

if ($_SESSION['user']['user_role'] == 1) {
    $isadmin = true;
} else {
    $isadmin = false;
}

//on se connect à la db (Pour changer on utilise mysqli au lieu de PDO)
try {
    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
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
$parPage = 15;

//On calcule le nombre de pages total :
$pages = ceil($nbPokemon / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;


/* ----------------PAGINATION-END----------------- */


$error = "";

//On prépare une variable $isadmin pour stocker si l'utilisateur est admin ou non
//On prépare une variable $sql pour stocker la requête SQL
if ($isadmin && empty($_GET['search'])) {
    $sql = "SELECT p_id, nom, numero, p_type, `p_type-2`, evolutions, created_by, created_on FROM pokemon ORDER BY numero ASC LIMIT $premier, $parPage";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
        $error = "<h3>Vous n'avez pas encore ajouté de Pokémon</h3>";
    }
} elseif (!$isadmin && empty($_GET['search'])) {
    $sql = "SELECT p_id, nom, numero, p_type, `p_type-2`, evolutions, created_on FROM pokemon WHERE created_by = '$user_id' ORDER BY numero ASC LIMIT $premier, $parPage";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
        $error = "<h3>Vous n'avez pas encore ajouté de Pokémon</h3>";
    }
} elseif ($isadmin && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM pokemon WHERE (nom LIKE '%$search%') OR (numero LIKE '%$search%') OR (`p_type` LIKE '%$search%') OR (`p_type-2` LIKE '%$search%') ORDER BY numero ASC";
    //si la recherche ne donne rien, on affiche un message d'erreur
    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
        $error = "<h3 style='text-align: center; padding-top: 15px;'>Aucun résultat pour votre recherche</h3>";
    }
    unset($_GET);
} elseif (!$isadmin && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM pokemon WHERE (nom LIKE '%$search%') OR (numero LIKE '%$search%') OR (`p_type` LIKE '%$search%') OR (`p_type-2` LIKE '%$search%') AND created_by = '$user_id' ORDER BY numero ASC";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
        $error = "<h3 style='text-align: center; padding-top: 15px;'>Aucun résultat pour votre recherche</h3>";
    }
    unset($_GET);
}


$result = mysqli_query($conn, $sql);

//On vériifie si la requête a retourné des résultats
$resultCheck = mysqli_num_rows($result);

if ($error != "") {
    echo $error;
} else {
    echo "<h1 style='text-align: center; padding-top: 15px;'>Tableau de bord</h1>";
}
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
            <th scope="col">Type</th>
            <th scope="col">Type 2</th>
            <?php if ($isadmin) { ?>
                <th scope="col">Créé par</th>
            <?php } ?>
            <th scope="col">Créé le</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="dash-tr">
                    <th scope='row'><?= $row['numero'] ?></th>
                    <td><img class='dash-p-img' src='./uploads/<?= $row['nom'] ?>.png' alt="Image d'un pokemon"></td>
                    <td id="#td">
                        <div class="resp_th">Nom: </div><?= $row['nom'] ?>
                    </td>
                    <td>
                        <div class="resp_th">Type 1: </div><?= $row['p_type'] ?>
                    </td>
                    <td>
                        <div class="resp_th">Type 2: </div><?= $row['p_type-2'] ?>
                    </td>
                    <?php if ($isadmin) {
                        //Si l'utilisateur est admin, on affiche la colonne "Créé par"
                        //On fetch les mails des utilisateurs pour les afficher
                        $sql = "SELECT email FROM users WHERE user_id = " . $row['created_by'];

                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                    ?>
                        <td>
                            <div class="resp_th">Créé par: </div><?= $row2['email'] ?>
                        </td>
                    <?php
                    }
                    ?>
                    <td>
                        <div class="resp_th">Créé le: </div><?= $row['created_on'] ?>
                    </td>
                    <div class="btn-wrapper">
                        <td><a href="p_edit.php?id=<?= $row['p_id'] ?>">Editer</a></td>
                        <td><button type="button" class="del-btn" data-id="<?= $row['p_id'] ?>">Supprimer</button></td>
                    </div>
                </tr>
        <?php
            }
        } ?>
        <!-- Modal START -->
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Etes-vous sur de vouloir supprimer ce pokemon ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                        <button type="button" class="btn btn-danger go-del">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal END -->
    </tbody>

</table>

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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
<script src="./JS/modal-profil.js"></script>
<script src="./JS/pagination.js"></script>