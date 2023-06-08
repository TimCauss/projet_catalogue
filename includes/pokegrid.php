<?php

require_once "connect.php";

$p_sql = "SELECT * FROM pokemon ORDER BY numero ASC";
$p_query = $db->prepare($p_sql);
$p_query->execute();
$p_result = $p_query->fetchAll(PDO::FETCH_ASSOC);


?>
<section class="container p-grid">
    <div class="d-flex flex-row flex-wrap justify-content-center gap-5">
        <?php foreach ($p_result as $pokemon) : ?>
            <a href="./pokemon.php?id=<?= $pokemon['p_id'] ?>">
                <div class="p-card p2">
                    <figure class="grid-p-img" data-p_type="<?= $pokemon['p_type'] ?>"><img src="./uploads/<?= $pokemon['nom'] ?>.png" alt="pokemon img"></figure>
                    <figcaption class="grid-p-details">
                        <div class="grid-p-nbr">n°<?= $pokemon['numero'] ?></div>
                        <div class="grid-p-name"><?= $pokemon['nom'] ?></div>
                        <div class="grid-p-type1"><?= $pokemon['p_type'] ?></div>
                        <div class="grid-p-type2"><?= $pokemon['p_type-2'] ?></div>
                    </figcaption>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</section>

<script src="./JS/poke-grid.js"></script>