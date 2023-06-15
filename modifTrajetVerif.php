<?php
require 'admin/lib.inc.php';

$trajet_id = $_POST['trajet_id'];

try {
    $mabd = connexionBD();

    $requete = $mabd->prepare("SELECT _user_id FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindValue(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $requete->execute();
    $trajet = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$trajet || $trajet['_user_id'] !== $_SESSION['user_id']) {
        header('Location: profil.php');
        exit();
    }

    $requete = $mabd->prepare("DELETE FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindValue(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $requete->execute();

    header('Location: profil.php?success=1');
    exit();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
