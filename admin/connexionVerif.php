<?php
require 'lib.inc.php';
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mabd = connexionBD();
$req = 'SELECT * FROM utilisateurs WHERE user_mail = "'.$email.'"';
$resultat = $mabd->query($req);
$lignes_resultat = $resultat->rowCount();

if ($lignes_resultat > 0) {
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    if (password_verify($mdp, $ligne['user_mdp'])) {

        $_SESSION['user_email'] = $ligne['user_mail'];

        header('location:../profil.php');

    } else {

        $_SESSION['erreur'] = '<h1 class="erreur">Le mot de passe saisi est incorrect.</h1>';
        header('location:../connexion.php');
    }
} else {
    $_SESSION['erreur'] = '<h1 class="erreur">Désolé, votre compte n\'existe pas ! Veuillez vous inscrire.</h1>';
    header('location:../connexion.php');
}

deconnexionBD($mabd);
?>
