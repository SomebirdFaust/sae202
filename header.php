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

      </head>
    <body>
        

<nav>
    <a href="index.php"><img id="logo" src="img/logo.png" alt="logo"></a>
    <div id="mySidenav" class="sidenav">
  <a id="closeBtn" href="#" class="close">×</a>
  <ul>
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
function checkPublicationLink()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        return 'connexion.php'; // Rediriger vers la page de connexion
    }

    // Vérifier si l'utilisateur a une voiture
    $mabd = connexionBD();
    $user = grab_user($mabd);
    if (empty($user['user_car'])) {
        return 'profil.php'; // Rediriger vers la page de profil
    }

    return 'publierTrajet.php'; // Lien valide pour publier un trajet
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
</header>





