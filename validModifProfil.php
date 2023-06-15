<?php
require 'admin/lib.inc.php';

$nom = ucfirst($_POST['nom']);
$prenom = ucfirst($_POST['prenom']);
$genre = $_POST['genre'];
$email = $_POST['email'];
$bio = $_POST['bio'];
$voiture = $_POST['voiture'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT user_bio FROM utilisateurs WHERE user_mail = :email');
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();

    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $bioExistante = $result['user_bio'];
        if (!empty($bio)) {
            $req = $mabd->prepare('UPDATE utilisateurs SET user_bio = :bio WHERE user_mail = :email');
            $req->bindValue(':bio', $bio, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->execute();
        }
    } else {
        $req = $mabd->prepare('INSERT INTO utilisateurs (user_nom, user_prenom, user_genre, user_mail, user_bio, user_car) VALUES (:nom, :prenom, :genre, :email, :bio, :car)');
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindValue(':genre', $genre, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':bio', $bio, PDO::PARAM_STR);
        $req->bindValue(':car', $voiture, PDO::PARAM_STR);
        $req->execute();
    }

    // Mise à jour du nom, prénom et genre de l'utilisateur
    $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_genre = :genre WHERE user_mail = :email');
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':genre', $genre, PDO::PARAM_STR);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();

    header('location: profil.php?succes=1');
    exit();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
