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
        <title>Profil</title>
    </head>
    <body>
        
    <div id="contenu">
    <h1>Modification du profil</h1>
    <h3>Vos informations :</h3>
    <h3>
        <?php
        $mabd=connexionBD();
        $client=recuperer_($co, $_SESSION['user_id']);
        echo '<p>'."\n";
        if ($client['user_genre']=="F") {
            echo 'Mme ';
        } else {
            echo 'M. ';
        }
        echo $client['user_prenom'].' '.strtoupper($client['user_nom']).'<br />'; 
        echo $client['user_mail'].'<br />'."\n";
        //echo $client['client_cp'].' '.strtoupper($client['client_ville']).'<br />';
        //echo strtoupper($client['client_pays']).'<br />'."\n";
        //echo 'Téléphone : '.$client['client_tel'].'<br />'."\n";
        echo '</p>'."\n";
        deconnexionBD($mabd);
        ?>
    </h3>
    <hr />
    <h3>Vos trajets :</h3>
    <h3>
        <?php
            $mabd=connexionBD();
            $trajets=recuperer_trajets_user($mabd, $_SESSION['user_id']);
            //print_r($commandes);
            echo '<table>'."\n";
            echo '<thead><th>Date</th><th>Jeu</th><th>Quantité</th><th>Prix Unitaire (&euro;)</th><th>Prix commande (&euro;)</th>';
            foreach ($trajets as $t) {
                echo '<tr><td>'.$t['_park_id'].'</td>';
                echo '<td>'.$t['traj_arrivee'].'</td>'."\n";
                echo '<td>'.$t['atraj_heure_depart'].'</td>'."\n";
                echo '<td>'.$t['traj_date'].'</td>'."\n";
                echo '</tr>'."\n";
            }
            echo '</table>'."\n";
            deconnexionBD($mabd);
        ?>
    </h3>
</div>

<?php
    require 'footer.php';
    ?>
</body>
</html>


