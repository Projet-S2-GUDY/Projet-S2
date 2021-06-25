<?php
include("connexion.php"); //Inclusion du fichier qui contient le code pour la connexion
$mysqli = connectMaBase();
$sql = "SELECT  pseudo, Score from partie order by Score DESC limit 15";
$reponse = $mysqli->query($sql);
$arr_users = [];
if ($reponse->num_rows > 0) {
    $arr_users = $reponse->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <meta charset="utf-8">
    <title>Guess the correlation</title>
  </head>
  <body>

    <h1><div align="right"><a href="Menu.php">Main Menu</a></div><h1><br><br>
      <table id="userTable" align="center">
          <thead style="color:purple;">
              <th>Pseudo</th>
              <th>Score</th>
          </thead>
          <tbody>
              <?php if(!empty($arr_users)) { ?>
                  <?php foreach($arr_users as $user) { ?>
                      <tr>
                          <td><?php echo $user['pseudo']; ?></td>
                          <td><?php echo $user['Score']; ?></td>
                      </tr>
                  <?php } ?>
              <?php } ?>
          </tbody>
      </table>

  </body>
</html>
