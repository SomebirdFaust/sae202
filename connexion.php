<?php 
require 'admin/lib.inc.php';
require 'header.php';
?> 

 <div id="contenu"> 
 <h1>Connexion</h1> 
 <form action="admin/connexionVerif.php" method="post"> 
 Adresse e-mail : <input type="text" name="email" /><br />  
 Mot de passe : <input type="password" name="mdp" /><br />  
 <input type="submit" value="Envoyer"> 
 </form> 

    <?php
            if (!empty($_SESSION['erreur'])) {
            echo $_SESSION['erreur'];
            unset ($_SESSION['erreur']);
            }
            //var_dump($_SESSION);
    ?>

 </div> 

<?php 
require 'footer.php';
?> 