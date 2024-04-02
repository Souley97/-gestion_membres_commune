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


// Vérifier si le formulaire a été soumis


// Méthode pour afficher tous les membres de la commune


