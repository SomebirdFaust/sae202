<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Profil</title>
</head>
<body>
<div id="img_modif_profil">
    <img src="img/avatar.png" alt="avatar">
</div>

<?php
$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    echo '<div id="modif_profil">';
        echo '<form action="validModifProfil.php" method="post">';
            echo '<label for="prenom">Prénom</label> <br />'; 
            echo '<input class="input" type="text" name="prenom" value="' . ucfirst($user['user_prenom']) . '"><br />';
            echo '<label for="nom">Nom</label> <br />';
            echo '<input class="input" type="text" name="nom" value="' . ucfirst($user['user_nom']) . '"><br />';
            echo '<label for="genre">Pronoms</label> <br />';
            echo '<select class="input" name="genre">';
            echo '<option value="il" ' . ($user['user_genre'] === 'il' ? 'selected' : '') . '>Il</option>';
            echo '<option value="elle" ' . ($user['user_genre'] === 'elle' ? 'selected' : '') . '>Elle</option>';
            echo '<option value="iel" ' . ($user['user_genre'] === 'iel' ? 'selected' : '') . '>Iel</option>';
            echo '</select><br />';            
            echo '<label for="email">Email</label> <br />';
            echo '<input class="input" type="text" name="email" value="' . $user['user_mail'] . '"><br />';
            echo '<label for="voiture">Véhicule</label> <br />';
            echo '<input class="input" type="text" name="voiture" value="' . ucfirst($user['user_car']) . '"><br />';

            echo '<label for="bio">Biographie (300 caractères max)</label> <br />';
            echo '<textarea class="input" name="bio" oninput="countCharacters(this)">' . ucfirst($user['user_bio']) . '</textarea>';
            echo '<div id="characterCount">300</div><br />';            

            echo '<div id="modif_profil_enregistrer">';
                echo '<input type="submit" value="Enregistrer">';
            echo '</div>';
            echo '<div id="modif_profil_supprimer">';
                echo '<a href="supprProfil.php">Supprimer le compte.</a>';
            echo '</div>';

            echo '</form>';
            echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
    echo '</div>';
}
?>
<script>
    function countCharacters(textarea) {
        var maxLength = 300;
        var currentLength = textarea.value.length;
        var remainingLength = maxLength - currentLength;

        var counter = document.getElementById("characterCount");
        counter.textContent = remainingLength;

        if (currentLength > maxLength) {
            textarea.value = textarea.value.substring(0, maxLength); // Limite la saisie à 300 caractères
        }
    }
</script>

<?php
require 'footer.php';
?>
</body>
</html>

