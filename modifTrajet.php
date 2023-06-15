<?php require 'header.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un trajet</title>
</head>
<body>
    <div id="modif_trajet">
        <?php
        $trajet_id = $_GET['trajet_id'];
        $mabd = connexionBD();
        $requete = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
        $requete->bindParam(':trajet_id', $trajet_id);
        $requete->execute();
        $trajet = $requete->fetch();

        if ($trajet) {
            ?>
            <h2>Informations du trajet :</h2>
            <p><strong>Départ :</strong> <?php echo $trajet['_park_id']; ?></p>
            <p><strong>Destination :</strong> <?php echo $trajet['traj_arrivee']; ?></p>
            <p><strong>Date :</strong> <?php echo $trajet['traj_date']; ?></p>
            <p><strong>Heure de départ :</strong> <?php echo $trajet['traj_heure_depart']; ?></p>
            <p><strong>Nombre de places :</strong> <?php echo $trajet['traj_places']; ?></p>

            <div id="modif_trajet_suppr">
                <h2>Supprimer le trajet :</h2>
                <form action="supprTrajet.php" method="POST">
                    <input type="hidden" name="trajet_id" value="<?php echo $trajet_id; ?>">
                    <input type="submit" value="Supprimer le trajet">
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>