<?php

require_once '../models/TranchAgeDB.php';

// AJouter

// AJouter
if (isset($_POST["addAge"])) {
    try {
        // Extraire les données du formulaire
        // $nom= $_POST['nom'];
        // $prenom= $_POST['prenom'];
        
        extract($_POST);

        // Créer une instance de la classe modèle tra$tranch avec la connexion à la base de données
        $tranch = new TranchAgeDB($connexion);

        // Appeler la méthode pour créer un nouveau tra$tranch en utilisant les données du formulaire
        if ($tranch->addTranchAge($libelle, $age_min, $age_max)) {
            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../views/tranches/index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Afficher un message d'erreur en cas d'échec de l'ajout du tra$tranch
        die("Erreur : une erreur s'est produite lors de l'ajout du tra$tranch. " . $e->getMessage());
    }
}


// Modifier
if (isset($_POST["editAge"])) {
    extract($_POST);

    // Créer une instance de la classe modèle tra$tranch avec la connexion à la base de données
    $tranch = new TranchAgeDB($connexion);

    // Appeler la méthode pour mettre à jour les informations du tra$tranch en utilisant les données du formulaire
    if ($tranch->editTranchAge($id, $libelle, $age_min, $age_max)) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: ../views/tranches/index.php");
        exit();
    } else {
        // Gérer les erreurs
        echo "Une erreur s'est produite lors de la mise à jour du tranche age.";
    }
}
// Vérifie si l'ID du tra$tranch à supprimer est défini dans l'URL
if (isset($_GET['id'])) {
    // Inclure le fichier de configuration de la base de données et la classe tranc$tranche

    // Instancier la classe tranc$tranche avec la connexion à la base de données
    $tranche = new TranchAgeDB($connexion);

    // Récupérer l'ID du tra$tranch à supprimer depuis l'URL
    $id = $_GET['id'];

    // Appeler la méthode de suppression du tra$tranch avec l'ID spécifié
    if ($tranche->deleteTranchAge($id)) {
        // Rediriger vers la page principale avec un message de succès
        header('Location: ../views/tranches/index.php');
        exit();
    } else {
        // Rediriger vers la page principale avec un message d'erreur
        header('Location: index.php?error=Une erreur s\'est produite lors de la suppression du tra$tranch.');
        exit();
    }
} else {
    // Rediriger vers la page principale si l'ID n'est pas défini dans l'URL
    header('Location: ../index.php');
    exit();
}
