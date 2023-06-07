<?php
//On déclare les variables du formulaire à vide pour éviter des bidouilles
$prenom = $email = $pass = $lastname = "";

//fonction qui va nettoyer les données du formulaire :
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*fonction pour calculer le temps d'execution
Renvois un temps en sec, prend en arguments 2 valeurs microtime */
function timing($timeStart, $timeEnd)
{
    return ($timeEnd - $timeStart);
}


//On check le POST du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* --------------- REGISTER POST ------------------------*/
    if (isset($_POST["register-submit"])) {
        //On check si les champs sont remplis
        if (
            isset($_POST["prenom"]) && !empty($_POST["prenom"]) &&
            isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["pass"]) && !empty($_POST["pass"])
        ) {
            /*Si le formulaire est complet (Tous les champs ont été remplis)
        ============SECURITE DES DONNEES============
        On check si le prenom est valide (Seulement des lettres) */
            if (preg_match("/^[a-zA-Z-é' ]*$/", $_POST["prenom"])) {
                //Si le prenom est valide, on le nettoie
                $prenom = testInput($_POST["prenom"]);
            } else {
                //Si le prenom n'est pas valide, message d'erreur
                die("Le prénom n'est pas valide, seul les lettres sont autorisés");
            }
            //On check si le nom est valide (Seulement des lettres)
            if (preg_match("/^[a-zA-Z-' ]*$/", $_POST["lastname"])) {
                //Si le nom est valide, on le nettoie
                $lastname = testInput($_POST["lastname"]);
            } else {
                //Si le nom n'est pas valide, message d'erreur
                die("Le nom n'est pas valide, seul les lettres sont autorisés");
            }

            //On check si l'email est valide
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                //Si l'email est valide, on le nettoie
                $email = testInput($_POST["email"]);
            } else {
                //Si l'email n'est pas valide, message d'erreur
                die("L'email n'est pas valide");
            }
            //On check si l'email existe déjà :
            require_once 'connect.php'; //Connexion BDD

            $mailcheckSQL = "SELECT email FROM users";
            $mailSQL = $db->prepare($mailcheckQ);
            $mailSQL->execute();
            $mailSQLList = $mailSQL->fetchAll(PDO::FETCH_ASSOC);

            foreach ($mailSQLList as $mail) {
                if ($email == $mailSQLList) {
                    die("Adresse email déjà utilisée.");
                }
            }

            //On vérifie le password longueur minumum 5char:
            if (strlen($_POST["pass"]) < 5) {
                die("Mot de passe invalide; Longueur mini : 5");
            }
            //On check si les 2 mot de passe sont identiques:
            if ($_POST["pass"] != $_POST["pass2"]) {
                die("Les 2 champs mot de passe ne sont pas identiques");
            }

            //On déclare les options de hash pour le password:
            $options = [
                PASSWORD_ARGON2_DEFAULT_MEMORY_COST => 1 << 17,
                PASSWORD_ARGON2_DEFAULT_TIME_COST => 2,
                PASSWORD_ARGON2_DEFAULT_THREADS => 2
            ];
            //On Hash le password : (0.25s en moyenne)
            $hashedpass = password_hash($_POST["pass"], PASSWORD_ARGON2ID, $options);

            //------------Enregistrement des données en BSS:----------------

            //Préparation et execution de la requête :
            $createUser = "INSERT INTO users(prenom, lastname, email, pass) VALUES ('$prenom', '$lastname', '$email', '$hashedpass')";
            $createQuery = $db->prepare($createUser);
            $createQuery->execute();

            $_SESSION["action"] = [
                "create_user" => 1
            ];

            $_SESSION["user"] = [
                "prenom" => $prenom,
                "lasname" => $lasname,
                "email" => $email
            ];
            header("Location: index.php");
        } else {
            //Si le formulaire est incomplet
            $_SESSION["er_msg"] = "Veuillez remplir tous les champs";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./CSS/style-main.css">
    <title>Pokelist - Login Page</title>
</head>

<body onload="formVerif()">
    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    ?>

    <section class="login-ctn">

        <div class="register-form-ctn container py-4 hidden-scale">
            <div class="row g-0 align-items-center">
                <div class="mb-5 mb-lg-0">
                    <div class="login-card card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-1">Créer un compte</h2>
                            <div class="form-msg mb-5">
                                <a class="form-change">Se connecter</a>
                            </div>
                            <form method="POST" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                                            <label class="form-label" for="prenom">Prénom</label>
                                            <div class="valid-feedback">Ce champ est OK !</div>
                                            <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                                            <label class="form-label" for="lastname">Nom</label>
                                            <div class="valid-feedback">Ce champ est OK !</div>
                                            <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    <label class="form-label" for="email">Adresse Email</label>
                                    <div class="valid-feedback">Ce champ est OK !</div>
                                    <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="pass" id="pass" class="form-control" required>
                                    <label class="form-label" for="pass">Mot de passe (Longueur 5 min)</label>
                                    <div class="invalid-feedback">5 caractères minimum.</div>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="pass2" id="pass2" class="form-control" required>
                                    <label class="form-label" for="pass2">Vérification du mot de passe</label>
                                    <div class="invalid-feedback">Les mots de passes ne sont pas identiques</div>
                                </div>
                                <!-- Submit button -->
                                <button type="submit" name="register-submit" id="submitForm" disabled="" class="btn btn-primary btn-block mb-4">
                                    S'enregistrer
                                </button>
                                <p>Remplir le formulaire pour activer le bouton</p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-form-ctn container py-4">
            <div class="row g-0 align-items-center">
                <div class="mb-5 mb-lg-0">
                    <div class="login-card card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-1">Se connecter</h2>
                            <div class="form-msg mb-5">
                                <a class="form-change2">S'enregitrer</a>
                            </div>
                            <form method="POST" class="needs-validation" novalidate>
                                <div class="row">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="email" name="login-email" id="login-email" class="form-control" required>
                                        <label class="form-label" for="login-email">Adresse Email</label>
                                        <div class="valid-feedback">Ce champ est OK !</div>
                                        <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                    </div>
                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="login-pass" id="login-pass" class="form-control" required>
                                        <label class="form-label" for="login-pass">Mot de passe</label>
                                        <div class="invalid-feedback">Veuillez renseigner un mot de passe.</div>
                                    </div>
                                    <!-- Submit button -->
                                    <button type="submit" name="login-submit" id="submitLogin" disabled="" class="btn btn-primary btn-block mb-4">
                                        S'enregistrer
                                    </button>
                                    <p>Remplir le formulaire pour activer le bouton</p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <script type="text/javascript" src="./JS/formValidation.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>

</html>