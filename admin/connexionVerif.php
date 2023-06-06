<?php
require 'lib.inc.php';
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mabd = connexionBD();
$req = 'SELECT * FROM utilisateurs WHERE user_mail LIKE :email';
$resultat = $mabd->prepare($req);
$resultat->execute(array(':email' => $email));
$lignes_resultat = $resultat->rowCount();

if ($lignes_resultat > 0) {
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    if (password_verify($mdp, $ligne['client_mdp'])) {
        $_SESSION['prenom_client'] = $ligne['client_prenom'];
        $_SESSION['numero_client'] = $ligne['client_code'];
        header('location:../index.php');
    } else {
        $_SESSION['erreur'] = '<h1 class="erreur">Le mot de passe saisi est incorrect.</h1>';
        header('location:../connexion.php');
    }
} else {
    $_SESSION['erreur'] = '<h1 class="erreur">Désolé, le login saisi n\'existe pas !</h1>';
    header('location:../connexion.php');
}

deconnexionBD($mabd);
?>
