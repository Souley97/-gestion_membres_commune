

        <?php
require_once 'DB.php';
// Inclure le fichier contenant le trait
require_once 'ValidationTrait.php';
// require_once 'MatriculeTrait.php';
class StatusDB
{


    private $connexion;
    private $table_name = "statut";

    private $id;


    public $matricule;
    public $nom;
    public $prenom;
    public $tranche_age;
    public $sexe;
    public $situation_matrimoniale;
    public $status;
    public $date_enregistrement;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }



    // Méthode pour afficher les membres dans une vue

    public function readStatus()
     {
         try {
             $query = "SELECT * FROM statut";
             $stmt = $this->connexion->prepare($query);
             $stmt->execute();
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $results;
         } catch (PDOException $e) {
            die("Erreur: Impossible d'afficher le status : " . $e->getMessage());
         }
     }

     public function addStatus($libelle)
     {
         try {
             // Préparation de la requête SQL pour l'insertion d'un membre
             $query = "INSERT INTO " . $this->table_name .  "(libelle) 
                           VALUES (:libelle)";
            $stmt=$this->connexion->prepare($query); 
            
            $stmt->bindparam(":libelle",$libelle);

            $stmt->execute();
            return true;


    }

    catch (PDOException $e) {
        // Afficher un message d'erreur en cas d'échec de l'ajout du membre
        die("Erreur : une erreur s'est produite lors de l'ajout du membre. " . $e->getMessage());
    }

       
 }

    
 public function editStatus($id, $libelle)
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
 public function getStatusById($id)
 {
     try {
         $query = "SELECT * FROM ". $this->table_name . " WHERE id = ?";
         $stmt = $this->connexion->prepare($query);
         $stmt->execute([$id]);
         $status = $stmt->fetch(PDO::FETCH_ASSOC);
         return $status;
     } catch (PDOException $e) {
         // Gérer les erreurs
         die("Erreur lors de la récupération des informations du status: " . $e->getMessage());
     }
 }
 public function deleteStatus($id)
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
         echo "Erreur lors de la suppression du status: " . $e->getMessage();
         return false;
     }
 }

}



 

    


?>


