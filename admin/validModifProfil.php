<?php
require 'lib.inc.php';

$nom = ucfirst($_POST['nom']);
$prenom = ucfirst($_POST['prenom']);
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$bio = $_POST['bio'];
$voiture = $_POST['voiture'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Utilisateur existant, mettre à jour les informations
        if (!empty($mdp)) {
            $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);
            $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_mdp = :mdp, user_bio = :bio, user_car = :car WHERE user_mail = :email');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':mdp' => $mdp_hash, ':bio' => $bio, ':car' => $voiture, ':email' => $email));
        } else {
            $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_bio = :bio, user_car = :car WHERE user_mail = :email');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':bio' => $bio, ':car' => $voiture, ':email' => $email));
        }

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
