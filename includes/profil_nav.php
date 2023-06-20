<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item profil-nav-item">
                <div class="nav-link trg-btn">Ajouter</div>
            </li>
            <?php
            if ($_SESSION['user']['user_role'] == 1) {
                include_once "./includes/profile_user_btn.php";
            }
            ?>
        </ul>
        <form method="GET" class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
        <button class="btn btn-outline-success" id="btnReset" onclick="window.location.href='profil.php'" value='reset'>Reset</button>
    </div>
</nav>