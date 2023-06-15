<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

            $car = !empty($voiture) ? $voiture : null;

            $req = $mabd->prepare('INSERT INTO utilisateurs (user_nom, user_prenom, user_mail, user_mdp, user_genre, user_car) VALUES (:nom, :prenom, :email, :mdp, :genre, :car)');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp_hash, ':genre' => $genre, ':car' => $car));

            session_start();
            $_SESSION['email'] = $email;

            header('Location: index.php?succes=1');
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    deconnexionBD($mabd);
}

require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>

    <div id="inscription">
        <h1>Inscription</h1>
        <img src="img/avatar.png" alt="avatar">
        <form action="" method="post">
            <!-- Reste du formulaire -->
        </form>
        <p>Vous avez déjà un compte?</p>
        <a href="connexion.php"><p>Connectez-vous!</p></a>
    </div>

    <script>
        // Fonctions JavaScript pour afficher/masquer le champ de détails de la voiture
        function showTextField() {
            document.getElementById('detailsVoiture').style.display = 'block';
        }

        function hideTextField() {
            document.getElementById('detailsVoiture').style.display = 'none';
        }
    </script>

    <?php 
    if (isset($_GET['erreur']) && $_GET['erreur'] == 1) {
        echo "Cet email est déjà utilisé, veuillez vous connecter !";
    } elseif (isset($_GET['succes']) && $_GET['succes'] == 1) {
        echo "Inscription réussie !";
    }
    ?>

</body>
</html>

<?php 
require 'footer.php';
?>