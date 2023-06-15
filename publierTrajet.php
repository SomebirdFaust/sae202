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
            </select><br><br>

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

            <div id="publier_trajet_submit">
            <div id="publier_trajet_submit">
    <?php
    // Vérifier si l'utilisateur a une voiture
    try {
        $mabd = connexionBD();

        // Supposons que vous ayez une table "utilisateurs" avec une colonne "user_car" pour stocker les informations de la voiture
        $req = $mabd->prepare('SELECT user_car FROM utilisateurs WHERE user_id = :id');
        $req->execute(array(':id' => $user['user_id']));
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if (!empty($result['user_car'])) {
            echo "<input type='submit' value='Publier le trajet'>";
        } else {
            echo "<p>Vous n'avez pas de voiture. Vous ne pouvez pas publier de trajet.</p>";
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    deconnexionBD($mabd);
    ?>
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
