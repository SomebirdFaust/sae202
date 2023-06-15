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
    <style>
        .password-toggle {
            position: relative;
            display: inline-block;
        }

        .password-toggle input[type="password"] {
            padding-right: 30px;
        }

        .password-toggle .toggle-password {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="connexion"> 
        <h1>Connexion</h1> 
        <img src="img/avatar.png" alt="avatar">
        <form action="connexionVerif.php" method="post"> 
            <label for="email">E-mail* : </label><br>
            <input class="input" type="email" name="email" /><br> 
            <label for="mdp">Mot de passe* : </label><br>
            <div class="password-toggle">
                <input class="input" type="password" name="mdp" id="passwordInput" />
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <img src="eye.png" alt="Toggle password visibility">
                </span>
            </div><br>  
            <div id="div_submit_connexion">
                <input id="submit_connexion" type="submit" value="Connexion"> 
            </div>
        </form> <br>
        <p>Vous n'avez pas de compte?</p>
        <a href="inscription.php"><p>Inscrivez-vous!</p></a>

        <?php
            if (!empty($_SESSION['erreur'])) {
                echo $_SESSION['erreur'];
                unset($_SESSION['erreur']);
            }
        ?>
    </div> 

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var togglePassword = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.innerHTML = '<img src="eye-off.png" alt="Toggle password visibility">';
            } else {
                passwordInput.type = "password";
                togglePassword.innerHTML = '<img src="eye.png" alt="Toggle password visibility">';
            }
        }
    </script>
</body>
</html>

<?php 
require 'footer.php';
?>
