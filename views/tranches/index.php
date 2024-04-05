<?php
include './models/DB.php';


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
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Logo ou titre de votre site -->
                <a class="navbar-brand" href="#">Logo</a>

                <!-- Contenu de la barre de recherche -->
                <!-- <form class="form-inline my-2 my-lg-0 mr-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form> -->
                <a href=""></a>
                <!-- Profil utilisateur -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php echo $agent_nom; ?>
                            <?php echo $agent_prenom; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="views/agents/index.php">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./views/agents/logout.php">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Button to Open Modal -->


    <div class="container mt-5">
        <!--formulaire  Ajouter un tranche -->
        <?php
        require_once 'create.php';
        ?>

        <!-- Barre de navigation -->

    </div>

    <div class="container">
        <h1 class="mt-5">Liste des tranches de la commune</h1>
        <!-- Ajout d'un bouton d'ajout stylisé avec Bootstrap -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary mr-8" data-toggle="modal" data-target="#ajouterTrancheModal">
                Ajouter un tranche
            </button>
            <button type="button" class="btn btn-primary left" data-toggle="modal" data-target="#myModal">
                Civiles
            </button>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>

                    <th scope="col">Nom</th>
                    <th scope="col">Age min</th>
                    <th scope="col">Age max</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../models/TranchAgeDB.php';
                $results = new TranchAgeDB($connexion);
                // $tranches = $results->tranchesCivile();
                $tranches = $results->readTranchAges();

                foreach ($tranches as $tranche): ?>
                    <tr>

                        <td>
                            <?= $tranche['libelle'] ?>
                        </td>
                        <td>
                            <?= $tranche['age_min'] ?>
                        </td>
                        <td>
                            <?= $tranche['age_max'] ?>
                        </td>


                        <td>
                            <!-- Bouton de modification -->
                            <a href="update.php?id=<?= $tranche['id'] ?>" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <!-- Bouton de suppression -->
                            <a href="../../controllers/ageController.php?id=<?= $tranche['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tranche ?')">
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