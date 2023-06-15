<?php
    require 'header.php';
?> 
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
    $trajet_id = $_GET['trajet_id']; // Récupère l'ID du trajet à modifier depuis l'URL
    $mabd = connexionBD();
    $requete = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindParam(':trajet_id', $trajet_id);
    $requete->execute();
    $trajet = $requete->fetch();

    if ($trajet) {
        ?>
        <form action="modifierTrajetVerif.php" method="POST">
            <input type="hidden" name="trajet_id" value="<?php echo $trajet_id; ?>">

            <label for="depart">Départ</label>
            <select class="input" name="depart" id="depart" required>
                <?php
                $requeteParkings = $mabd->query("SELECT park_nom FROM parkings");
                while ($park = $requeteParkings->fetch()) {
                    $parkingNom = $park['park_nom'];
                    $selected = ($parkingNom == $trajet['_park_id']) ? 'selected' : '';
                    echo "<option value='$parkingNom' $selected>$parkingNom</option>";
                }
                ?>
            </select>

            <label for="nom">Destination</label>
            <input class="input" type="text" id="dest" name="dest" required placeholder="Ville" value="<?php echo $trajet['traj_arrivee']; ?>"><br><br>

            <label for="date">Date</label>
            <input class="input" type="date" id="date" name="date" required value="<?php echo $trajet['traj_date']; ?>"><br><br>

            <label for="heure">Heure de départ</label>
            <input class="input" type="time" id="heure" name="heure" required value="<?php echo $trajet['traj_heure_depart']; ?>"><br><br>

            <label for="places">Nombre de places</label>
            <select class="input" name="places" id="places" required>
                <?php
                for ($i = 1; $i <= 9; $i++) {
                    $selected = ($i == $trajet['traj_places']) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select><br><br>

            <div id="trajet_submit">
                <input type="submit" value="Enregistrer les modifications">
            </div>
        </form>
        
        <div id="modif_trajet_suppr">
        <form action="supprTrajet.php" method="POST">
            <input type="hidden" name="trajet_id" value="<?php echo $trajet_id; ?>">
            <input type="submit" value="Supprimer le trajet">
        </form>
        </div>

        
        <?php
    }
?>
</div>

<?php
    require 'footer.php';
?>
</body>
</html>
