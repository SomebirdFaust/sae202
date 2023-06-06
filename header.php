<header>
    <nav>
        <a href="index.php">Accueil</a> -
        <a href="parkings.php">Parkings</a> -
        <a href="trajets.php">Trajets</a>
        <a href="profil.php">Mon Profil</a>
        <a href="admin/gestion.php">Admin</a>
    </nav>
    <div id="utilisateur">

    <?php
    if(!empty($_SESSION['prenom_client'])){
        echo'Bienvenue '.$_SESSION['prenom_client'].' ';
        echo'<a href="deconnexion.php">Déconnexion</a>';
            }else{
                echo '<a href="profil.php">
                </a>
                    &nbsp;
                    <a href="connexion.php">Connexion</a>/<a href="inscription.php">Inscription<a>';
            }
    ?>
&nbsp;

    </div>
</header>