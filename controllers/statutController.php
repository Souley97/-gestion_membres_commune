<?php

require_once '../models/StatusDB.php';

// AJouter

// AJouter
if (isset($_POST["addStatus"])) {
    try {
        // Extraire les données du formulaire
        extract($_POST);

        // Créer une instance de la classe modèle Membre avec la connexion à la base de données
        $membre = new StatusDB($connexion);

        // Appeler la méthode pour créer un nouveau membre en utilisant les données du formulaire
        if ($membre->addStatus($libelle)) {
            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../views/status/index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Afficher un message d'erreur en cas d'échec de l'ajout du membre
        die("Erreur : une erreur s'est produite lors de l'ajout du membre. " . $e->getMessage());
    }
}