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
      var per = prompt("Please enter a username")
      if (per !==null && per !== ""){
        window.location.href="newgame.php";
        localStorage.setItem("storageName",per);
      }
    }

    </script>
    <center><img src="https://i.ibb.co/xSnxs0J/LOGO-GTC.png" alt="LOGO-GTC" border="0" ></center>
    <FONT size="4pt"><h1 onclick="newgameprompt()"><a style="cursor: pointer;">New Game</a></h1>
    <a href="scoreboard.php"><h1>Score Board</h1></a>
    <a href="about.php"><h1>About</h1></a>


  </body>
</html>
