<?php
require 'lib.inc.php';

$email = $_POST['email'];

try {
    $mabd = connexionBD();
    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        //suppr l'utilisateur et ses données
        $req = $mabd->prepare('DELETE FROM utilisateurs WHERE user_mail = :email');
        $req->execute(array(':email' => $email));

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
?>
