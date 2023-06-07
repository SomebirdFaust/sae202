<?php
require 'lib.inc.php';

$nom = ucfirst($_POST['nom']);
$prenom = ucfirst($_POST['prenom']);
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$genre = $_POST['genre'];
$bio = ucfirst($_POST['bio']);
$voiture = $_POST['voiture'];
$detailsVoiture = $_POST['detailsVoiture'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Utilisateur déjà existant, afficher un message d'erreur ou rediriger vers une autre page
        echo "Cet email est déjà utilisé, veuillez vous connecter !";
        header('location: ../inscription.php?erreur=1');
        exit();
    } else {
        $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);
        $req = $mabd->prepare('INSERT INTO utilisateurs (user_nom, user_prenom, user_mail, user_mdp, user_genre, user_bio, user_car) VALUES (:nom, :prenom, :email, :mdp, :genre, :bio, :voiture)');
        $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp_hash, ':genre' => $genre, ':bio' => $bio, ':voiture' => $voiture));

        // Si la voiture est spécifiée, enregistrer les détails de la voiture
        if ($voiture === 'oui' && !empty($detailsVoiture)) {
            $id_utilisateur = $mabd->lastInsertId(); // Récupérer l'ID de l'utilisateur nouvellement inséré
            $req = $mabd->prepare('UPDATE utilisateurs SET user_car_details = :details WHERE id_utilisateur = :id');
            $req->execute(array(':details' => $detailsVoiture, ':id' => $id_utilisateur));
        }

        // Afficher un message de succès ou rediriger vers une autre page
        echo "Inscription réussie !";
        header('location: ../index.php?succes=1');
        exit();
    }
} catch (PDOException $e) {
    // Gérer les erreurs de connexion à la base de données
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
