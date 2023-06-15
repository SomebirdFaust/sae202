<?php
require 'admin/lib.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $depart = $_POST['depart'];
    $destination = ucfirst($_POST['dest']);
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $places = $_POST['places'];

    $user_id = $_SESSION['user_id'];

    try {
        $mabd = connexionBD();

        $req = $mabd->prepare('SELECT user_car FROM utilisateurs WHERE user_id = :user_id');
        $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if (empty($user['user_car'])) {
            $messageErreur = "Vous n'avez pas de voiture.";
        } else {
            $requete = $mabd->prepare("SELECT park_id FROM parkings WHERE park_nom = :depart");
            $requete->bindValue(':depart', $depart);
            $requete->execute();
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);
            $park_id = $resultat['park_id'];

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
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    deconnexionBD($mabd);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un trajet</title>

</head>
<body>
    <div id="publier_trajet">
        <form action="publierTrajet.php" method="POST">
            <!-- Vos champs de formulaire ici -->

            <div id="publier_trajet_submit">
                <?php
                if (isset($messageErreur)) {
                    echo "<p>$messageErreur</p>";
                } else {
                    echo "<input type='submit' value='Publier le trajet'>";
                }
                ?>
            </div>
        </form>
    </div>

</body>
</html>
