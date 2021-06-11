<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Guess the correlation</title>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script src="../js/fonction.js">

      </script>
  </head>
  <body>
    <a href="menu.php">Main Menu</a>
    <div id="myPlot" style="width:100%;max-width:700px"></div>

    <script>
    // faire une fonction qui va boucler la matrice avec 100 points aleatoire entre 0 et 1
    var xArray = [];
    var yArray = [];
    for (var i=0, t=40; i<t; i++) {
      xArray.push(Math.random())
      yArray.push(Math.random())
    }
    // Define Data
    var data = [{
      x:xArray,
      y:yArray,
      mode:"markers"
    }];

    // Define Layout https://plotly.com/javascript/axes/
    var layout = {
      xaxis: {range: [0, 1], title: "titre1", dtick: 0.5},
      yaxis: {range: [0, 1], title: "titre2", dtick: 0.5},
      title: "titregraph",
      hovermode: false,
    };

    // Display using Plotly
    Plotly.newPlot("myPlot", data, layout,{displayModeBar: false});
    document.write(randomNumber());
    </script>
  </body>
</html>
