<?php 
require 'admin/lib.inc.php';
require 'header.php';
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="inscriptionVerif.php" method="POST">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required><br><br>

      <label for="prenom">Prénom :</label>
      <input type="text" id="prenom" name="prenom" required><br><br>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required><br><br>

      <label for="mdp">Mot de passe :</label>
      <input type="password" id="mdp" name="mdp" required><br><br>

      <label for="genre">Genre :</label>
      <select name="genre" id="genre" required>
          <option value="homme">Homme</option>
          <option value="femme">Femme</option>
          <option value="autre">Autre</option>
      </select><br><br>

      <label for="voiture">Avez-vous une voiture ?</label><br>
    <input type="radio" name="voiture" value="oui" onclick="showTextField()"> Oui
    <input type="radio" name="voiture" value="non" onclick="hideTextField()"> Non<br><br>

    <div id="detailsVoiture" style="display: none;">
      <label for="detailsVoiture">Précisez la marque, la couleur et le modèle de votre voiture :</label><br>
      <input type="text" name="detailsVoiture" placeholder="Marque, couleur, modèle"><br><br>
    </div>

    <input type="submit" value="Soumettre">
  </form>

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
