<?php
session_start(); // Vérifier si l'agent est connecté 
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
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
    <!-- Profil utilisateur -->
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Logo ou titre de votre site -->
                <a class="navbar-brand" href="#">Logo</a>

                <!-- Contenu de la barre de recherche -->
                <form class="form-inline my-2 my-lg-0 mr-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>

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
                            <a class="dropdown-item" href="../../views/agents/logout.php">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container ">
        <h5 class="modal-title" id="exampleModalLabel">Modifier un membre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container w-12 ">

        <?php
        require_once '../../models/MembreDB.php';

        // Vérifier si un ID de membre est passé en paramètre dans l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            // Inclure la classe MembreDB
        
            // Créer une instance de MembreDB avec la connexion à la base de données
            $membreDB = new MembreDB($connexion);

            // Obtenir les informations du membre à éditer
            $membre = $membreDB->getMembreById($id);

            // Vérifier si le membre existe
            if ($membre) {
                ?>
                <!-- Formulaire de modification -->
                <form action="../../controllers/membreController.php" method="POST">
                    <!-- Champ caché pour l'ID du membre à modifier -->
                    <input type="hidden" name="id" value="<?= $membre['id'] ?>">

                    <div class="form-group">
                        <label for="matricule">Matricule:</label>
                        <input type="text" class="form-control" id="matricule" name="matricule"
                            value="<?= $membre['matricule'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $membre['nom'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $membre['prenom'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tranche_age">âge:</label>
                        <input type="text" class="form-control" id="tranche_age" name="tranche_age"
                            value="<?= $membre['tranche_age'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe:</label>
                        <select class="form-control" id="sexe" name="sexe">
                            <option value="Homme" <?= $membre['sexe'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
                            <option value="Femme" <?= $membre['sexe'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="situation_matrimoniale">Situation</label>
                        <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale">
                            <option value="Célibataire" <?= $membre['situation_matrimoniale'] == 'Célibataire' ? 'selected' : '' ?>>Célibataire</option>
                            <option value="Marié" <?= $membre['situation_matrimoniale'] == 'Marié' ? 'selected' : '' ?>>
                                Marié</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut:</label>
                        <select class="form-control" id="statut" name="statut">
                            <option value="Civile" <?= $membre['statut'] == 'Civile' ? 'selected' : '' ?>>Civile
                            </option>
                            <option value="Chef de quartier" <?= $membre['statut'] == 'Chef de quartier' ? 'selected' : '' ?>>
                                Chef
                                de quartier</option>

                            <option value="Badian Gokh" <?= $membre['statut'] == 'Badian Gokh' ? 'selected' : '' ?>>
                                Badian
                                Gokh</option>
                        </select>
                    </div>
                    <button type="submit" name="editMembre" class="btn btn-primary">Modifier</button>
                </form>

                <?php
            } else {
                echo "Aucun membre trouvé.";
            }
        } else {
            echo "ID de membre non spécifié.";
        }
        ?>
    </div>
    <!-- </div>
    </div>
    </div> -->
    <!-- Intégration de Bootstrap JS (optionnel si vous n'utilisez pas de fonctionnalités JavaScript de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>