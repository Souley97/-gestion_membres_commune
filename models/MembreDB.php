<?php
require_once 'DB.php';

class MembreDB
{
    private $connexion;

    private $id;


    private $matricule;
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
    // Méthode pour récupérer les informations d'un membre par son ID

}