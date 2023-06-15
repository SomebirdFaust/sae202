<?php
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

<div id="contact_header">
    <h1 class="h1">Car&Cie</h1>

    <p>Découvrez Car&Cie, le site de covoiturage en ligne qui vous permet de partager
        vos trajets en toute simplicité. Que vous cherchiez à économiser de l’argent,
        à réduire votre empreinte carbone ou à rencontrer de nouvelles personnes,
        notre plateforme est là pour vous aider.</p>

    <h1>CONTACTEZ-NOUS!</h1>
</div>

<?php

if (isset($_SESSION['success_message'])) {
    echo '<h3>' . htmlspecialchars($_SESSION['success_message'], ENT_QUOTES, 'UTF-8') . '</h3>';
    unset($_SESSION['success_message']);
} elseif (isset($_SESSION['error_message'])) {
    echo '<h3>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</h3>';
    unset($_SESSION['error_message']);
}
?>

<div id="contact">
    <form action="contactVerif.php" method="POST">
        <label for="prenom">Votre prénom*</label><br>
        <input class="input input_pc" type="text" id="prenom" name="prenom" placeholder="Prénom" required><br><br>

        <label for="nom">Votre nom*</label><br>
        <input class="input input_pc" type="text" id="nom" name="nom" placeholder="Nom" required><br><br>

        <label for="email">Votre adresse email*</label><br>
        <input class="input input_pc" type="email" id="email" name="email" placeholder="prenom.nom@domaine.fr/com" required><br><br>

        <label for="message">Votre message*</label><br>
        <textarea class="input input_pc" name="message" id="message" placeholder="Message" cols="30" rows="10" required></textarea><br><br>

        <div id="submit_contact">
            <input type="submit" value="Envoyer">
        </div>
    </form>
    <img src="img/contact.png" alt="illustration poussin avec un téléphone dans la main">
</div>


</div>

<?php
require 'footer.php';
?>
</body>
</html>
