<?php
include("connexion.php"); //Inclusion du fichier qui contient le code pour la connexion
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Guess the correlation</title>
    <!-- Javascript permettant d'utiliser plotly ce qui nous permet d'obtenir un graphique avec des points X,Y-->
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script src="fonction.js"></script>
  </head>

  <body>
    <h1><div align="right"><a href="Menu.php">Main Menu</a></div><h1>
      <!-- Cette div points contient le score et les vies -->
    <div id="points">
      <p><img src="https://i.ibb.co/vLVbFC7/life.gif" alt="life" border="0" style="width:3%;height:3%;margin-left:20%" >x <span id="life">3</span>
      <img src="https://i.ibb.co/CJN6WWR/Logo-23gogo.gif" alt="Logo-23gogo" border="0" style="width:3%;height:3%;">x <span id="coins">0</span></p>
    </div>
    <!-- cette div contient le graphique le nuage de point -->
    <div align="center" class="plot" id="myPlot" ></div>
    <!-- //scatterplot -->
    <script>
      var xArray = [];
      var yArray = [];
// Ici on va initialisé les variables x et y pour obenir un tableau de points pour notre graphique, les points du tableau vont etre en fonction du coefficient de corrélation
      var rho = Math.round(Math.random()*100)/100;
      var y1 = 1;
      var y2 = rho;
      var x1 = 0;
      var x2 = Math.sqrt(1-rho**2)
      for (var i=0, t=50; i<t; i++) {
        xbis = Math.random();
        ybis = Math.random();
        xArray.push(xbis*y1+ybis*x1)
        yArray.push(xbis*y2+ybis*x2)
      }
      // Define Data
      var data = [{
        x:xArray,
        y:yArray,
        mode:"markers"
      }];

      // Define Layout https://plotly.com/javascript/axes/
      var layout = {
        xaxis: {range: [0, 1], dtick: 0.5,fixedrange: true},
        yaxis: {range: [0, 1], dtick: 0.5,fixedrange: true},
        autosize: true,
        hovermode: false,
        width: 0.4 * window.innerWidth,
        height: 0.5 * window.innerHeight
      };
      // Display using Plotly
      var myDiv = document.getElementById('myPlot')
      Plotly.newPlot("myPlot", data, layout,{displayModeBar: false});
      // côté responsiv du graphique
      window.onresize = function() {
        Plotly.relayout(myPlot, {
          width: 0.4 * window.innerWidth,
          height: 0.5 * window.innerHeight
        })
      }
      // fonction qui va permette de supprimer les points dans les graphiques
      function adjustValue(){
        Plotly.deleteTraces("myPlot", 0);
      }
      // fonction qui permet de re remplir le graphique avec de nouveau points et un nouveau coefficient
      function updatenewplot(){
       var xArray = [];
       var yArray = [];
       var newrho = Math.round(Math.random()*100)/100;
       rho = newrho;
       var y1 = 1;
       var y2 = rho;
       var x1 = 0;
       var x2 = Math.sqrt(1-rho**2)
       for (var i=0, t=50; i<t; i++) {
         xbis = Math.random();
         ybis = Math.random();
         xArray.push(xbis*y1+ybis*x1)
         yArray.push(xbis*y2+ybis*x2)
       }
       var data = [{
         x:xArray,
         y:yArray,
         mode:"markers"
       }];

       // Define Layout https://plotly.com/javascript/axes/
       var layout = {
         xaxis: {range: [0, 1], dtick: 0.5,fixedrange: true},
         yaxis: {range: [0, 1], dtick: 0.5,fixedrange: true},
         autosize: true,
         hovermode: false,
         width: 0.4 * window.innerWidth,
         height: 0.5 * window.innerHeight
       };
       // Display using Plotly
       var myDiv = document.getElementById('myPlot')
       Plotly.newPlot("myPlot", data, layout,{displayModeBar: false});

       window.onresize = function() {
         Plotly.relayout(myPlot, {
           width: 0.4 * window.innerWidth,
           height: 0.5 * window.innerHeight
         })
       }
      }
      // fonction qui permet d'afficher un nouveau graphique avec toute les données correspondant et les boutons disparait
      function newplotfunc(){
       adjustValue();
       updatenewplot();
       document.getElementById('bouton').style.visibility= "visible";
       document.getElementById('nextbouton').style.visibility= "hidden";
       document.getElementById('new').style.visibility= "hidden";
      }

    </script>

    <div id="nextbouton" style="visibility: hidden; display:inline;">
      <input class="police" type="button" name="next" value="NEXT" onclick="newplotfunc()">
    </div>

    <div id="bouton">
      <input class="police" type="text" id="try" name="try" value="0." style="width:10%">
      <input class="police" type="button" id="reponse" name="reponse" value="GUESS" onclick="test()">
    </div>

    <div style="margin-left:16%"><div id="new" style="visibility: hidden; display:inline;"></div></div>


    <!-- comparaison réponse -->
    <script>
    // fonction qui permet de tester la valeur du joueur et de relevé les differences par rapport au vrai coefficient et on affichera les textes de resultat
      function test(){
        // on va crée un nouvelle élement dans la div new et y afficher les resultats du joueurs
      document.getElementById("new").innerHTML = "";
      var rep = document.getElementById("try").value;
      var life = eval(document.getElementById('life').innerHTML);
      var coin = eval(document.getElementById('coins').innerHTML);
      var tag = document.createElement("p");
      var result =   Math.round(Math.abs(rho-rep)*100)/100;

      var text = document.createTextNode(" True R : "+ rho);
      var element = document.getElementById("new");
      tag.appendChild(text);
      var brl = document.createElement("br");
      tag.appendChild(brl);
      text = document.createTextNode(" Guessed R : "+rep);
      tag.appendChild(text);
      var brl = document.createElement("br");
      tag.appendChild(brl);
      var text = document.createTextNode(" Difference : "+result);
      tag.appendChild(text);
      // actualisation du nombre de vie et score du joueur
      if (result <=0.05) {
        if (life < 3) {
          life = life + 1;
        }
        coin = coin + 5;
      }else if (result <=0.1) {
        coin = coin + 1;
      }else {
        life = life - 1;
      }

      element.appendChild(tag);
      document.getElementById('life').innerHTML = life;
      document.getElementById('coins').innerHTML = coin;
      document.getElementById('bouton').style.visibility= "hidden";
      if (life > 0) {
          document.getElementById('nextbouton').style.visibility= "visible";
          document.getElementById('new').style.visibility= "visible";
      }else {
          document.getElementById('gameover').style.visibility= "visible";
          document.getElementById('new').style.visibility= "visible";
          // on va stocker le pseudo et le score dans un formulaire qui est invisible pour le garder en mémoire pour l'envoyer dans la BD plus tard
          document.forms["poster"]["pseudo"].value=localStorage.getItem("storageName");
          document.forms["poster"]["score"].value=document.getElementById("coins").innerHTML;
        }
      }
    </script>

    <!-- formulaire avec des inputs invisibles pour le score et pseudo -->
    <form name="poster" method="post" action="newgame.php">
      <div id="gameover" style="visibility: hidden; display:inline;">
          <p style="margin-left:39%;color:red" font-size='50em'> GAME OVER</p>
          <input type="submit" id="again" name="again" value="PLAY AGAIN">
          <input type="submit" name="menuprincipal" value="MENU PRINCIPAL">
      </div></br>
      <div style="visibility: hidden; display:inline;">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="">
        <br>
        <label for="score">Score</label>
        <input type="text" name="score" value="">
      </div>
    </form>
<!--------------------------------DEBUT DU CODE PHP--------------------------------->
  <?php

////////////////////////////////CONNEXION/////////////////////////////////////
    $mysqli = connectMaBase(); // Appel de la fonction pour se Connecter au SGBD

/////////////////////////////ENREGISTREMENT EN BDD//////////////////////////////
      if (isset ($_POST['again'])){
          // On récupère les valeurs entrées par l'utilisateur :
          $pseudo=$_POST['pseudo'];
          $score=$_POST['score'];

          // On prépare la commande sql d'insertion
          $insert = "INSERT INTO partie (pseudo, Score) VALUES ('".$pseudo."', '".$score."')";

          /* on lance la commande ($mysqli->query() ) et on rédige un petit message d'erreur
		      pour le cas où la requête ne passe pas (or die + $mysqli->error)
          (Message qui intégrera les causes d'erreur sql) */
          $mysqli->query($insert) or die ('Erreur SQL ! <br>'.$req.'<br>'.$mysqli->error);

      // on ferme la connexion
    }

    if (isset($_POST['menuprincipal']))
        {
        $pseudo=$_POST['pseudo'];
        $score=$_POST['score'];

        // On prépare la commande sql d'insertion
        $insert = "INSERT INTO partie (pseudo, Score) VALUES ('".$pseudo."', '".$score."')";

        /* on lance la commande ($mysqli->query() ) et on rédige un petit message d'erreur
		     pour le cas où la requête ne passe pas (or die + $mysqli->error)
        (Message qui intégrera les causes d'erreur sql) */
        $mysqli->query($insert) or die ('Erreur SQL ! <br>'.$req.'<br>'.$mysqli->error);
        ?>
        <script type="text/javascript">
          window.location = "Menu.php";
        </script>
        <?php
        }
    $mysqli->close();
  ?>
<!------------------------------FIN DU CODE PHP------------------------------>


  </body>
</html>
