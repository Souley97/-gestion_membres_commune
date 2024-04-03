<?php

require_once '../models/MembreDB.php';

// AJouter
if (isset($_POST["addMembre"])) {


    extract($_POST);
    // Créer une instance de la classe modèle Membre avec la connexion à la base de données
    $membre = new MembreDB($connexion);

    // Appeler la méthode pour créer un nouveau membre en utilisant les données du formulaire
    if ($membre->createMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut)) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: ../index.php");
        exit();
    } else {
        // Gérer les erreurs
        echo "Une erreur s'est produite lors de l'ajout du membre.";
    }
}

// Modifier
if (isset($_POST["editMembre"])) {
    extract($_POST);

    // Créer une instance de la classe modèle Membre avec la connexion à la base de données
    $membre = new MembreDB($connexion);

    // Appeler la méthode pour mettre à jour les informations du membre en utilisant les données du formulaire
    if ($membre->updateMembre($id, $matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut)) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: ../index.php");
        exit();
    } else {
        // Gérer les erreurs
        echo "Une erreur s'est produite lors de la mise à jour du membre.";
    }
}
// Vérifie si l'ID du membre à supprimer est défini dans l'URL
if (isset($_GET['id'])) {
    // Inclure le fichier de configuration de la base de données et la classe MembreDB

    // Instancier la classe MembreDB avec la connexion à la base de données
    $membreDB = new MembreDB($connexion);

    // Récupérer l'ID du membre à supprimer depuis l'URL
    $id = $_GET['id'];

    // Appeler la méthode de suppression du membre avec l'ID spécifié
    if ($membreDB->deleteMembre($id)) {
        // Rediriger vers la page principale avec un message de succès
        header('Location: ../index.php');
        exit();
    } else {
        // Rediriger vers la page principale avec un message d'erreur
        header('Location: index.php?error=Une erreur s\'est produite lors de la suppression du membre.');
        exit();
    }
} else {
    // Rediriger vers la page principale si l'ID n'est pas défini dans l'URL
    header('Location: index.php');
    exit();
}

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];

    // Créer une instance de MembreDB avec la connexion à la base de données
    $membreDB = new MembreDB($connexion);

    // Récupérer les membres correspondants selon le filtre
    switch ($filter) {
        case 'chef_de_quartier':
            $membres = $membreDB->getMembresByStatut('Chef de quartier');
            break;
        case 'membre_civile':
            // $membres = $membreDB->getMembresByStatut('Civile');
            break;
        case 'badian_gokh':
            $membres = $membreDB->getMembresByStatut('Badian Gokh');
            break;
        default:
            $membres = $membreDB->readAllMembres(); // Aucun filtre, récupérer tous les membres
            break;
    }
} else {
    // Aucun filtre, récupérer tous les membres
    $membreDB = new MembreDB($connexion);
    $membres = $membreDB->readAllMembres();
}

// Afficher les membres récupérés
foreach ($membres as $membre) {
    // Affichage des détails du membre...
}
// Vérifier si le formulaire a été soumis


// Méthode pour afficher tous les membres de la commune