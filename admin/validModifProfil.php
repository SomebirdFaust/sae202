<?php
require 'lib.inc.php';

$nom = ucfirst($_POST['nom']);
$prenom = ucfirst($_POST['prenom']);
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$genre = $_POST['genre'];
$bio = $_POST['bio'];
$voiture = $_POST['voiture'];
$detailsVoiture = $_POST['detailsVoiture'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // utilisateur existant, mettre à jour les informations
        $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_mdp = :mdp, user_genre = :genre, user_bio = :bio, user_car = :car WHERE user_mail = :email');
        $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':mdp' => $mdp, ':genre' => $genre, ':bio' => $bio, ':car' => $detailsVoiture, ':email' => $email));

        header('location: ../profil.php?succes=1');
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

