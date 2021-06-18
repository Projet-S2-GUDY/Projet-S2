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
      <div id="points">
        <p>VIE : <span id="life">3</span></p>
        <p>COINS : <span id="coins">0</span></p>
      </div>
      <div id="myPlot" style="width:100%;max-width:40%"></div>
      <!-- //scatterplot -->
      <script>
        var xArray = [];
        var yArray = [];
        var xArr = [];
        var yArr = [];
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
          xaxis: {range: [0, 1], title: "titre1", dtick: 0.5,fixedrange: true},
          yaxis: {range: [0, 1], title: "titre2", dtick: 0.5,fixedrange: true},
          autosize: true,
          title: "titre graph",
          hovermode: false,
        };

        // Display using Plotly
        Plotly.newPlot("myPlot", data, layout,{displayModeBar: false});
        document.write("réponse: ",rho);
      </script>
      <div class="bouton">
        <input type="text" id="try" name="try" value="0.">
        <input type="button" id="reponse" name="reponse" value="GUESS" onclick="test()">
      </div>
      <div id="new">

      </div>
      <!-- comparaison réponse -->
      <script>
        function test(){
          document.getElementById("new").innerHTML = "";
          var rep = document.getElementById("try").value;
          var life = eval(document.getElementById('life').innerHTML);
          var coin = eval(document.getElementById('coins').innerHTML);
          var tag = document.createElement("p");
          var result = Math.abs(rho-rep);
          var text = document.createTextNode("True R : "+ rho +" <br>Guessed R: "+rep+"Difference: "+result);
          var element = document.getElementById("new");
          tag.appendChild(text);

          if (result <=0.05) {
            life = life + 1;
            coin = coin + 5;
          }else if (result <=0.1) {
            coin = coin + 1;
          }else {
            life = life - 1;
          }
          element.appendChild(tag);
          document.getElementById('life').innerHTML = life;
          document.getElementById('coins').innerHTML = coin;
        }
      </script>
  </body>
</html>
