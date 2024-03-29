<?php
require 'header.php';
?>

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
        echo '<input class="input input_pc" type="text" name="prenom" value="' . htmlspecialchars(ucfirst($user['user_prenom']), ENT_QUOTES, 'UTF-8') . '"><br />';
        echo '<label for="nom">Nom</label> <br />';
        echo '<input class="input input_pc" type="text" name="nom" value="' . htmlspecialchars(ucfirst($user['user_nom']), ENT_QUOTES, 'UTF-8') . '"><br />';
        echo '<label for="genre">Pronoms</label> <br />';
        echo '<select class="input input_pc" name="genre">';
        echo '<option value="il" ' . ($user['user_genre'] === 'il' ? 'selected' : '') . '>Il</option>';
        echo '<option value="elle" ' . ($user['user_genre'] === 'elle' ? 'selected' : '') . '>Elle</option>';
        echo '<option value="iel" ' . ($user['user_genre'] === 'iel' ? 'selected' : '') . '>Iel</option>';
        echo '</select><br />';
        echo '<label for="email">Email</label> <br />';
        echo '<input class="input input_pc" type="email" name="email" value="' . htmlspecialchars($user['user_mail'], ENT_QUOTES, 'UTF-8') . '" readonly><br />';

        echo '<label for="voiture">Véhicule</label> <br />';
        echo '<input class="input input_pc" type="text" name="voiture" value="' . htmlspecialchars(ucfirst($user['user_car']), ENT_QUOTES, 'UTF-8') . '"><br />';
        echo '<label for="bio">Biographie (300 caractères max)</label> <br />';
        echo '<textarea class="input input_pc" name="bio" oninput="countCharacters(this)">' . htmlspecialchars(ucfirst($user['user_bio']), ENT_QUOTES, 'UTF-8') . '</textarea>';
        echo '<div id="characterCount">300</div><br />';

        echo '<div id="modif_profil_enregistrer">';
        echo '<input type="submit" value="Enregistrer">';
        echo '</div>';
        echo '</form>';

        echo '<div id="modif_profil_supprimer">';
        echo '<form action="supprProfil.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="submit" value="Supprimer le compte">';
        echo '</form>';
        echo '</div>';

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
                textarea.value = textarea.value.substring(0, maxLength);
            }
        }
    </script>

    <?php
    require 'footer.php';
    ?>
</body>
</html>