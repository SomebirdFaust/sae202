<?php require 'header.php';?>

<h1 id="accueil_logo">Car & Cie</h1>

<div id="recherche_trajet">
    <?php
    if (isset($_SESSION['user_id'])) {
        // Utilisateur connecté
        echo '<h1>Où allez-vous?</h1>';
        echo '<form action="resultTrajet.php" method="POST">';
        echo '<label for="depart">Départ</label>';
        echo '<select class="input" name="depart" id="depart" required>';
        $mabd = connexionBD();
        $requete = $mabd->query("SELECT park_nom FROM parkings");
        while ($park = $requete->fetch()) {
            $parkingNom = $park['park_nom'];
            echo "<option value='$parkingNom'>$parkingNom</option>";
        }
        echo '</select>';
        echo '<label for="nom">Destination</label>';
        echo '<input class="input" type="text" id="dest" name="dest" required placeholder="Ville">';
        echo '<label for="date">Date</label>';
        echo '<input class="input" type="date" id="date" name="date" required>';
        echo '<div id="trajet_submit">';
        echo '<input type="submit" value="Rechercher">';
        echo '</div>';
        echo '</form>';
    } else {
        // Utilisateur non connecté
        echo '<h1>Pour effectuer une recherche, veuillez vous authentifier.</h1>';
        echo '<div id="boutons_index">';
        echo '<a id="index_connexion" href="connexion.php"><button>Connexion</button></a><br>';
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
            <h3>Car & Cie, c’est quoi ?</h3><br>
            <p>Car & Cie est une plateforme de covoiturage en ligne spécialement 
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

