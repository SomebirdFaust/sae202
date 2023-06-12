<?php
require 'admin/lib.inc.php';

$user_id = $_POST['user_id'];

try {
    $mabd = connexionBD();
    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_id = :user_id');
    $req->execute(array(':user_id' => $user_id));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Suppression de l'utilisateur et de ses données
        $req = $mabd->prepare('DELETE FROM utilisateurs WHERE user_id = :user_id');
        $req->execute(array(':user_id' => $user_id));

        header('location: index.php?deleted=1');
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
