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
        

  <nav id="nav_tel">
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
        echo '<li><a href="publierTrajet.php">Publier un trajet</a></li>';

        echo '<div id="bouton_deconnexion_header">';
        echo '<form action="deconnexion.php" method="post">';
        echo '<button type="submit">Se déconnecter</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<li><a href="connexion.php">Connexion</a></li>';
        echo '<li><a href="inscription.php">Inscription</a></li>';
        echo '<li style="display: none;"><a href="inscription.php">Inscription</a></li>';  
        
        echo '<div style="display: none; id="bouton_deconnexion_header">';
        echo '<form action="deconnexion.php" method="post">';
        echo '<button type="submit">Se déconnecter</button>';
        echo '</form>';
        echo '</div>';
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


  <nav id="nav_pc">
    <a href="index.php"><img id="logo_header_pc" src="img/logo.png" alt="logo"></a>
    <ul>
      <li><a href="publierTrajet.php">Publier un trajet</a></li>
      <li id="park_header"><a href="parkings.php">Les parkings</a></li>
      <li></li><li></li><li></li><li></li><li></li><li></li>
      <li id="conn_inscr_header"><a href="connexion.php">Connexion/</a><a href="inscription.php">Inscription</a></li>
      <li><a href="profil.php"><img id="avatar_header_pc" src="img/avatar_blanc.png" alt="avatar"></a></li>
    </ul>
  </nav>

    </div>
</header>





