<?php

//definition des constantes  pour les infos de la base de données
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
// define('DB_NAME', 'gestion_membres_commune');
define('DB_NAME', 'gestion_membres_commune2');

//connexion à la base de données en utilisant PDO
try {
   $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
   // echo "connexion réussie";
} catch (PDOException $e) {
   //affichage d'un message d'erreur et arreter le script si la connexion echoue
   die("erreur:: impossible de se connecter à la base de donnée" . $e->getMessage());
}
?>