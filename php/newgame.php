<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Guess the correlation</title>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script src="../js/fonction.js"></script>
  </head>
  <body>
    <a href="menu.php">Main Menu</a>
    <div class="jeu">

      <div id="myPlot" style="width:100%;max-width:40%"></div>
      <script>
        // faire une fonction qui va boucler la matrice avec 100 points aleatoire entre 0 et 1
        var xArray = [];
        var yArray = [];
        var xArr = [];
        var yArr = [];
        // var rho = Math.round(Math.random()*100)/100;
        var rho = 0.87;
        var y1 = 1;
        var y2 = rho;
        var x1 = 0;
        var x2 = Math.sqrt(1-rho**2)
        for (var i=0, t=100; i<t; i++) {
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
          xaxis: {range: [0, 1], title: "titre1", dtick: 0.5,fixedrange: true},
          yaxis: {range: [0, 1], title: "titre2", dtick: 0.5,fixedrange: true},
          autosize: true,
          title: "titregraph",
          hovermode: false,
        };

        // Display using Plotly
        Plotly.newPlot("myPlot", data, layout,{displayModeBar: false});
        document.write("réponse: ",rho);
      </script>

      <div class="repdiv">
        <input type="text" id="try" name="try" value="">
        <input type="button" id="reponse" name="reponse" value="GUESS">
      </div>

    </div>
  </body>
</html>
