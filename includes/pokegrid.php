<?php

require_once "connect.php";

$p_sql = "SELECT * FROM pokemon";
$p_query = $db->prepare($p_sql);
$p_query->execute();
$p_result = $p_query->fetchAll(PDO::FETCH_ASSOC);


?>
<section class="container">
    <div class="d-flex flex-row flex-wrap justify-content-center">
        <?php foreach ($p_result as $pokemon) : ?>
            <div class="p-card p2">
                <figure class="grid-p-img"><img src="./uploads/<?= $pokemon['nom'] ?>.png" alt="pokemon img"></figure>
                <figcaption class="grid-p-details">
                    <div class="grid-p-nbr">n°<?= $pokemon['numero'] ?></div>
                    <div class="grid-p-name"><?= $pokemon['nom'] ?></div>
                    <div class="grid-p-type1"><?= $pokemon['p_type'] ?></div>
                    <div class="grid-p-type2"><?= $pokemon['p_type-2'] ?></div>
                </figcaption>
            </div>
        <?php endforeach ?>
    </div>
</section>