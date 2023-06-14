<?php

require_once "connect.php";

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $p_sql = "SELECT * FROM pokemon WHERE (p_type = '$type') OR (`p_type-2` ='$type') ORDER BY numero ";
    unset($_GET);
} else {
    $p_sql = "SELECT * FROM pokemon ORDER BY numero ASC";
}


$p_query = $db->prepare($p_sql);
$p_query->execute();
$p_result = $p_query->fetchAll(PDO::FETCH_ASSOC);


//TODO: Add a search bar to search for a pokemon by name or number or type
?>



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