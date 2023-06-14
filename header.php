<?php 
require 'admin/lib.inc.php';
?> 

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.typekit.net/nbt8kxx.css">
        <link rel="stylesheet" href="https://use.typekit.net/nbt8kxx.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      </head>
    <body>
        

<nav>
    <a href="index.php"><img id="logo" src="img/logo.png" alt="logo"></a>
    <div id="mySidenav" class="sidenav">
  <a id="closeBtn" href="#" class="close">×</a>
  <ul id="nav">
    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<li><a href="profil.php">Mon profil</a></li>';
    } else {
        echo '<li style="display: none;"><a href="profil.php">Mon profil</a></li>';
    }
    ?>
    <li><a href="parkings.php">Les parkings</a></li>
    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<li style="display: none;"><a href="connexion.php">Connexion</a></li>';
        echo '<li style="display: none;"><a href="inscription.php">Inscription</a></li>';
    } else {
        echo '<li><a href="connexion.php">Connexion</a></li>';
        echo '<li><a href="inscription.php">Inscription</a></li>';
    }
    ?>
<?php
if (isset($_SESSION['user_id'])) {
    // Vérifier si l'utilisateur a ajouté une voiture
    if (!empty($utilisateurs['user_car'])) {
        echo '<li><a href="publierTrajet.php">Publier un trajet</a></li>';
    }
}
?>

  </ul>
</div>


    <a href="#" id="openBtn">
      <span class="burger-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </a>

    </nav>

    </div>
    <script>
$(document).ready(function() {
    // Vérifier si l'utilisateur est connecté
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    
    // Vérifier si l'utilisateur a une voiture
    var hasCar = <?php echo !empty($user['user_car']) ? 'true' : 'false'; ?>;
    
    // Cacher le lien "Publier un trajet" si l'utilisateur n'est pas connecté ou n'a pas de voiture
    if (!isLoggedIn || !hasCar) {
        $('#navigation li:nth-child(5)').hide(); // Cacher le 5ème élément de la liste (index basé sur 1)
    }
});
</script>

</body>
</header>





