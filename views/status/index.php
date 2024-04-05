<?php


session_start(); // Vérifier si l'agent est connecté 
if (!isset($_SESSION["id"])) {
    header("Location: views/agents/login.php");
    exit();
} // Afficher le nom de l'agent 
$agent_nom = $_SESSION["nom"];
$agent_prenom = $_SESSION["prenom"]; ?>

<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mambre </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <?php
    require_once "../nav_bar.php";

    ?>

    <div class="container mt-5">
        <!--formulaire  Ajouter un status -->
        <?php
        require_once 'create.php';
        ?>

        <!-- Barre de navigation -->

    </div>

    <div class="container">
        <h1 class="mt-5">Liste des statuss de la commune</h1>
        <!-- Ajout d'un bouton d'ajout stylisé avec Bootstrap -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary mr-8" data-toggle="modal" data-target="#ajouterStatusModal">
                Ajouter un status
            </button>
            <button type="button" class="btn btn-primary left" data-toggle="modal" data-target="#myModal">
                Civiles
            </button>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    
                    <th scope="col">libelle</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../models/StatusDB.php';
                $results = new StatusDB($connexion);
                // $statuss = $results->membresCivile();

                    $statuss = $results->readStatus();

                foreach ($statuss as $status): ?>
                    <tr>
                        
                        <td>
                            <?= $status['libelle'] ?>
                        </td>
                    
                        <td>
                            <!-- Bouton de modification -->
                            <a href="update.php?id=<?= $status['id'] ?>" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <!-- Bouton de suppression -->
                            <a href="../../controllers/statutController.php?id=<?= $status['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce status ?')">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Intégration de Bootstrap JS (optionnel si vous n'utilisez pas de fonctionnalités JavaScript de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>