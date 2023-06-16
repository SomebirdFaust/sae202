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
    <div id="publier_trajet">
        <form action="publierTrajetVerif.php" method="POST">
            <div id="champs">
                <label for="depart">Départ</label><br>
                <select class="input input_pc" name="depart" id="depart" required>
                    <?php
                    $mabd = connexionBD();
                    $requete = $mabd->query("SELECT park_nom FROM parkings");
                    while ($park = $requete->fetch()) {
                        $parkingNom = $park['park_nom'];
                        echo "<option value='$parkingNom'>$parkingNom</option>";
                    }
                    ?>
                </select><br><br>

                <label for="nom">Destination</label><br>
                <input class="input input_pc" type="text" id="dest" name="dest" required placeholder="Ville"><br><br>

                <label for="date">Date</label><br>
                <input class="input input_pc" type="date" id="date" name="date" required><br><br>

                <label for="heure">Heure de départ</label><br>
                <input class="input input_pc" type="time" id="heure" name="heure" required><br><br>

                <label for="places">Nombre de places</label><br>
                <select class="input input_pc" name="places" id="places" required>
                    <?php
                    for ($i = 1; $i <= 9; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select><br><br>

                <?php
                if (isset($_GET['message'])) {
                    urldecode($_GET['message']);
                    echo '<div id="publier_trajet_voiture">';
                    echo "<p>Vous ne pouvez pas proposer de trajets aux autre usagers car vous n'avez pas de voiture.</p>";
                    echo '</div>';
                }
                ?>

                <div id="publier_trajet_submit">
                    <input type='submit' value='Publier le trajet'>
                </div>
            </div>
            
            <div id="publier_trajet_img">
                <img src="img/pub_traj.png" alt="illustration voiture">
            </div>
            
        </form>
    </div>
</body>
</html>

<?php
require 'footer.php';
?>
