<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Guess the correlation</title>
      <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
      <script src="fonction.js"></script>
  </head>
  <body>
    <h1><div align="right"><a href="Menu.php">Main Menu</a></div><h1>
    <div id="points">
      <p>VIE : <span id="life">3</span></p>
      <p>COINS : <span id="coins">0</span></p>
    </div>

    <div class="plot" id="myPlot" ></div>
    <!-- //scatterplot -->
    <script>
      var xArray = [];
      var yArray = [];

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
      };

      // Display using Plotly
      var config = {responsive: true};
      Plotly.newPlot("myPlot", data, layout,config,{displayModeBar: false});

      function adjustValue(){
        Plotly.deleteTraces("myPlot", 0);
      }
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
       };
       var config = {responsive: true};
       Plotly.newPlot("myPlot", data, layout,config,{displayModeBar: false});
      }
      function newplotfunc(){
       adjustValue();
       updatenewplot();
       document.getElementById('bouton').style.visibility= "visible";
       document.getElementById('nextbouton').style.visibility= "hidden";
       document.getElementById('new').style.visibility= "hidden";
      }

    </script>

    <div id="nextbouton" style="visibility: hidden; display:inline;">
      <input type="button" name="next" value="NEXT" onclick="newplotfunc()">
    </div>

    <div id="bouton">
      <input class="police" type="text" id="try" name="try" value="0.">
      <input class="police" type="button" id="reponse" name="reponse" value="GUESS" onclick="test()">
    </div>

    <div id="new" style="visibility: hidden; display:inline;"></div>


    <!-- comparaison réponse -->
    <script>
      function test(){
      document.getElementById("new").innerHTML = "";
      var rep = document.getElementById("try").value;
      var life = eval(document.getElementById('life').innerHTML);
      var coin = eval(document.getElementById('coins').innerHTML);
      var tag = document.createElement("p");
      var result =   Math.round(Math.abs(rho-rep)*100)/100;

      var text = document.createTextNode("True R : "+ rho);
      var element = document.getElementById("new");
      tag.appendChild(text);
      var brl = document.createElement("br");
      tag.appendChild(brl);
      text = document.createTextNode(" Guessed R: "+rep);
      tag.appendChild(text);
      var brl = document.createElement("br");
      tag.appendChild(brl);
      var text = document.createTextNode("Difference: "+result);
      tag.appendChild(text);

      if (result <=0.05 && life <= 3) {
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
      document.getElementById('bouton').style.visibility= "hidden";
      if (life > 0) {
          document.getElementById('nextbouton').style.visibility= "visible";
          document.getElementById('new').style.visibility= "visible";
      }else {
          document.getElementById('gameover').style.visibility= "visible";
          document.getElementById('new').style.visibility= "visible";
          document.forms["poster"]["pseudo"].value=localStorage.getItem("storageName");
          document.forms["poster"]["score"].value=document.getElementById("coins").innerHTML;
        }
      }
    </script>


    <form name="poster" method="post" action="newgame.php">
      <div id="gameover" style="visibility: hidden; display:inline;">
          <p>GAME OVER</p>
          <input type="submit" id="again" name="again" value="PLAY AGAIN" onclick="sendata()">
      </div></br>
      <div style="visibility: hidden; display:inline;">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="">
        <br>
        <label for="score">Score</label>
        <input type="text" name="score" value="">
      </div>
    </form>


  </body>
</html>
