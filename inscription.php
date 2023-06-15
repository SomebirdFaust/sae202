<?php
require 'admin/lib.inc.php';
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

            if (empty($voiture)) {
                // Si aucun modèle de voiture n'est sélectionné, définir la valeur à NULL
                $car = null;
            } else {
                $car = $detailsVoiture;
            }

            $req = $mabd->prepare('INSERT INTO utilisateurs (user_nom, user_prenom, user_mail, user_mdp, user_genre, user_car) VALUES (:nom, :prenom, :email, :mdp, :genre, :car)');
            $req->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp_hash, ':genre' => $genre, ':car' => $car));

            header('Location: index.php?succes=1');
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    deconnexionBD($mabd);
}
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
        <label for="prenom">Prénom*</label><br>
        <input class="input input_pc" type="text" id="prenom" name="prenom" required><br><br>

        <label for="nom">Nom*</label><br>
        <input class="input input_pc" type="text" id="nom" name="nom" required><br><br>

        <label for="genre">Pronoms*</label><br>
        <select class="input input_pc" name="genre" id="genre" required>
            <option value="il">Il</option>
            <option value="elle">Elle</option>
            <option value="iel">Iel</option>
        </select><br><br>

        <label for="email">Email*</label><br>
        <input class="input input_pc" type="email" id="email" name="email" required><br><br>

        <label for="mdp">Mot de passe*</label><br>
        <input class="input input_pc" type="password" id="mdp" name="mdp" required><br><br>

        <label for="voiture">Avez-vous une voiture ?*</label><br>
        <div id="radio_voiture">
            <div id="oui">
                <input class="input input_pc" type="radio" name="voiture" value="oui" onclick="showTextField()">
                <label for="voiture">Oui</label>
            </div>
            <div id="non">
                <input class="input input_pc" type="radio" name="voiture" value="non" onclick="hideTextField()" checked><br>
                <label for="voiture">Non</label>
            </div>
        </div>


        <div id="detailsVoiture" style="display: none;">
          <label for="detailsVoiture">Précisez la marque, la couleur et le modèle de votre voiture :*</label><br>
          <input class="input input_pc" type="text" name="detailsVoiture" placeholder="Marque, couleur, modèle"><br><br>
        </div>

        <div id="inscription_submit">
          <input type="submit" value="En route!">
        </div>

      </form>
      <p>Vous avez déjà un compte?</p>
      <a href="connexion.php"><p>Connectez-vous!</p></a>
    </div>

<script>
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

<?php require 'footer.php'; ?>