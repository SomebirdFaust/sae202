<?php
require 'header.php';
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div id="connexion"> 
        <h1>Connexion</h1> 
        <img src="img/avatar.png" alt="avatar">
        <form action="connexionVerif.php" method="post"> 
            <label for="email">E-mail* : </label><br>
            <input class="input input_pc" type="email" name="email" required /><br> 
            <label for="mdp">Mot de passe* : </label><br>
            <div>
                <input class="input input_pc" type="password" name="mdp" id="passwordInput" required />
            </div><br>  
            <div id="div_submit_connexion">
                <input id="submit_connexion" type="submit" value="Connexion"> 
            </div>
        </form> <br>
        <p>Vous n'avez pas de compte?</p>
        <a href="inscription.php"><p>Inscrivez-vous!</p></a>

        <?php
            if (!empty($_SESSION['erreur'])) {
                echo htmlspecialchars($_SESSION['erreur'], ENT_QUOTES, 'UTF-8');
                unset($_SESSION['erreur']);
            }
        ?>
    </div> 
</body>
</html>

<?php 
require 'footer.php';
?>
