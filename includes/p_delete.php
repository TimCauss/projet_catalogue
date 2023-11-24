<?php

require_once "../connect.php";
session_start();


//On vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    die();
}


//On récupère l'id du pokemon à supprimer

if (isset($_GET['p_id']) && !empty($_GET['id'])) {
    //On stock l'id récupérée dans le GET dans une variable :
    $p_id = strip_tags($_GET['p_id']);
    // On récupère l'id et le rôle de l'utilisateur connecté
    $user_id = $_SESSION['user']['user_id'];
    $user_role = $_SESSOP['user']['user_role'];

    //On vérifie que le pokémon est lié à l'id utilisateur :
    $sql = "SELECT COUNT(*) FROM user_pokemon WHERE pokemon_id = :pokemon_id AND user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':pokemon_id', $p_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // On récupère le nombre de lignes qui correspondent à notre requête
    $isLinked = $stmt->fetchColumn();

    if ($isLinked > 0 || $user_role === 1) {
        //On récupère le nom du pokémon:
        $sql2 = "SELECT nom FROM pokemon WHERE id=:pokemon_id";
        $stmt2 = $db->prepare($sql2);
        $stmt2->bindParam(":pokemon_id", $p_id, PDO::PARAM_INT);
        $stmt2->execute();
        $nom = $stmt2->fetch()[0];

        // Requete de supression
        $sql_del = "DELETE FROM pokemon WHERE id = :pokemon_id";
        $query_del = $db->prepare($sql_del);
        $query_del->bindParam(':pokemon_id', $p_id, PDO::PARAM_INT);
        $query_del->execute();

        // On vérifie que la suppression n'a pas échouer :
        if ($query_del->rowCount() > 0) {
            // On stock le message de suppression dans la session:
            $_SESSION['action'] = [
                'Suppression' => "Le Pokémon " . $nom . " a bien été supprimé"
            ];
            // On peut également supprimer l'association dans user_pokemon
            $sql_del_assoc = "DELETE FROM user_pokemon WHERE pokemon_id = :pokemon_id";
            $stmt_del_assoc = $db->prepare($sql_del_assoc);
            $stmt_del_assoc->bindParam(':pokemon_id', $p_id, PDO::PARAM_INT);
            $stmt_del_assoc->execute();

            // On log l'action de l'utilisateur :
            $sql_log = "INSERT INTO user_logs (user_id, action_type, description) VALUES (:user_id, :action_type, :description)";
            $query_log = $db->prepare($sql_log);
            $query_log->bindValue(':user_id', $user_id);
            $query_log->bindValue(':action_type', 'Supression');
            $query_log->bindValue(':description', $nom);
            $query_log->execute();
            //On redirige l'utilisateur vers la page précédente :
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            // Erreur lors de la suppression
            $_SESSION['action'] = [
                'ERROR RESULT' => "Une erreur est survenue lors de la suppression du Pokémon"
            ];
            //On redirige l'utilisateur vers la page précédente :
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        //Si l'id n'est pas récupérée, on stock un message d'erreur dans la session PHP :
        $_SESSION['action'] = [
            'ERROR RESULT' => "Vous n'êtes pas autorisé à supprimer ce Pokémon"
        ];
        //On redirige l'utilisateur vers la page précédente :
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
//On redirige l'utilisateur vers la page précédente :
header('Location: ' . $_SERVER['HTTP_REFERER']);
