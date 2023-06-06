<?php 
require 'admin/lib.inc.php';
require 'header.php';
?> 

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
    </head>
    <body>
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>

<<<<<<< HEAD
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required><br><br>
=======
        <label for="genre">Genre :</label>
  <select name="genre" id="genre" required>
    <option value="homme">Homme</option>
    <option value="femme">Femme</option>
    <option value="autre">Autre</option>
  </select>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
>>>>>>> da899773ff030dc72b04a5f5103922e1a559d366

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required><br><br>

            <input type="submit" value="S'inscrire">
        </form>

    </body>
    </html>

    
