<?php 
require 'admin/lib.inc.php';
require 'header.php';
?> 
<!DOCTYPE html> 
<html lang="fr"> 

 <body> 
 <div id="contenu"> 
 <h1>Connexion</h1> 
 <form action="admin/connexionVerif.php" method="post"> 
 Nom : <input type="text" name="nom" /><br />
 Prénom : <input type="text" name="prenom" /><br />
 Adresse e-mail : <input type="text" name="email" /><br />  
 Mot de passe : <input type="password" name="mdp" /><br />  <input type="submit" value="Envoyer"> 
 </form> 
 </div> 
 </body> 
</html>