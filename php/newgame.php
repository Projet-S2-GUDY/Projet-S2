<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Guess the correlation</title>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  </head>
  <body>
    <div id="myPlot" style="width:100%;max-width:700px"></div>

    <script>

    // faire une fonction qui va boucler la matrice avec 100 points aleatoire entre 0 et 1
    var xArray = [0.50,0.60,0.70,0.80,0.90,0.100,0.110,0.120,0.130,0.140,0.150];
    var yArray = [0.7,0.8,0.8,0.9,0.9,0.9,0.10,0.11,0.14,0.14,0.15];

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
    document.write(math.random ());
    </script>
  </body>
</html>
