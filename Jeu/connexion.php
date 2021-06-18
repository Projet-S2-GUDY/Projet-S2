<?php
  function connectMaBase(){
    $serveur = 'localhost';
    $utilisateur = 'root';
    $motdepasse = '';
    $nom_base = 'gtc';

    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $nom_base);
    // vérification de la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion : ".$mysqli->connect_error);
    }
    return $mysqli;
  }
?>
