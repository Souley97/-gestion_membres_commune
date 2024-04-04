<?php

require_once '../models/QuartierDB.php';

// AJouter

// AJouter
if (isset($_POST["addM"])) {
    try {
        // Extraire les données du formulaire
        extract($_POST);

        // Créer une instance de la classe modèle Membre avec la connexion à la base de données
        $membre = new QuartierDB($connexion);

        // Appeler la méthode pour créer un nouveau membre en utilisant les données du formulaire
        if ($membre->addQuartier($libelle)) {
            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../views/quartiers/index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Afficher un message d'erreur en cas d'échec de l'ajout du membre
        die("Erreur : une erreur s'est produite lors de l'ajout du membre. " . $e->getMessage());
    }
}


// Modifier
if (isset($_POST["editQuartier"])) {
    extract($_POST);

    // Créer une instance de la classe modèle Membre avec la connexion à la base de données
    $membre = new QuartierDB($connexion);

    // Appeler la méthode pour mettre à jour les informations du membre en utilisant les données du formulaire
    if ($membre->editQuertier($id, $libelle)) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: ../views/quartiers/index.php");
        exit();
    } else {
        // Gérer les erreurs
        echo "Une erreur s'est produite lors de la mise à jour du membre.";
    }
}
// Vérifie si l'ID du membre à supprimer est défini dans l'URL
if (isset($_GET['id'])) {
    // Inclure le fichier de configuration de la base de données et la classe Quartier

    // Instancier la classe Quartier avec la connexion à la base de données
    $Quartier = new QuartierDB($connexion);

    // Récupérer l'ID du membre à supprimer depuis l'URL
    $id = $_GET['id'];

    // Appeler la méthode de suppression du membre avec l'ID spécifié
    if ($Quartier->deleteQuertier($id)) {
        // Rediriger vers la page principale avec un message de succès
        header('Location: ../views/quartiers/index.php');
        exit();
    } else {
        // Rediriger vers la page principale avec un message d'erreur
        header('Location: index.php?error=Une erreur s\'est produite lors de la suppression du membre.');
        exit();
    }
} else {
    // Rediriger vers la page principale si l'ID n'est pas défini dans l'URL
    header('Location: ../index.php');
    exit();
}
