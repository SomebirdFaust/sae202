<?php
require 'admin/lib.inc.php';
session_start();

$user_id = $_POST['user_id'];

try {
    $mabd = connexionBD();
    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_id = :user_id');
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $mabd->beginTransaction();

        $req_delete_trajets = $mabd->prepare('DELETE FROM trajets WHERE _user_id = :_user_id;
                                              DELETE FROM reservations WHERE _user_id = :_user_id;');
        $req_delete_trajets->bindValue(':_user_id', $user_id, PDO::PARAM_INT);
        $req_delete_trajets->execute();

        $req_delete_utilisateur = $mabd->prepare('DELETE FROM utilisateurs WHERE user_id = :user_id');
        $req_delete_utilisateur->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $req_delete_utilisateur->execute();

        $mabd->commit();

        session_unset();
        session_destroy();

        header('location: index.php?deleted=1');
        exit();
    }
} catch (PDOException $e) {
    $mabd->rollBack();
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
