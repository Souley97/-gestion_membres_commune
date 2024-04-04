<?php

// Définir un trait pour la génération de matricule
trait MatriculeTrait
{
    public function generateMatricule($lastMatricule)
    {
        $prefix = "PO_";
        // Extraire le numéro de matricule existant
        $num = intval(substr($lastMatricule, strlen($prefix)));
        // Incrémenter le numéro
        $num++;
        // Formater le numéro avec des zéros à gauche
        $newMatricule = $prefix . sprintf("%03d", $num);
        return $newMatricule;
    }
}