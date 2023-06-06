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
    <div id="infos_profil">
        <img src="img/avatar.png" alt="avatar">
        <p>NOM</p>
        <p>PRÉNOM</p>
        <p>EMAIL</p>
    </div>
    <div id="bio_profil">
        <form action="">
            <label for="bio">Biographie</label><br>
            <input type="text" name="bio">
        </form>
    </div>
</body>
</html>


