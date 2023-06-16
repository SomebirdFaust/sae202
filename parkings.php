<?php
require 'header.php';
?>

    <title>Parkings</title>
</head>

<body>
    <h3 class="parking">Les parkings :</h3>
    <div id="parking">
        <?php
        $mabd = connexionBD();
        $requete = $mabd->query("SELECT park_nom, park_loc, park_img FROM parkings");

        while ($park = $requete->fetch()) {
            $parkingNom = htmlspecialchars($park['park_nom'], ENT_QUOTES, 'UTF-8');
            $parkingImage = htmlspecialchars($park['park_img'], ENT_QUOTES, 'UTF-8');
            $parkingAdresse = htmlspecialchars($park['park_loc'], ENT_QUOTES, 'UTF-8');
            echo '<div id="park">';
            echo "<p value='$parkingNom'>$parkingNom</p>";

            if (!empty($parkingImage)) {
                echo "<img src='img/$parkingImage' alt='Image du parking'>";
            }

            echo "<p value='$parkingAdresse'>$parkingAdresse</p>";
            echo "<br><br>";
            echo '</div>';
        }

        deconnexionBD($mabd);
        ?>
    </div>
</body>

</html>

<?php
require 'footer.php';
?>