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

    // Récupérer l'utilisateur avant la mise à jour
    $req = $mabd->prepare('SELECT * FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Mettre à jour les informations de l'utilisateur
        if (!empty($mdp)) {
            $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);
            $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_mdp = :mdp, user_bio = :bio, user_car = :car, user_mail = :nouveau_email WHERE user_mail = :email');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':mdp' => $mdp_hash, ':bio' => $bio, ':car' => $voiture, ':nouveau_email' => $email, ':email' => $user['user_mail']));
        } else {
            $req = $mabd->prepare('UPDATE utilisateurs SET user_nom = :nom, user_prenom = :prenom, user_bio = :bio, user_car = :car, user_mail = :nouveau_email WHERE user_mail = :email');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':bio' => $bio, ':car' => $voiture, ':nouveau_email' => $email, ':email' => $user['user_mail']));
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
