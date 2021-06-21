<?php
include("connexion.php"); //Inclusion du fichier qui contient le code pour la connexion
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <meta charset="utf-8">
    <title>Guess the correlation</title>
  </head>
  <body>
    <h1><div align="right"><a href="Menu.php">Main Menu</a></div><h1>

      <?php

        $mysqli = connectMaBase(); // Appel de la fonction pour se connecter

      // On récupère tout le contenu de la table partie
      $reponse = $mysqli->query('SELECT  pseudo, Score from partie order by Score limit 15');

      // Parcourir le tableau des enregistrements et affichage de chaque message
      while($ligne = $reponse->fetch_array(MYSQLI_BOTH)) {
          echo $ligne['pseudo'].": ";
          echo $ligne['Score']."<br>";
        }
      $mysqli->close(); // Termine le traitement de la requête

      ?>
  </body>
</html>
