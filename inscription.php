<?php
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
      <form action="inscriptionVerif.php" method="POST">
        <label for="prenom">Prénom*</label>
        <input class="input" type="text" id="prenom" name="prenom" required><br><br>

        <label for="nom">Nom*</label>
        <input class="input" type="text" id="nom" name="nom" required><br><br>

        <label for="genre">Pronoms*</label>
        <select class="input" name="genre" id="genre" required>
            <option value="il">Il</option>
            <option value="elle">Elle</option>
            <option value="iel">Iel</option>
        </select><br><br>

        <label for="email">Email*</label>
        <input class="input" type="email" id="email" name="email" required><br><br>

        <label for="mdp">Mot de passe*</label>
        <input class="input" type="password" id="mdp" name="mdp" required><br><br>

          <label for="voiture">Avez-vous une voiture ?*</label><br>
          <div id="radio_voiture">
          <div id="oui">
            <input class="input" type="radio" name="voiture" value="oui" onclick="showTextField()">
            <label for="voiture">Oui</label>
          </div>
          <div id="non">
            <input class="input" type="radio" name="voiture" value="non" onclick="hideTextField()"><br>
            <label for="voiture">Non</label>
          </div>
        </div>


        <div id="detailsVoiture" style="display: none;">
          <label for="detailsVoiture">Précisez la marque, la couleur et le modèle de votre voiture :*</label><br>
          <input class="input" type="text" name="detailsVoiture" placeholder="Marque, couleur, modèle" required><br><br>
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

<?php 
require 'footer.php';
?>
