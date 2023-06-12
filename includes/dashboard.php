<?php
//On prépare une variable $isadmin pour stocker si l'utilisateur est admin ou non
//On prépare une variable $sql pour stocker la requête SQL
if ($_SESSION['user']['user_role'] === 1) {
    $isadmin = true;
    $sql = "SELECT p_id, nom, numero, p_type, `p_type-2`, evolutions, created_by, created_on  FROM pokemon";
} else {
    $isadmin = false;
    $sql = "SELECT p_id, nom, numero, p_type, `p_type-2`, evolutions, created_on FROM pokemon WHERE created_by = " . $_SESSION['user']['user_id'];
}

//on se connect à la db (Pour changer on utilise mysqli au lieu de PDO)
try {
    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
} catch (PDOException $e) {
    echo "Echec de connexion à la BDD : " . $e->getMessage();
}

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

?>

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="./includes/p_delete.php?p_id=<?= $row['p_id'] ?>"><button type="button" class="btn btn-danger">Valider</button></a>
            </div>
        </div>
    </div>
</div>
<!-- Modal END -->

<section class="dash-wrapper"></section>
<h1>Tableau de bord</h1>

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
                <tr>
                    <th scope='row'><?= $row['numero'] ?></th>
                    <td><img class='dash-p-img' src='./uploads/<?= $row['nom'] ?>.png' alt="Image d'un pokemon"></td>
                    <td><?= $row['nom'] ?></td>
                    <td><?= $row['p_type'] ?></td>
                    <td><?= $row['p_type-2'] ?></td>
                    <?php if ($isadmin) {
                        //Si l'utilisateur est admin, on affiche la colonne "Créé par"
                        //On fetch les mails des utilisateurs pour les afficher
                        $sql = "SELECT email FROM users WHERE user_id = " . $row['created_by'];

                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                    ?>
                        <td><?= $row2['email'] ?></td>
                    <?php
                    }
                    ?>
                    <td><?= $row['created_on'] ?></td>
                    <td><a href="p_edit.php">Editer</a></td>
                    <td><a class="del-btn" data-toggle="modal" href="#delModal">Supprimer</a></td>
                </tr>
        <?php
            }
        } ?>

    </tbody>

</table>