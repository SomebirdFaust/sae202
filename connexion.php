<?php 
require 'admin/lib.inc.php';
require 'header.php';
?> 

<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
        <div id="contenu"> 
                <h1>Connexion</h1> 
                <form action="admin/connexionVerif.php" method="post"> 
                Adresse e-mail : <input type="text" name="email" /><br />  
                Mot de passe : <input type="password" name="mdp" /><br />  <input type="submit" value="Envoyer"> 
                </form> 
=======
 <div id="contenu"> 
 <h1>Connexion</h1> 
 <form action="admin/connexionVerif.php" method="post"> 
 Adresse e-mail : <input type="text" name="email" /><br />  
 Mot de passe : <input type="password" name="mdp" /><br />  
 <input type="submit" value="Envoyer"> 
 </form> 
>>>>>>> da899773ff030dc72b04a5f5103922e1a559d366

                <?php
                        if (!empty($_SESSION['erreur'])) {
                        echo $_SESSION['erreur'];
                        unset ($_SESSION['erreur']);
                        }
                        //var_dump($_SESSION);
                ?>

         </div> 
</body>
</html>


<?php 
require 'footer.php';
?> 