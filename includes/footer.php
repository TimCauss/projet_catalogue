<!-- Footer -->
<footer class="bg-dark text-center text-white mt-5">
    <!-- Grid container -->
    <div class="container footer-container p-4">
        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->

        <?php
        // Path: includes\footer.php

        if ($_POST) {
            if (!empty($_POST['newsletter'])) {

                try {
                    $conn = mysqli_connect("localhost", "root", "", "projet_catalogue");
                } catch (PDOException $e) {
                    echo "Echec de connexion à la BDD : " . $e->getMessage();
                }

                $email = $_POST['input-email'];
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = "INSERT INTO news_subscribers (ns_mail, nl_created_on) VALUES ('$email', NOW())";
                    $result_nl = mysqli_query($conn, $sql);
                } else {
                    echo '<style"color:#f54242";> Votre adresse email est invalide </style>';
                }
            } else {
                echo "Veuillez entrer une adresse email";
            }
        }

        ?>

        <!-- Section: Form -->
        <section class="">
            <!--Grid row-->
            <div class="row d-flex justify-content-center">
                <!--Grid column-->
                <div class="col-auto">
                    <p class="pt-2">
                        <strong>Inscrivez-vous à notre newsletter</strong>
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-5 col-12">
                    <!-- Email input -->
                    <div class="form-outline form-white mb-4">
                        <form method="POST">
                            <input type="email" id="form5Example21" name="input-email" class="form-control" />
                            <label class="form-label" for="form5Example21">Adresse Email</label>
                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-auto">
                    <!-- Submit button -->
                    <input type="submit" name="newsletter" class="btn btn-outline-light mb-4" value="S'inscrire">

                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            </form>
        </section>
        <!-- Section: Form -->

        <!-- Section: Text -->
        <section class="mb-4">
            <p>
                Souscrivez à notre newsletter pour recevoir les dernières informations sur les pokémons. Vous pouvez vous désinscrire à tout moment.
                Vous recevrez les derniers pokémons ajoutés à la liste. Et les dernières modifications apportées au site.
            </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">POKELISTE</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="./index.php" class="text-white">Accueil</a>
                        </li>
                        <li>
                            <a href="./pokedex.php" class="text-white">Pokedex</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Qui sommes nous ?</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->


            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="">pokeliste.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->