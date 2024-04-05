

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
    public $statut;
    public $date_enregistrement;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }



    // Méthode pour afficher les membres dans une vue

    public function readStatut()
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
 }
?>