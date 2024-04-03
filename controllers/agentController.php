<?php
require_once '../models/AgentDB.php';
// Inclure la classe AgentDB et établir la connexion à la base de données

if (isset($_POST['addAgent'])) {
    // Récupérer les données du formulaire
    // extract($_POST);
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher le mot de passe

    // Créer une instance de la classe AgentDB avec la connexion à la base de données
    $agent_db = new AgentDB($connexion);

    // Appeler la méthode pour créer un nouvel agent en utilisant les données du formulaire
    if ($agent_db->createAgent($matricule, $nom, $prenom, $email, $telephone, $password)) {
        // Redirection vers une page de succès ou affichage d'un message de succès
        header("Location: ../index.php");
        exit();
    } else {
        // Gérer les erreurs d'insertion de l'agent
        echo "Une erreur s'est produite lors de la création de l'agent.";
    }


}
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['login'])) {

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $agentDB = new AgentDB($connexion);


        $agent = $agentDB->verifyCredentials($email, $password);

        if ($agent) {
            session_start();
            $_SESSION["id"] = $agent["id"];
            $_SESSION["nom"] = $agent["nom"];
            $_SESSION["prenom"] = $agent["prenom"];
            header("Location: ../views/membres/index.php"); // Rediriger vers la page du tableau de bord de l'agent
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}