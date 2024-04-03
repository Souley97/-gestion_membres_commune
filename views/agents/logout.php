<?php
session_start();
// Détruire la session en cours
session_destroy();
// Rediriger vers la page de connexion
header("Location: login.php");
exit();
?>