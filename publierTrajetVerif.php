<?php
require 'admin/lib.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$depart = $_POST['depart'];
$destination = ucfirst($_POST['dest']);
$date = $_POST['date'];
$heure = $_POST['heure'];
$places = $_POST['places'];

// Vous devez récupérer l'ID de l'utilisateur connecté à partir de votre système d'authentification
$user_id = $_SESSION['user_id'];

try {
    $mabd = connexionBD();

    // Récupérer le park_id correspondant au départ dans la table parkings
    $requete = $mabd->prepare("SELECT park_id FROM parkings WHERE park_nom = :depart");
    $requete->bindValue(':depart', $depart);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    $park_id = $resultat['park_id'];

    // Insérer une nouvelle entrée dans la table trajets avec l'ID de l'utilisateur
    $req = $mabd->prepare('INSERT INTO trajets (_park_id, _user_id, traj_arrivee, traj_date, traj_heure_depart, traj_places) VALUES (:park_id, :user_id, :destination, :date, :heure, :places)');
    $req->bindValue(':park_id', $park_id, PDO::PARAM_INT);
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $req->bindValue(':destination', $destination);
    $req->bindValue(':date', $date);
    $req->bindValue(':heure', $heure);
    $req->bindValue(':places', $places, PDO::PARAM_INT);
    $req->execute();

    header('Location: succesCreaTrajet.php');
    exit();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
