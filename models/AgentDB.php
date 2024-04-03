<?php
require_once 'DB.php';


class AgentDB
{
    private $connexion;
    private $table_name = "agents_mairie";

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function createAgent($matricule, $nom, $prenom, $email, $telephone, $password)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (matricule, nom, prenom, email, telephone, password) VALUES (:matricule, :nom, :prenom, :email, :telephone, :password )";
            $stmt = $this->connexion->prepare($query);

            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':password', $password);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs
            return false;
        }
    }

    public function verifyCredentials($email, $password)
    {
        try {
            $query = "SELECT * FROM agents_mairie WHERE email = :email";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $agent = $stmt->fetch();

            if ($agent && password_verify($password, $agent['password'])) {
                // Les identifiants sont valides
                return $agent;
            } else {
                // Les identifiants sont incorrects
                return false;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            return false;
        }
    }

}