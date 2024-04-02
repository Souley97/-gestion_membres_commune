<?php
require_once 'DB.php';

class MembreDB
{
    private $connexion;
    private $table_name = "membres_commune";

    private $id;


    public $matricule;
    public $nom;
    public $prenom;
    public $tranche_age;
    public $sexe;
    public $situation_matrimoniale;
    public $statut;
    public $date_enregistrement;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }



    // Méthode pour afficher les membres dans une vue

    public function readAllMembres()
    {
        try {
            $query = "SELECT * FROM membres_commune";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            die("Erreur: Impossible d'afficher les membres de la commune : " . $e->getMessage());
        }
    }
    public function createMembre($matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut)
    {

        try {
            $query = "INSERT INTO " . $this->table_name . " (matricule, nom, prenom, tranche_age, sexe, situation_matrimoniale, statut) VALUES (:matricule, :nom, :prenom, :tranche_age, :sexe, :situation_matrimoniale, :statut)";
            $stmt = $this->connexion->prepare($query);

            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':tranche_age', $tranche_age);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $stmt->bindParam(':statut', $statut);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs
            return false;
        }
    }

}