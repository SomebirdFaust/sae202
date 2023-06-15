<?php
    require 'header.php';
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
<form action="publierTrajetVerif.php" method="POST">
    <label for="depart">Départ</label>
    <select class="input" name="depart" id="depart" required>
        <?php
        $mabd = connexionBD();
        $requete = $mabd->query("SELECT park_nom FROM parkings");
        while ($park = $requete->fetch()) {
            $parkingNom = $park['park_nom'];
            echo "<option value='$parkingNom'>$parkingNom</option>";
        }
        ?>
    </select>

    <label for="nom">Destination</label>
    <input class="input" type="text" id="dest" name="dest" required placeholder="Ville"><br><br>

    <label for="date">Date</label>
    <input class="input" type="date" id="date" name="date" required><br><br>

    <label for="heure">Heure de départ</label>
    <input class="input" type="time" id="heure" name="heure" required><br><br>

    <label for="places">Nombre de places</label>
    <select class="input" name="places" id="places" required>
        <?php
        for ($i = 1; $i <= 9; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select><br><br>

    <div id="trajet_submit">
        <input type="submit" value="En route!">
    </div>
</form>

<?php
    require 'footer.php';
?>
</body>
</html>
