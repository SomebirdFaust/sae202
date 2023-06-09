<?php
require 'lib.inc.php';

session_start();

if (isset($_SESSION['user_mail'])) {
    $email = $_SESSION['user_mail'];

    try {
        $mabd = connexionBD();
        $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
        $req->execute(array(':email' => $email));
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Supprimer l'utilisateur et ses données
            $req = $mabd->prepare('DELETE FROM utilisateurs WHERE user_mail = :email');
            $req->execute(array(':email' => $email));

            session_destroy(); // Détruire la session après la suppression du compte

            header('location: ../index.php?deleted=1');
            exit();
        } else {
            echo "Utilisateur non trouvé !";
            header('location: ../modifProfil.php?erreur=1');
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    deconnexionBD($mabd);
} else {
    header('location: ../index.php');
    exit();
}
?>
