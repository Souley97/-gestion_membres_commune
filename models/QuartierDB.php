<?php
require_once 'DB.php';
// Inclure le fichier contenant le trait
// require_once 'MatriculeTrait.php';
class QuartierDB
{


    private $connexion;
    private $table_name = "quartier";



    public $libelle;
    

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }



    // Méthode pour afficher les quertiers dans une vue

    public function readQuartiers()
    {
        try {
            $query = "SELECT * FROM $this->table_name";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            die("Erreur: Impossible d'afficher les quertiers de la commune : " . $e->getMessage());
        }
    }

  

    // public function addquertier($nom, $prenom, $lastMatricule)
    public function addQuartier($libelle)
    {
        try {
            // Préparation de la requête SQL pour l'insertion d'un quartier
            $query = "INSERT INTO " . $this->table_name . " (libelle  ) 
                          VALUES (:libelle)";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':libelle', $libelle);
           

            // Exécution de la requête d'insertion
            $stmt->execute();

            return true; // Succès de l'insertion
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de l'ajout du quartier
            die("Erreur : une erreur s'est produite lors de l'ajout du quartier. " . $e->getMessage());
        }
    }
    public function editQuartier($id, $libelle)
    {
        try {
            // Préparation de la requête SQL pour la mise à jour d'un quartier
            $query = "UPDATE " . $this->table_name . " 
                  SET libelle = :libelle
                      
                  WHERE id = :id";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':libelle', $libelle);
          
            $stmt->bindParam(':id', $id);

            // Exécution de la requête de mise à jour
            $stmt->execute();

            return true; // Succès de la mise à jour
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de la mise à jour
            die("Erreur : une erreur s'est produite lors de la mise à jour du quartier. " . $e->getMessage());
        }
    }


    // Méthode pour récupérer les informations d'un quartier par son ID
    public function getQuartierById($id)
    {
        try {
            $query = "SELECT * FROM ". $this->table_name . " WHERE id = ?";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([$id]);
            $quartier = $stmt->fetch(PDO::FETCH_ASSOC);
            return $quartier;
        } catch (PDOException $e) {
            // Gérer les erreurs
            die("Erreur lors de la récupération des informations du quartier: " . $e->getMessage());
        }
    }
    public function deleteQuartier($id)
    {
        try {
            // Requête SQL pour supprimer le quartier avec l'ID spécifié
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
            echo "Erreur lors de la suppression du quartier: " . $e->getMessage();
            return false;
        }
    }

}