<?php
session_start();

// Vérifier si l'agent est connecté
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Afficher le nom de l'agent
$agent_nom = $_SESSION["nom"];
$agent_prenom = $_SESSION["prenom"];

?>
<?php echo $agent_nom; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord de l'agent</title>
    <!-- Ajoutez ici vos liens CSS et scripts JavaScript -->
</head>

<body>
    <!-- Ajoutez ici le contenu de votre tableau de bord, par exemple : -->
    <h1>Bienvenue sur votre tableau de bord,
        <?php echo $agent_nom; ?>!
    </h1>
    <p>Voici les informations spécifiques à votre compte :</p>
    <ul>
        <!-- Afficher d'autres informations de l'agent si nécessaire -->
    </ul>

    <!-- Ajouter un lien de déconnexion -->
    <a href="logout.php">Déconnexion</a>

    <!-- Ajoutez ici d'autres fonctionnalités et éléments de votre tableau de bord -->

    <!-- Intégration de Bootstrap JS (optionnel si vous utilisez Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>