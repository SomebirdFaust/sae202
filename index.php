<?php require 'header.php';?>

    <title>Accueil</title>
</head>
<body>

<h1 id="accueil_logo">Car &amp; Cie</h1>

<div id="recherche_trajet">
    <?php 
    if (isset($_SESSION['user_id'])) {
        echo '<h1>Où allez-vous?</h1>';
        echo '<form action="resultTrajet.php" method="POST">';
            echo '<div id="depart">';
                echo '<label for="depart">Départ</label><br>';
                echo '<select class="input input_pc" name="depart" id="depart" required>';
                $mabd = connexionBD();
                $requete = $mabd->query("SELECT park_nom FROM parkings");
                while ($park = $requete->fetch()) {
                    $parkingNom = htmlspecialchars($park['park_nom'], ENT_QUOTES, 'UTF-8');
                    echo "<option value='$parkingNom'>$parkingNom</option>";
                }
                echo '</select>';
            echo '</div>';
            echo '<div id="destination">';
                echo '<label for="nom">Destination</label><br>';
                echo '<input class="input input_pc" type="text" id="dest" name="dest" required placeholder="Ville">';
            echo '</div>';
            echo '<div id="date">';
                echo '<label for="date">Date</label><br>';
                echo '<input class="input input_pc" type="date" id="date" name="date" required>';
            echo '</div>';
            echo '<div id="trajet_submit">';
                echo '<input type="submit" value="Rechercher">';
            echo '</div>';
        echo '</form>';
    } else {
        echo '<p>Pour effectuer une recherche, veuillez vous authentifier.</p>';
        echo '<div id="boutons_index">';
        echo '<a id="index_connexion" href="connexion.php"><button>Connexion</button></a>';
        echo '<a id="index_inscription" href="inscription.php"><button>Inscription</button></a>';
        echo '</div>';
    }
    ?>
</div>

<div id="div_animation">
    <img id="animation" src="video/animation.gif" alt="Animation voiture qui roule" style="background-color: transparent;"> 
    <script>
        $(document).ready(function() {
          var gif = $('#animation');
          setTimeout(function() {
            gif.attr('src', 'img/animation.png');
          }, 3900);
        });
      </script>
</div>

<div id="video">
    <iframe src="https://www.youtube.com/embed/g0smUYGoD88" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
<div id="questions">
    <h1>FAQ</h1>
        <div class="question">
            <h3>Car &amp; Cie, c’est quoi ?</h3><br>
            <p>Car &amp; Cie est une plateforme de covoiturage en ligne spécialement 
                conçue pour les étudiants en MMI. Gratuit, pratique et accessible, 
                le site a été conçu pour faciliter votre quotidien.</p>
        </div>
        <div class="question">
            <h3>Pourquoi faire du covoiturage?</h3><br>
            <p>En tant qu’étudiant, on est souvent confronté à des contraintes 
            budgétaires, le covoiturage nous permet donc de faire des économies 
            tout en réduisant notre empreinte carbone et en rencontrant de 
            nouvelles personnes.</p>
        </div>
        <div class="question">
            <h3>Combien coûte un trajet en covoiturage ?</h3><br>
            <p>Notre site est entièrement gratuit! Les conducteurs sont gratifiés 
            par votre bonne humeur et le sentiment d'être utile, 
            tout en préservant l'environnement!</p>
        </div>
        <div class="question">
            <h3>Comment proposer un trajet de covoiturage ?</h3><br>
            <p>Pour proposer un trajet, vous devez disposer d'un compte utilisateur 
            et être connecté. Si vous n'en avez pas encore, il vous suffit d'en 
            créer un en vous rendant sur la page "inscription" dans le menu. 
            Ensuite, vous n'aurez qu'à vous rendre sur la page "publier un trajet" 
            également situé dans le menu, et de remplir les informations requises.
            Rien de plus simple!</p>
        </div>
</div>

<?php require 'footer.php'; ?>
</body>
</html>