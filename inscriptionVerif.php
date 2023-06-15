<?php
require 'admin/lib.inc.php';

$nom = ucfirst($_POST['nom']);
$prenom = ucfirst($_POST['prenom']);
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$genre = $_POST['genre'];
$voiture = $_POST['voiture'];
$detailsVoiture = $_POST['detailsVoiture'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = :email');
    $req->execute(array(':email' => $email));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "Cet email est déjà utilisé, veuillez vous connecter !";
        header('Location: inscription.php?erreur=1');        
        exit();
    } else {
        $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 12]);
        $req = $mabd->prepare('INSERT INTO utilisateurs (user_nom, user_prenom, user_mail, user_mdp, user_genre, user_car) VALUES (:nom, :prenom, :email, :mdp, :genre, :car)');
        $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp_hash, ':genre' => $genre, ':car' => $detailsVoiture));

        $user = grab_user($mabd, $email);
        if ($user) {
            session_start();
            $_SESSION['email'] = $user['user_mail'];
        }

        header('Location: index.php?succes=1');
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>

