<?php
session_start();
require_once 'connect.php'; //Connexion BDD
//On déclare les variables du formulaire à vide pour éviter des bidouilles
$user = $email = $pass = $lastname = "";

// On affiche toutes les erreurs :
// error_reporting(E_ALL);
// ini_set('display_errors', 1);



//fonction qui va nettoyer les données du formulaire :
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    return $data;
}

/*fonction pour calculer le temps d'execution
Renvois un temps en sec, prend en arguments 2 valeurs microtime */
function timing($timeStart, $timeEnd)
{
    return $timeEnd - $timeStart;
}


//On check le POST du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* --------------- REGISTER POST ------------------------*/
    if (isset($_POST["register-submit"])) {
        //On check si les champs sont remplis
        if (
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["pass"]) && !empty($_POST["pass"])
        ) {
            /*Si le formulaire est complet (Tous les champs ont été remplis)
        ============SECURITE DES DONNEES============
        On check si le prenom est valide (Seulement des lettres) */
            if (preg_match("/^[a-zA-Z-é' ]*$/", $_POST["username"])) {
                //Si le prenom est valide, on le nettoie
                $username = testInput($_POST["username"]);
            } else {
                //Si le prenom n'est pas valide, message d'erreur
                die("L'username n'est pas valide, seul les lettres sont autorisés");
            }

            //On check si l'username existe déjà dans la bdd:
            $usernamecheckSQL = "SELECT username FROM users";
            $usernameSQL = $db->prepare($usernamecheckSQL);
            $usernameSQL->execute();
            $usernameSQLList = $usernameSQL->fetchAll(PDO::FETCH_ASSOC);
            foreach ($usernameSQLList as $usernamedb) {
                if ($username == $usernamedb) {
                    die("Cet username n'est pas disponible");
                }
            }

            //On check si l'email est valide
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                //Si l'email est valide, on le nettoie
                $email = testInput($_POST["email"]);
            } else {
                //Si l'email n'est pas valide, message d'erreur
                die("L'email n'est pas valide");
            }
            //On check si l'email existe déjà dans la bdd:

            $mailcheckSQL = "SELECT email FROM users";
            $mailSQL = $db->prepare($mailcheckSQL);
            $mailSQL->execute();
            $mailSQLList = $mailSQL->fetchAll(PDO::FETCH_ASSOC);

            foreach ($mailSQLList as $mail) {
                if ($email == $mail) {
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

            //------------Enregistrement des données en BDD:----------------

            //Préparation et execution de la requête :
            $createUser = "INSERT INTO users(username, email, pass) VALUES (':username', ':email', ':hashedpass')";
            $createQuery = $db->prepare($createUser);
            $createQuery->bindValue(':username', $username);
            $createQuery->bindValue(':email', $email);
            $createQuery->bindValue(':pass', $hashedpass);
            $createQuery->execute();

            $userSQL = "SELECT user_id FROM users WHERE email = ':email'";
            $userQuery = $db->prepare($userSQL);
            $userQuery->bindValue(':email', $email);
            $userQuery->execute();
            $userResult = $userQuery->fetch(PDO::FETCH_ASSOC);

            $_SESSION["action"] = [
                "create_user" => 1
            ];

            $_SESSION["user"] = [
                "user_id" => $userResult["user_id"],
                "prenom" => $username,
                "email" => $email,
                "user_role" => 0
            ];
            header("Location: index.php");
        } else {
            //Si le formulaire est incomplet
            $_SESSION["er_msg"] = "00 - Veuillez remplir tous les champs";
        }
        /*--------------------------LOGIN POST---------------------------------*/
    } elseif (isset($_POST["login-submit"])) {
        //Verification des champs du formulaire :
        if (isset($_POST["login-email"]) && isset($_POST["login-pass"])) {
            $email = $_POST["login-email"];
            // on fetch les données utiles pour les vérification:
            $loginSQL = "SELECT user_id, email, username, pass, role FROM users WHERE email = '$email'";
            $loginQuery = $db->prepare($loginSQL);
            $loginQuery->execute();
            $loginResult = $loginQuery->fetch(PDO::FETCH_ASSOC);
            //On vérifie si l'utilisateur existe dans la bdd:
            if ($loginResult) {
                //Si l'utilisateur existe, on vérifie le mot de passe:
                if (password_verify($_POST["login-pass"], $loginResult["pass"])) {
                    //Si le mot de passe est correct, on crée la session:
                    $_SESSION["user"] = [
                        "user_id" => $loginResult["user_id"],
                        "username" => $loginResult["username"],
                        "email" => $loginResult["email"],
                        "user_role" => $loginResult["role"]
                    ];
                    header("Location: index.php");
                } else {
                    //Si le mot de passe est incorrect, message d'erreur:
                    $_SESSION["er_msg"] = "1 - Utilisateur ou Mot de passe incorrect";
                    die($_SESSION["er_msg"]);
                }
            } else {
                //Si l'utilisateur n'existe pas, message d'erreur:
                $_SESSION["er_msg"] = "2 - Utilisateur ou Mot de passe incorrect";
                die($_SESSION["er_msg"]);
            }
        }
    } else {
        $_SESSION["er_msg"] = "0 - Veuillez remplir les champs correctement.";
        die($_SESSION["er_msg"]);
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

        <div class="register-form-ctn container-form py-4 hidden-scale">
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
                                <!-- username input -->
                                <div class="form-outline mb-4">
                                    <input type="text" name="username" id="prenom" class="form-control" required>
                                    <label class="form-label" for="username">Username</label>
                                    <div class="valid-feedback">Ce champ est OK !</div>
                                    <div class="invalid-feedback">Veuillez remplir ce champ.</div>
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

        <div class="login-form-ctn container-form py-4">
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
                                        Se connecter
                                    </button>
                                    <p>Remplir le formulaire pour activer le bouton</p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php
    include_once "./includes/footer.php"
    ?>

    <script type="text/javascript" src="./JS/formValidation.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>

</html>