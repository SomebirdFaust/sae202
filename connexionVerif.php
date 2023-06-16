<?php
session_start();
require 'admin/lib.inc.php';

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $mabd = connexionBD();
    $req = 'SELECT * FROM utilisateurs WHERE user_mail = :email';

    $stmt = $mabd->prepare($req);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($ligne && password_verify($mdp, $ligne['user_mdp'])) {
        $_SESSION['user_id'] = $ligne['user_id'];
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['erreur'] = 'Le mot de passe saisi est incorrect.';
        header('Location: connexion.php');
        exit();
    }
} else {
    $_SESSION['erreur'] = 'Veuillez fournir une adresse email et un mot de passe.';
    header('Location: connexion.php');
    exit();
}

deconnexionBD($mabd);
?>
