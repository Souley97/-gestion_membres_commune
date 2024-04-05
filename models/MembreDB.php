<?php
require_once 'DB.php';
// Inclure le fichier contenant le trait
require_once 'ValidationTrait.php';
// require_once 'MatriculeTrait.php';
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

    // public function readAllMembres()
    // {
    //     try {
    //         $query = "SELECT * FROM membres_commune";
    //         $stmt = $this->connexion->prepare($query);
    //         $stmt->execute();
    //         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $results;
    //     } catch (PDOException $e) {
    //         die("Erreur: Impossible d'afficher les membres de la commune : " . $e->getMessage());
    //     }
    // }

    public function readAllMembres()
    {
        try {
            $query = "SELECT m.*, q.libelle AS quartier, t.libelle AS tranche_age, s.libelle AS statut 
        FROM membres_commune m
        INNER JOIN quartier q ON m.idQuartier = q.id
        INNER JOIN tranche_age t ON m.idAge = t.id
        INNER JOIN statut s ON m.idStatut = s.id";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            die("Erreur: Impossible d'afficher les membres de la commune : " . $e->getMessage());
        }
    }
    public function getUnMembre($id)
    {
        try {

            // m : membres_commune  , ta : tranche_age, q ; quartier , s : statut
            $query = "SELECT m.*,
                             q.libelle AS quartier,  s.libelle AS statut,
                             ta.libelle AS tranche_age, ta.age_min ,ta.age_max
                      FROM membres_commune m
                      INNER JOIN quartier q ON m.idQuartier = q.id
                      INNER JOIN tranche_age ta ON m.idAge = ta.id
                      INNER JOIN statut s ON m.idStatut = s.id
                      WHERE m.id = ?";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs
            return null;
        }
    }
    use ValidationTrait;
    // Méthode de la classe utilisant les fonctionnalités des traits

    // public function addMembre($nom, $prenom, $lastMatricule)
    public function addMembre($nom, $prenom, $sexe, $situation_matrimoniale, $etat, $idStatut, $idQuartier, $idAge)
    {
        try {
            // Préparation de la requête SQL pour l'insertion d'un membre
            $query = "INSERT INTO " . $this->table_name . " (nom, prenom, sexe, situation_matrimoniale, etat, idStatut, idQuartier, idAge) 
                        VALUES (:nom, :prenom, :sexe, :situation_matrimoniale, :etat, :idStatut, :idQuartier, :idAge)";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $stmt->bindParam(':etat', $etat);
            $stmt->bindParam(':idQuartier', $idQuartier);
            $stmt->bindParam(':idAge', $idAge);
            $stmt->bindParam(':idStatut', $idStatut);

            // Exécution de la requête d'insertion
            $stmt->execute();

            // Récupérer l'ID auto-incrémenté généré
            $id = $this->connexion->lastInsertId();

            // Générer le matricule
            $matricule = "PO_" . str_pad($id, 3, '0', STR_PAD_LEFT);

            // Mettre à jour le membre avec le matricule généré
            $query = "UPDATE " . $this->table_name . " SET matricule = :matricule WHERE id = :id";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true; // Succès de l'insertion
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de l'ajout du membre
            die("Erreur : une erreur s'est produite lors de l'ajout du membre. " . $e->getMessage());
        }
    }

    public function editMembre($id, $nom, $prenom, $sexe, $situation_matrimoniale, $etat, $idStatut, $idQuartier, $idAge)
    {
        try {
            // Préparation de la requête SQL pour la mise à jour d'un membre
            $query = "UPDATE " . $this->table_name . " 
                  SET nom = :nom,
                      prenom = :prenom,
                      sexe = :sexe,
                      situation_matrimoniale = :situation_matrimoniale,
                      etat = :etat,
                      idStatut = :idStatut,
                      idQuartier = :idQuartier,
                      idAge = :idAge
                  WHERE id = :id";
            $stmt = $this->connexion->prepare($query);

            // Liaison des valeurs aux paramètres de la requête
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $stmt->bindParam(':etat', $etat);
            $stmt->bindParam(':idStatut', $idStatut);
            $stmt->bindParam(':idQuartier', $idQuartier);
            $stmt->bindParam(':idAge', $idAge);
            $stmt->bindParam(':id', $id);

            // Exécution de la requête de mise à jour
            $stmt->execute();

            return true; // Succès de la mise à jour
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de la mise à jour
            die("Erreur : une erreur s'est produite lors de la mise à jour du membre. " . $e->getMessage());
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
    public function membresCivile()
    {
        try {


            // Requête SQL pour récupérer les données de la vue
            $sql = "SELECT * FROM vue_membres_civiles";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();

            // Récupérer les résultats de la requête
            $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $membres;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function getQuartiers()
    {
        $query = "SELECT * FROM quartier";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les données des tranches d'âge
    public function getTranchesAge()
    {
        $query = "SELECT * FROM tranche_age";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les données des statuts
    public function getStatuts()
    {
        $query = "SELECT * FROM statut";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}