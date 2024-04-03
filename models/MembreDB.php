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

    public function updateMembre($id, $matricule, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut)
    {
        try {
            $query = "UPDATE " . $this->table_name . " SET matricule = :matricule, nom = :nom, prenom = :prenom, tranche_age = :tranche_age, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale, statut = :statut WHERE id = :id";
            $stmt = $this->connexion->prepare($query);

            $stmt->bindParam(':id', $id);
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

    // Méthode pour récupérer les informations d'un membre par son ID
    public function getMembreById($id)
    {
        try {
            $query = "SELECT * FROM membres_commune WHERE id = ?";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([$id]);
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);
            return $membre;
        } catch (PDOException $e) {
            // Gérer les erreurs
            die("Erreur lors de la récupération des informations du membre: " . $e->getMessage());
        }
    }
    public function deleteMembre($id)
    {
        try {
            // Requête SQL pour supprimer le membre avec l'ID spécifié
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

            // Préparation de la requête
            $stmt = $this->connexion->prepare($query);

            // Liaison de la valeur de l'ID avec le paramètre de la requête
            $stmt->bindParam('id', $id);

            // Exécution de la requête
            if ($stmt->execute()) {
                // La suppression a réussi
                return true;
            } else {
                // La suppression a échoué
                return false;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur lors de la suppression du membre: " . $e->getMessage();
            return false;
        }
    }
    public function getMembresByStatut($statut)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE statut = ?";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([$statut]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs
            die("Erreur lors de la récupération des membres par statut: " . $e->getMessage());
        }
    }


}