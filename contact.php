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
    <title>Contactez-nous!</title>
</head>
<body>

<div class="corps">
    <main>
        <h1 class="h1">CONTACT</h1>

        <form id="form_contact" action="confirmationMail.php" method="post">
            <div id="en-tete">
                <div id="div_prenom">
                    <label for="prenom">Prénom <span>*</span></label>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom"/>
                    <?php
                    
                    if (isset($_SESSION['prenom'])) {
                    echo '<p>'.$_SESSION['prenom'].'</p>'."\n";
                    
                    }
                    
                
                    ?>
                </div>

                <div id="div_nom">
                    <label for="nom">Nom <span>*</span></label>
                    <input type="text" name="nom" id="nom" placeholder="Nom"/>
                    <?php
                    
                    if (isset($_SESSION['nom'])) {
                        echo '<p>'.$_SESSION['nom'].'</p>'."\n";
                        
                        }

            
                    
                    ?>
                </div>
            </div>
 
                <label for="email">E-mail <span>*</span></label>
                <input type="email" name="email" id="email" placeholder="nom@domaine.fr"/>
                <?php
                
                if (isset($_SESSION['email'])) {
                    echo '<p>'.$_SESSION['email'].'</p>'."\n";
                    
                    }

                ?>
                <label for="message">Message <span>*</span></label>
                <textarea name="message" id="message" placeholder="Votre message" cols="30" rows="10"></textarea>
                <?php

                $erreurs=0;

                if (isset($_SESSION['message'])) {
                    echo '<p>'.$_SESSION['message'].'</p>'."\n";
                        
                    }
                
                if (isset($_SESSION['information'])) {
                   echo '<p>'.$_SESSION['information'].'</p>'."\n";}
               
                ?>

                <input id="submit" type="submit" value="Envoyer"/>
        </form>
    </main>
</div>



<?php
require 'footer.php';
?>
</body>
</html>
