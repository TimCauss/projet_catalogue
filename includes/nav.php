<nav class="main-nav">
    <ul>

        <li>
        </li>
        <div class="menu-nav">
            <li>
                <a href="index.php">
                    <div class="nav-item ni-1">Accueil</div>
                </a>
            </li>
            <li>
                <a href="pokedex.php">
                    <div class="nav-item ni-3">Pokedex</div>
                </a>
            </li>
            <li>
                <div class="nav-item ni-4">Random</div>
            </li>
            <?php if (isset($_SESSION["user"]["email"])) {
                include_once "profile_btn.php";
            } ?>
        </div>
    </ul>
    <div class="burger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <a class="nav-login-person">
        <div class="nav-item ni-login">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.1563 8.4375C19.9263 11.535 17.5775 14.0625 15 14.0625C12.4213 14.0625 10.0688 11.5363 9.84376 8.4375C9.60876 5.215 11.8938 2.8125 15 2.8125C18.105 2.8125 20.39 5.27375 20.1563 8.4375Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 17.8125C9.9025 17.8125 4.72875 20.625 3.77125 25.9338C3.65625 26.5738 4.0175 27.1875 4.6875 27.1875H25.3125C25.9825 27.1875 26.345 26.5738 26.23 25.9338C25.2713 20.625 20.0975 17.8125 15 17.8125Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </a>
    <div class="login-buttons">
        <?php if (isset($_SESSION["user"]["email"])) {
            echo "<a href='./deconnect.php'>Se déconnecter</a>";
        } else {
            echo "<a href='./login.php'>Se connecter</a>";
        } ?>
    </div>

</nav>

<script src="./JS/burger.js"></script>

<script src="./JS/nav.js"></script>