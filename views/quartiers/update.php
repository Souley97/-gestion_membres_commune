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
    <?php
    require_once "../nav_bar.php";

    ?>
    <div class="container ">
        <h5 class="modal-title" id="exampleModalLabel">Modifier un quatier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container w-12 ">

        <?php
        require_once '../../models/QuartierDB.php';

        // Vérifier si un ID de quatier est passé en paramètre dans l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            // Inclure la classe Quartier
        
            // Créer une instance de Quartier avec la connexion à la base de données
            $results = new QuartierDB($connexion);

            // Obtenir les informations du quatier à éditer
            $quatier = $results->getQuartierById($id);

            // Vérifier si le quatier existe
            if ($quatier) {
                ?>
                <!-- Formulaire de modification -->
                <form action="../../controllers/quartierController.php" method="POST">
                    <!-- Champ caché pour l'ID du quatier à modifier -->
                    <input type="hidden" name="id" value="<?= $quatier['id'] ?>">

                
                    <div class="form-group">
                        <label for="libelle">Libelle:</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" value="<?= $quatier['libelle'] ?>" required>
                    </div>
                  
                    <button type="submit" name="editQuartier" class="btn btn-primary">Modifier</button>
                </form>

                <?php
            } else {
                echo "Aucun quatier trouvé.";
            }
        } else {
            echo "ID de quatier non spécifié.";
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