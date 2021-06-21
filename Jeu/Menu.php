<?php
include("connexion.php"); //Inclusion du fichier qui contient le code pour la connexion
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Guess the Correlation</title>
    <script src="fonction.js"></script>
  </head>
  <body>
    <script>
    function newgameprompt(linkto){
      var per = prompt("Please enter a username\n(maximum 20 alphanumeric or underscore characters)")
      if (per !==null && per !== ""){
        window.location.href="newgame.php";
        localStorage.setItem("storageName",per);
      }
    }

    </script>
    <center><img src="https://i.ibb.co/xSnxs0J/LOGO-GTC.png" alt="LOGO-GTC" border="0" ></center>
    <FONT size="4pt"><h1 onclick="newgameprompt()">New Game</h1>
    <a href="scoreboard.php"><h1>Score Board</h1></a>
    <a href="about.php"><h1>About</h1></a>
    <a href="settings.php"><h1>Settings</h1></a></FONT>
    <p id="pseudo"></p>
    <?php

      $mysqli = connectMaBase(); // Appel de la fonction pour se connecter

  /////////////////////////////ENREGISTREMENT EN BDD//////////////////////////////

      // On récupère les valeurs entrées par l'utilisateur :
      $pseudo = $_POST['pseudo'];

      // On prépare la commande sql d'insertion
      $insert = "INSERT INTO partie (pseudo) VALUES ('".$pseudo."')";

      /* on lance la commande ($mysqli->query() ) et on rédige un petit
        message d'erreur pour le cas où la requête ne passe pas (or die +
        $mysqli->error)
      (Message qui intégrera les causes d'erreur sql) */
      $mysqli->query($insert) or die ('Erreur SQL ! <br>'.$insert.'<br>'.$mysqli->error);

  //////////AFFICHAGE DU CONTENU DE LA TABLE dialogue SUR LA PAGE WEB/////////////

      // Création de la requête
      $select = "SELECT pseudo FROM partie";
      // Envoi de la requête
      $result = $mysqli->query($select) or die('Erreur SQL ! <br>'.$select.'<br>'.$mysqli->error);

      // Parcourir le tableau des enregistremente et Affichage de chaque
      // message
      while($ligne = $result->fetch_array(MYSQLI_BOTH)) {
        $pseudo = $ligne['pseudo'];
        echo $pseudo." <br />";
      }

      // on ferme la connexion
      $mysqli->close();
    ?>
  </body>
</html>
