<?php
require_once 'DB.php';
// Inclure le fichier contenant le trait
// require_once 'MatriculeTrait.php';
class TranchAgeDB
{

    private $connexion;
    private $table_name = "tranche_age";



    public $libelle;


    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }



    // Méthode pour afficher les TranchAges dans une vue

    public function readTranchAges()
    {
        try {
            $query = "SELECT * FROM $this->table_name";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            die("Erreur: Impossible d'afficher les TranchAges de la commune : " . $e->getMessage());
        }
    }



    // public function addTranchAge($nom, $prenom, $lastMatricule)
    public function addTranchAge($libelle, $age_min, $age_max)
    {
        try {
            // Préparation de la requête SQL pour l'insertion d'un TranchAge
            $query = "INSERT INTO " . $this->table_name . " (libelle,age_min,age_max  ) 
                          VALUES (:libelle,:age_min,:age_max)";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':age_min', $age_min);
            $stmt->bindParam(':age_max', $age_max);


            // Exécution de la requête d'insertion
            $stmt->execute();

            return true; // Succès de l'insertion
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de l'ajout du TranchAge
            die("Erreur : une erreur s'est produite lors de l'ajout du TranchAge. " . $e->getMessage());
        }
    }
    public function editTranchAge($id, $libelle, $age_min, $age_max)
    {
        try {
            // Préparation de la requête SQL pour la mise à jour d'un TranchAge
            $query = "UPDATE " . $this->table_name . " 
                  SET libelle = :libelle
                  SET age_min = :age_min
                  SET age_max = :age_max
                      
                  WHERE id = :id";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':age_min', $age_min);
            $stmt->bindParam(':age_max', $age_max);
            $stmt->bindParam(':id', $id);

            // Exécution de la requête de mise à jour
            $stmt->execute();

            return true; // Succès de la mise à jour
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de la mise à jour
            die("Erreur : une erreur s'est produite lors de la mise à jour du TranchAge. " . $e->getMessage());
        }
    }


    // Méthode pour récupérer les informations d'un TranchAge par son ID
    public function getTranchAgeById($id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([$id]);
            $tranche_age = $stmt->fetch(PDO::FETCH_ASSOC);
            return $tranche_age;
        } catch (PDOException $e) {
            // Gérer les erreurs
            die("Erreur lors de la récupération des informations du TranchAge: " . $e->getMessage());
        }
    }
    public function deleteTranchAge($id)
    {
        try {
            // Requête SQL pour supprimer le TranchAge avec l'ID spécifié
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
            echo "Erreur lors de la suppression du TranchAge: " . $e->getMessage();
            return false;
        }
    }

}