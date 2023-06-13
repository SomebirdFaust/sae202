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
    <title>Contactez-nous !</title>
</head>
<body>

<div class="corps">
    <main>

<h1 class="h1">CONTACT</h1>

<?php

if (isset($_SESSION['success_message'])) {
    echo '<h3>' . $_SESSION['success_message'] . '</h3>';
    unset($_SESSION['success_message']);
} elseif (isset($_SESSION['error_message'])) {
    echo '<h3>' . $_SESSION['error_message'] . '</h3>';
    unset($_SESSION['error_message']);
}
?>

<form action="verifContact.php" method="POST">
    <div id="en-tete">
        <div id="div_prenom">
            <label for="prenom">Prénom *</label><br>
            <input type="text" id="prenom" name="prenom" required><br><br>
        </div>

        <div id="div_nom">
            <label for="nom">Nom *</label><br>
            <input type="text" id="nom" name="nom" required><br><br>
        </div>
    </div>

    <label for="email">Email *</label><br>
    <input type="email" id="email" name="email" placeholder="nom@domaine.fr/com" required><br><br>

    <label for="message">Message *</label><br>
    <textarea name="message" id="message" placeholder="Votre message" cols="30" rows="10" required></textarea><br><br>

    <input type="submit" value="Soumettre">
</form>

</main>
</div>

<?php
require 'footer.php';
?>
</body>
</html>
