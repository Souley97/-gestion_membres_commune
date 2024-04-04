<?php

// Définir un trait pour la génération de matricule

// Définir un trait pour la validation des informations des membres
trait ValidationTrait
{
    public function validateMembre($nom, $prenom)
    {
        // Ajoutez vos règles de validation ici
        if (empty($nom) || empty($prenom)) {
            return false; // Échec de la validation si l'un des champs est vide
        }
        return true; // Tous les champs sont remplis
    }
    public function generateMatricule($lastMatricule)
    {
        // Préparez une requête pour récupérer le dernier matricule de la base de données
        $query = "SELECT matricule FROM membres_commune ORDER BY id DESC LIMIT 1";

        // Exécutez la requête
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        // Récupérez le dernier matricule
        $lastMatricule = $stmt->fetchColumn();

        // Déterminez le nouveau numéro de matricule en incrémentant le numéro actuel
        if ($lastMatricule) {
            // Extraire le numéro de matricule existant
            $num = intval(substr($lastMatricule, strlen("PO_")));
            // Incrémenter le numéro
            $num++;
            // Formater le nouveau numéro avec des zéros à gauche
            $newMatricule = "PO_" . sprintf("%03d", $num);
        } else {
            // Si aucun matricule n'est présent, utilisez le premier matricule
            $newMatricule = "PO_001";
        }

        return $newMatricule;
    }



}
