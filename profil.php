<?php
require "includes/verify_session.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./CSS/style-main.css">

    <title>Pokeliste - Mon Profil</title>
</head>

<body>



    <?php
    include_once "./includes/header.php";
    include_once "./includes/nav.php";
    include_once "./includes/profil_nav.php";
    include_once "./includes/creer.php";
    include_once "./includes/dashboard.php";


    if ($_SESSION['user']['user_role'] == 1) {
        include_once "./includes/users.php";
    }


    include_once "./includes/footer.php";
    ?>

    <!-- Toast notifications START -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto"><?= key($_SESSION['action']) ?></strong>
            <small class="text-muted">Infos</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span id="toastClose" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <?= $_SESSION['action'][key($_SESSION['action'])] ?>
        </div>
    </div>

    <?php
    if (isset($_SESSION['action'])) { ?>
        <script>
            window.onload = function() {
                $('.toast').toast('show');
            };

            toastClose.addEventListener("click", () => {
                $(".toast").toast("hide");
            });
        </script>
    <?php
        unset($_SESSION['action']);
    }
    ?>
    <!-- Toast notifications END -->


</body>

</html>